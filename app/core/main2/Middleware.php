<?php

namespace App\Core\Main2;

class Middleware extends CNMain
{
    private const REGULAR_TYPES_OF_ACTIONS = 1;
    private const ADMIN_TYPES_OF_ACTIONS = 2;
    private const FORM_REQUEST_LOG_IN_TYPES_OF_ACTIONS = 3;
    private const REGULAR_TIMELINE_POST_TYPES_OF_ACTIONS = 4;
    private const AJAX_REQUEST_NOTIFICATION_TYPES_OF_ACTIONS = 5;
    private const AJAX_REQUEST_PHOTO_TYPES_OF_ACTIONS = 6;
    private const REGULAR_REQUEST_MY_PHOTO_TYPES_OF_ACTIONS = 7;
    private const LOGGED_IN_TYPES_OF_ACTIONS = 8;
    private const GUEST_TYPES_OF_ACTIONS = 9;
    private const OLD_CN_REQUEST_SCHEME_TYPES_OF_ACTIONS = 10;



    public static function checkAuthorization($request)
    {
        $allowedUserTypes = self::getAllowedUserTypesForRequest($request);

        return self::isUserAuthorized($allowedUserTypes);
    }


    private static function isUserAuthorized($allowedUserTypes)
    {
        if ($allowedUserTypes == null) {
            return false;
        }
        
        foreach ($allowedUserTypes as $allowedUserType) {
            if ($allowedUserType === self::$sSession->userType) {
                return true;
            }
        }

        return false;
    }


    
    private static function getAllowedUserTypesForRequest($request)
    {
        //
        $typeOfActionId = null;

        // Because some request may have the suffix "Controller", try to 
        // just remove it.
        $controllerName = str_replace("Controller", "", $request->controllerName);
        

        // OLD NOTE:
        // Cases that start with Capital letters are for form and ajax request.
        // Lower cases are for direct-url-views requests.
        switch ($controllerName) {
            case "Home":
            case "public":
            case "user":
            case "log-in":
            // case "timeline-post":
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
            case "VideoUserPlaylists":
            case "VideoUserPlaylistsPlugIn":

            case "Category":
                $typeOfActionId = self::REGULAR_TYPES_OF_ACTIONS;
                break;
            case "timeline-post":
                $typeOfActionId = self::REGULAR_TIMELINE_POST_TYPES_OF_ACTIONS;
                break;
            case "Login":
                $typeOfActionId = self::FORM_REQUEST_LOG_IN_TYPES_OF_ACTIONS;
                break;
            case "NotificationRateableItem":
            case "NotificationTimelinePostReply":
                $typeOfActionId = self::AJAX_REQUEST_NOTIFICATION_TYPES_OF_ACTIONS;
                break;
            case "Photo":
                $typeOfActionId = self::AJAX_REQUEST_PHOTO_TYPES_OF_ACTIONS;
                break;
            case "my-photo":
            case "MyPhoto":
                $typeOfActionId = self::REGULAR_REQUEST_MY_PHOTO_TYPES_OF_ACTIONS;
                break;
            case "video-manager":
            case "VideoManager":
                $typeOfActionId = self::LOGGED_IN_TYPES_OF_ACTIONS;
                break;
            case CnUrlParser::OLD_CN_REQUEST_SCHEME:
                $typeOfActionId = self::OLD_CN_REQUEST_SCHEME_TYPES_OF_ACTIONS;
                break;
        }


        //
        $allowedUserTypes = self::getAllowedUserTypesForTypeOfAction($typeOfActionId, $request->controllerAction);

        return $allowedUserTypes;
    }



    /**
     * @param $action The controller-action (create, read, update, ...).
     */
    private static function getAllowedUserTypesForTypeOfAction($typeOfActionId, $action)
    {
        $allowedUserTypes = null;

        switch ($typeOfActionId) {

            case self::OLD_CN_REQUEST_SCHEME_TYPES_OF_ACTIONS:
                $allowedUserTypes = array("guest", "logged-in", "admin");
                break;
            
            case self::GUEST_TYPES_OF_ACTIONS:

                switch ($action) {
                    case "index":
                        $allowedUserTypes = array("guest");
                        break;
                    default:
                        $allowedUserTypes = array("admin");
                        break;
                }

              break;
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
                    case "create":
                        $allowedUserTypes = array("guest");
                        break;
                    case "show":
                        $allowedUserTypes = array("admin");
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
}
