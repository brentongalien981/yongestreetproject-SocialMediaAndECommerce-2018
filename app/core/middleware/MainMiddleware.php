<?php
/**
 * Created by PhpStorm.
 * User: ops
 * Date: 2017-12-11
 * Time: 09:29
 */

namespace App\Core\Middleware;

use App\Core\Main\CNMain;
use App\Model\User;


class MainMiddleware extends CNMain
{

    //
    const REGULAR_TYPES_OF_ACTIONS = 1;
    const ADMIN_TYPES_OF_ACTIONS = 2;
    const FORM_REQUEST_LOG_IN_TYPES_OF_ACTIONS = 3;
    const REGULAR_TIMELINE_POST_TYPES_OF_ACTIONS = 4;
    const AJAX_REQUEST_NOTIFICATION_TYPES_OF_ACTIONS = 5;
    const AJAX_REQUEST_PHOTO_TYPES_OF_ACTIONS = 6;
    const REGULAR_REQUEST_MY_PHOTO_TYPES_OF_ACTIONS = 7;
    const LOGGED_IN_TYPES_OF_ACTIONS = 8;

    public function isUnitTesting()
    {
        // TODO: Set this to true only when unit testing.
//        return true;
        return false;
    }


    /**
     * MainMiddleware constructor.
     */
    public function __construct()
    {
        parent::__construct();


        if ($this->isUnitTesting()) {
            return;
        }

        $requested_url = $_SERVER['REQUEST_URI'];
        $requested_url_tokens = explode("/", $requested_url);

        $numOfTokens = count($requested_url_tokens);
        $requestedMenu = $requested_url_tokens[$numOfTokens - 2];
        $requestedActionRaw = $requested_url_tokens[$numOfTokens - 1];

        //
        $strLenOfActualAction = null;

        // If it's in debug mode, remove the "DEBUG_SESSION" suffix.
        $index_of_xdebug_mode_url_suffix = strpos($requestedActionRaw, ".");
        $strLenOfActualAction = $index_of_xdebug_mode_url_suffix;

        $requestedAction = substr($requestedActionRaw, 0, $strLenOfActualAction);


        // If it's a form or ajax request and not a direct-url-view...
        if ($requestedAction == "request") {

            if (is_request_post()) {
                $requestedMenu = $_POST['menu'];
                $requestedAction = $_POST['action'];
            } else {
                $requestedMenu = $_GET['menu'];
                $requestedAction = $_GET['action'];
            }

        }


        //
        $session_user_type = User::get_user_type($this->session->actual_user_type_id);


        // TODO: DEBUG
        if ($requestedMenu == "Profile") {
            $x = 0;
        }
        //
        self::performAuthorization($requestedMenu, $requestedAction, $session_user_type);


    }

    public static function showServerInfo()
    {
        var_dump($_SERVER);
    }


    private static function getAllowedUserTypes($typesOfActionsCode, $action)
    {
        $allowedUserTypes = null;

        switch ($typesOfActionsCode) {
            case self::REGULAR_TIMELINE_POST_TYPES_OF_ACTIONS:

                switch ($action) {
                    case "index":
                    case "show":
                        $allowedUserTypes = array("guest", "logged-in", "admin");
                        break;
                    case "create":
                    case "read":
                    case "update":
                    case "delete":
                    case "fetch":
                    case "patch":
                        $allowedUserTypes = array("admin");
                        break;
                }

                break;

            case self::REGULAR_TYPES_OF_ACTIONS:

                switch ($action) {
                    case "index":
                    case "read":
                    case "fetch":
                    case "patch":
                    case "show":
                        $allowedUserTypes = array("guest", "logged-in", "admin");
                        break;
                    case "create":
                    case "update":
                    case "delete":
                        $allowedUserTypes = array("logged-in", "admin");
                        break;

                }


                break;

            case self::LOGGED_IN_TYPES_OF_ACTIONS:

                switch ($action) {
                    case "index":
                    case "read":
                    case "fetch":
                    case "create":
                    case "update":
                    case "delete":
                    case "patch":
                    case "show":
                        $allowedUserTypes = array("logged-in", "admin");
                        break;

                }


                break;


            case self::ADMIN_TYPES_OF_ACTIONS:

                $allowedUserTypes = array("admin");
                break;

            case self::FORM_REQUEST_LOG_IN_TYPES_OF_ACTIONS:

                switch ($action) {
                    case "index":
                    case "show":
                        $allowedUserTypes = array("admin");
                        break;
                    case "create":
                        $allowedUserTypes = array("guest");
                        break;
                    case "read":
                    case "fetch":
                        $allowedUserTypes = array("admin");
                        break;
                    case "update":
                        $allowedUserTypes = array("admin");
                        break;
                    case "delete":
                        $allowedUserTypes = array("logged-in", "admin");
                        break;

                }


                break;

            case self::AJAX_REQUEST_NOTIFICATION_TYPES_OF_ACTIONS:
                $allowedUserTypes = array("logged-in", "admin");
                break;

            case self::AJAX_REQUEST_PHOTO_TYPES_OF_ACTIONS:

                switch ($action) {
                    case "index":
                    case "read":
                    case "fetch":
                    case "show":
                        $allowedUserTypes = array("guest", "logged-in", "admin");
                        break;
                    case "create":
                    case "delete":
                    case "update":
                    case "patch":
                        $allowedUserTypes = array("admin");
                        break;
                }


                break;

            case self::REGULAR_REQUEST_MY_PHOTO_TYPES_OF_ACTIONS:

                $allowedUserTypes = array("logged-in", "admin");
                break;

        }

        return $allowedUserTypes;
    }

    private static function performAuthorization($menu, $action, $session_user_type)
    {
        //
        $allowedUserTypes = null;

        // Cases that start with Capital letters are for form and ajax request.
        // Lower cases are for direct-url-views requests.
        switch ($menu) {
            case "public":
            case "user":
            case "log-in":
//            case "timeline-post":
            case "TimelinePost":
            case "TimelinePostReply":
            case "RateableItem":
            case "RateableItemUser":
            case "TimelinePostUserSubscription":
            case "photo":

            case "profile":
            case "Profile":
            case "UserSocialMediaAccount":
            case "UserTopActivity":
            case "Work":
            case "Friendship":
            case "Friend":

            case "video":
            case "Video":
            case "video-playlist":
            case "Playlist":
            case "Comment":
            case "VideoRecommendationItem":
            case "UserPlaylist":
            case "Category":
                $allowedUserTypes = self::getAllowedUserTypes(self::REGULAR_TYPES_OF_ACTIONS, $action);
                break;
            case "timeline-post":
                $allowedUserTypes = self::getAllowedUserTypes(self::REGULAR_TIMELINE_POST_TYPES_OF_ACTIONS, $action);
                break;
            case "Login":
                $allowedUserTypes = self::getAllowedUserTypes(self::FORM_REQUEST_LOG_IN_TYPES_OF_ACTIONS, $action);
                break;
            case "NotificationRateableItem":
            case "NotificationTimelinePostReply":
                $allowedUserTypes = self::getAllowedUserTypes(self::AJAX_REQUEST_NOTIFICATION_TYPES_OF_ACTIONS, $action);
                break;
            case "Photo":
                $allowedUserTypes = self::getAllowedUserTypes(self::AJAX_REQUEST_PHOTO_TYPES_OF_ACTIONS, $action);
                break;
            case "my-photo":
            case "MyPhoto":
                $allowedUserTypes = self::getAllowedUserTypes(self::REGULAR_REQUEST_MY_PHOTO_TYPES_OF_ACTIONS, $action);
                break;
            case "video-manager":
                $allowedUserTypes = self::getAllowedUserTypes(self::LOGGED_IN_TYPES_OF_ACTIONS, $action);
                break;
            default:
                $allowedUserTypes = array("unauthorized-user");

        }


        //
        $isUserAuthorized = false;
        foreach ($allowedUserTypes as $allowedUserType) {
            if ($allowedUserType == $session_user_type) {
                $isUserAuthorized = true;
                break;
            }
        }


        //
        if (!$isUserAuthorized) {
//            $url = LOCAL . "app/public/failedauthorization/index.php";
            redirect_to(PUBLIC_LOCAL . "failed-authorization/index.php");
//            redirect_to($url);
        } else {
//            echo "AUTHORIZATION SUCCESS!<br>";
        }
    }

    private static function isRequestAjax()
    {
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            return true;
        }

        return false;

    }
}

?>