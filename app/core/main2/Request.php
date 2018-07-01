<?php
namespace App\Core\Main2;

require __DIR__ . "/../../../vendor/autoload.php";

use App\Model\Session;


class Request {

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



    public function __construct($data = ["url" => "", "isRequetAjax" => false, "requestData" => null, "checkDDOSAttack" => true]) {

        // TODO
        echo '<h3>FILE: Request.php...</h3><br>';

        /* Initialize */
//        $this->pseudoSession = PseudoSession::getInstance();
        $this->session = \App\Model\Session::getInstance();
        $this->malice = Throttler::MALICE_FREE;

        $this->url = ($data["url"] != "") ? $data["url"] : $_SERVER['REQUEST_URI'];
        if (isset($data["ip"])) { $this->ip = $data["ip"]; }
        if (isset($data["checkDDOSAttack"])) { $this->checkDDOSAttack = $data["checkDDOSAttack"]; }
        if (isset($data["requestData"])) { $this->requestData = $data["requestData"]; }


        // Initialize page-requests and ajax-requests differently.
        $this->isRequestAjax = $this->isAjax();
        if (isset($data["isRequestAjax"]) && $data["isRequestAjax"]) {
            $this->isRequestAjax = true;
        }


        /* Set the request vars. */
        \App\Core\CnUrlParser::setRequestVars($this);



        //
        try {

            if (!$this->checkMalice()) { return; }
            if (!$this->checkAccessConstraints()) { return; }
            $this->checkLogInCredentials();

            if (!Middleware::checkAuthorization($this)) {
                echo '\n************************\n';
                echo "TODO: UNAUTHORIZED\n";
                echo "TODO: REDIRECT TO A 'page-not-found' page..\n";
            }


            Router::route($this);

        }
        catch (\Exception $e) {
            if (!$this->isAjax()) {

                echo "\nEXCEPTION CAUGHT...\nOops! There's a problem with the request...\n";
                echo "$e\n";
            }
        }




    }



    private function checkLogInCredentials() {

        $checkMsg = null;

        //
        if (!isset($this->pseudoSession->userType)) {
            Cookie::setCookieSession($checkMsg);
        }

    }



    private function checkAccessConstraints() {

        $doesCheckPass = false;
        $numOfConsecutiveFailedRequests = $this->pseudoSession->consecutive_failed_requests;


        if ($numOfConsecutiveFailedRequests >= static::MAX_NUM_OF_CONSECUTIVE_FAILED_REQUESTS) {

            // TODO: Test this.
            Throttler::addToBlacklistedIps($this->ip);

            // TODO: Comment out this on implementation.
            echo "\nACCESS RESTRICTED!!!\n";

            // TODO: Redirect the request to page: redeem-access.php.
            echo "TODO: Redirect the request to page: redeem-access.php.";

        }
        else if ($numOfConsecutiveFailedRequests == 0) {

            $doesCheckPass = true;

            // TODO: Comment out this on implementation.
            // TODO: A real human-request.
            echo "\nACCESS PERMITTED!!!\n";

        } else {

            // TODO: Comment out this on implementation.
            echo "TODO: Redirect the request to page: too-many-requests.php.";

            echo "\nACCESS THROTTLED!!!\n";
        }



        if ($doesCheckPass) { $this->isAccessConstrained = false; }

        return $doesCheckPass;
    }



    /**
     * @return bool false if the request has no malice. Positive int
     * if there's malice.
     */
    private function checkMalice() {

        $isMaliceFree = true;

        if (Throttler::isRequestFromBlacklistedIp($this->ip)) {
            $this->malice = Throttler::MALICE_BLACK_LISTED_IP;
        }
        else if ($this->checkDDOSAttack && Throttler::isRequestDDOSAttack()) {
            $this->malice = Throttler::MALICE_DDOS_ATTACK;

            $this->pseudoSession->incrementNumOfConsecutiveFailedRequests();
        }


        if ($this->malice !== Throttler::MALICE_FREE) { $isMaliceFree = false; }


        return $isMaliceFree;
    }



    private function isAjax()
    {
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            return true;
        }

        return false;

    }



}

new Request();

?>