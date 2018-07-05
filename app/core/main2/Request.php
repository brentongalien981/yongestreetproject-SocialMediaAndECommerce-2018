<?php
namespace App\Core\Main2;

require __DIR__ . "/../../../vendor/autoload.php";

use App\Model\Session;

class Request
{
    public const CRUD_TYPE_READ = 2;
    public const DEFAULT_CONTROLLER_NAME = "home";
    public const CRUD_TYPE_INDEX = "index";
    public const TIME_INTERVAL_CONSTRAINT_PER_PAGE_REQUEST = 5;
    public const MAX_NUM_OF_CONSECUTIVE_FAILED_REQUESTS = 3;

    public $url;
    public $workableUrl;
    public $isRequestAjax;
    public $controllerName;
    public $controllerAction;
    public $requestData;
    private $isInDevelopmentMode = true;
    // private $isInDevelopmentMode = false;

    // TODO: Replace pseudoSession to session later.
    private $pseudoSession;
    private $session;
    private $ip = "127.0.0.1";
    public $malice;
    private $checkDDOSAttack = true;
    public $isAccessConstrained = true;
    public $isLogInCredentialsValid = null;



    public function __construct($data = ["url" => "", "isRequetAjax" => false, "requestData" => null, "checkDDOSAttack" => true])
    {

        /* Initialize */
//        $this->pseudoSession = PseudoSession::getInstance();
        $this->session = \App\Model\Session::getInstance();
        $this->malice = Throttler::MALICE_FREE;

        $this->url = ($data["url"] != "") ? $data["url"] : $_SERVER['REQUEST_URI'];
        // if (isset($data["ip"])) { $this->ip = $data["ip"]; }
        $this->ip = isset($data["ip"]) ? $data["ip"] : $_SERVER['REMOTE_ADDR'];
        
        if (isset($data["checkDDOSAttack"])) {
            $this->checkDDOSAttack = $data["checkDDOSAttack"];
        }
        if (isset($data["requestData"])) {
            $this->requestData = $data["requestData"];
        }


        // Initialize page-requests and ajax-requests differently.
        $this->isRequestAjax = self::isAjax();
        if (isset($data["isRequestAjax"]) && $data["isRequestAjax"]) {
            $this->isRequestAjax = true;
        }


        /* Set the request vars. */
        CnUrlParser::setRequestVars($this);


        /* */
        if ($this->isRequestSpecialCase()) {
            Router::route($this);
            return;
        }

        // // TODO: Remove this.
        // $this->session->setNumOfConsecutiveFailedRequests(0);


        //
        try {
            if (!$this->checkMalice()) {
                return;
            }
            if (!$this->checkAccessConstraints()) {
                return;
            }
            $this->checkLogInCredentials();

            if (!Middleware::checkAuthorization($this)) {
                echo '\n************************\n';
                echo "TODO: UNAUTHORIZED\n";
                echo "TODO: REDIRECT TO A 'page-not-found' page..\n";
            }


            Router::route($this);
        } catch (\Exception $e) {
            if (!self::isAjax()) {
                echo "\nEXCEPTION CAUGHT...\nOops! There's a problem with the request...\n";
                echo "$e\n";
            }
        }
    }



    private function isRequestSpecialCase()
    {
        switch ($this->controllerName) {
            case 'TooManyRequest':
                return true;
                break;
            default:
                return false;
                break;
        }
    }



    private function checkLogInCredentials()
    {
        if (isset($this->session->userType)) {
            // Set just the session.
            $sessionProps = Session::getPropsInAssociativeArrayForm(['id' => $this->session->id]);
            $this->session->setBasicProps($sessionProps);
        } else {
            // Set both session and cookie for this initial request.
            Cookie::setCookieSession();
        }
    }



    private function checkAccessConstraints()
    {
        $doesCheckPass = true;
        $numOfConsecutiveFailedRequests = $this->session->consecutive_failed_requests;


        if ($numOfConsecutiveFailedRequests >= static::MAX_NUM_OF_CONSECUTIVE_FAILED_REQUESTS) {

            // TODO: Test this.
            Throttler::addToBlacklistedIps($this->ip);

            $doesCheckPass = false;
            
            // TODO: Redirect the request to page: redeem-access.php.
            // echo "TODO: Redirect the request to page: redeem-access.php.";
            echo "Sorry.. Your IP has been restricted :(<br>";
        }



        if ($doesCheckPass) {
            $this->isAccessConstrained = false;
        }

        return $doesCheckPass;
    }



    /**
     * @return bool false if the request has no malice. Positive int
     * if there's malice.
     */
    private function checkMalice()
    {
        $isMaliceFree = true;

        if (Throttler::isRequestFromBlacklistedIp($this->ip)) {
            $this->malice = Throttler::MALICE_BLACK_LISTED_IP;
            echo "Sorry.. Your IP has been blocked :(<br>";

        } elseif ($this->checkDDOSAttack && Throttler::isRequestDDOSAttack()) {
            $this->malice = Throttler::MALICE_DDOS_ATTACK;

            $this->session->incrementNumOfConsecutiveFailedRequests();

            $redirectUrl = PUBLIC_LOCAL . "too-many-request";
            redirect_to($redirectUrl);
        }


        if ($this->malice !== Throttler::MALICE_FREE) {
            $isMaliceFree = false;
        }


        return $isMaliceFree;
    }



    public static function isAjax()
    {
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            return true;
        }

        return false;
    }
}

new Request();
