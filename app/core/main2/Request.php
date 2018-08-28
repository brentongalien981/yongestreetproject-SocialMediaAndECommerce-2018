<?php
namespace App\Core\Main2;

require __DIR__ . "/../../../vendor/autoload.php";

use App\Model\Session;

class Request
{
    public const CRUD_TYPE_READ = 2;
    public const DEFAULT_CONTROLLER_NAME = "home";
    public const CRUD_TYPE_INDEX = "index";

    // TODO: Change these values later.
    public const TIME_INTERVAL_CONSTRAINT_PER_PAGE_REQUEST = 1;
    public const MAX_NUM_OF_CONSECUTIVE_FAILED_REQUESTS = 100;

    public $url;
    public $workableUrl;
    public $isRequestAjax;
    public $controllerName;
    public $modelName;
    public $controllerAction;
    public $requestForObjectId;
    public $requestData;
    private $isInDevelopmentMode = true;
    // private $isInDevelopmentMode = false;

    private $session;
    private $ip = "127.0.0.1";
    public $malice;
    private $checkDDOSAttack = true;
    public $isAccessConstrained = true;
    public $isLogInCredentialsValid = null;

    public $isUsingRecipeFramework = false;



    public function __construct($data = ["url" => "", "isRequetAjax" => false, "requestData" => null, "checkDDOSAttack" => true])
    {

        /* Initialize */
        $this->session = Session::getInstance();
        $this->malice = Throttler::MALICE_FREE;

        $this->url = ($data["url"] != "") ? $data["url"] : $_SERVER['REQUEST_URI'];
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


        /** */
        try {
            
            // If it's a redirection, don't check for the request malice and constraints.
            if (isset($_SESSION['isInTheProcessOfRedirection']) && $_SESSION['isInTheProcessOfRedirection']) {
                $_SESSION['isInTheProcessOfRedirection'] = false;
            } else {

                //
                CnUrlParser::setUrl($this->url);


                /* Set the request vars. */
                $isUsingOldCnRequestScheme = CnUrlParser::setRequestVars($this);

        


                /* */
                if ($this->isRequestForFrontEndFiles()) {
                    return;
                }

                if ($this->isRequestSpecialCase()) {
                    Router::route($this);
                    return;
                }

                // // TODO: Remove this.
                // $this->session->setNumOfConsecutiveFailedRequests(0);



                if (!$this->checkMalice()) {
                    return;
                }

                if (!$this->checkAccessConstraints()) {
                    return;
                }
            }


            $this->checkLogInCredentials();

            if (!Middleware::checkAuthorization($this)) {
                echo '\n************************\n';
                echo "<br>";
                echo "TODO: UNAUTHORIZED\n";
                echo "<br>";
                echo "TODO: REDIRECT TO A 'page-not-found' page..\n";
                echo "<br>";
                return;
            }

            //
            Router::route($this);

        } catch (\Exception $e) {
            
            if (self::isAjax()) {
                echo json_encode([
                    'is_result_ok' => false,
                    'comment' => null,
                    'errors' => "EXCEPTION CAUGHT...\nOops! There's a problem with the request... \n{$e}"
                ]);
            } else {
                echo "\nEXCEPTION CAUGHT...\nOops! There's a problem with the request...\n";
                echo "$e\n";
            }
        } finally {
            // RequestTimeKeeper::setLastRequestTime($this);
            RequestTimeKeeper::updateVars($this);
            if (!$this->isRequestAjax) {
                
                // $this->displaySomeSessionVars();
            }
        }
    }


    /** For development use only. */
    private function displaySomeSessionVars()
    {

        // var_dump($_SESSION);

        $a = 'latest_minute_basis_request_time_for_' . $this->controllerName . '_' . $this->controllerAction;
                
        $b = 'num_of_requests_for_the_last_basis_minute_for_' . $this->controllerName . '_' . $this->controllerAction;
                
        echo "^^^^^^^^^^^^^^^^^^^^<br>";
        echo "^^^^^^^^^^^^^^^^^^^^<br>";
        echo "FUCKING a for controller::{$this->controllerName}-{$this->controllerAction}=> {$_SESSION[$a]}<br>";
        echo "@@@@@@@@@@@@@@@@@@@<br>";

        echo "^^^^^^^^^^^^^^^^^^^^<br>";
        echo "^^^^^^^^^^^^^^^^^^^^<br>";
        echo "FUCKING b for controller::{$this->controllerName}-{$this->controllerAction}=> {$_SESSION[$b]}<br>";
        echo "@@@@@@@@@@@@@@@@@@@<br>";

        echo "consecutive num of failed request ==> " . $this->session->consecutive_failed_requests;
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


    private function isRequestForFrontEndFiles()
    {
        switch ($this->controllerName) {
            case 'Js':
            case 'Css':
            case 'Img':
            case 'Cn-dependencies':
            case 'Layout':
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
     * @return bool true if the request has no malice, and
     * false otherwise.
     *
     * TODO: Note that in the method: Throttler::isRequestDDOSAttack(),
     * we skipped (for now) the checking for models: RateableItem and
     * RateableItemUser.
     */
    private function checkMalice()
    {
        $isMaliceFree = true;


        if (Throttler::isRequestFromBlacklistedIp($this->ip)) {
            $this->malice = Throttler::MALICE_BLACK_LISTED_IP;
            echo "Sorry.. Your IP has been blocked :(<br>";
        } elseif ($this->checkDDOSAttack && Throttler::isRequestPossiblyDDOSAttack($this)) {
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
