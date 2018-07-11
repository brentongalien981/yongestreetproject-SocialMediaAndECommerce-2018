<?php
namespace App\Core\Main2;

class CnUrlParser
{
    public const OLD_CN_REQUEST_SCHEME = 'OLD_CN_REQUEST_SCHEME';

    public static function setRequestVars(Request $request)
    {
        $isUsingOldCnRequestScheme = false;

        if (self::handleOldCnRequestScheme($request)) {
            $isUsingOldCnRequestScheme = true;
        } elseif ($request->isRequestAjax) {
            // $requestData = json_decode($request->requestData, true);

            $requestData = null;
            if (is_request_get()) {
                $requestData = $_GET['request_data'];
            } else {
                $requestData = $_POST['request_data'];
            }

            $jsonDecodedRequestData = json_decode($requestData, true);
            $request->requestData = $jsonDecodedRequestData;

            $request->controllerName = (isset($jsonDecodedRequestData["modelClassName"])) ? $jsonDecodedRequestData["modelClassName"] : ucfirst(Request::DEFAULT_CONTROLLER_NAME);
            $request->controllerAction = (isset($jsonDecodedRequestData["crudType"])) ? $jsonDecodedRequestData["crudType"] : Request::CRUD_TYPE_INDEX;


            // Because some request may have the suffix "Controller", try to
            // just remove it.
            $request->controllerName = str_replace("Controller", "", $request->controllerName);
        } else {
            //
            self::setWorkableUrl($request);
            self::setControllerName($request);
            self::setControllerAction($request);
        }

        return $isUsingOldCnRequestScheme;
    }


    private static function handleOldCnRequestScheme($request)
    {

        // $oldRequestUrl = '/myPersonalProjects/yongestreetproject/app/request/request.php';

        $urlTokens = explode("/", $request->url);
        $isUsingOldRequest = false;
        
        
        foreach ($urlTokens as $token => $value) {
            if ($value === 'request') {
                $isUsingOldRequest = true;
                break;
            }
        }

        if ($isUsingOldRequest) {
            if (is_request_post()) {
                $request->controllerName = $_POST['menu'];
                $request->controllerAction = $_POST['action'];
            } else {
                // TODO:
                self::setWorkableUrlForOldScheme($request);
                self::setControllerName($request);
                self::setControllerAction($request);
            }
        }

        return $isUsingOldRequest;
    }



    private static function setControllerAction($request)
    {
        if (is_request_post()) {
            $request->controllerAction = $_POST['action'];
            return;
        }

        $workableUrlTokens = explode("/", $request->workableUrl);

        $request->controllerAction = isset($workableUrlTokens[1]) ? $workableUrlTokens[1] : Request::CRUD_TYPE_INDEX;

        switch ($request->controllerAction) {
            case '':
            case '/':
                $request->controllerAction = Request::CRUD_TYPE_INDEX;
                break;
        }
    }


    private static function setControllerName($request)
    {
        if (is_request_post()) {
            $request->controllerName = $_POST['menu'];
            return;
        }

        $workableUrlTokens = explode("/", $request->workableUrl);

        $request->controllerName = isset($workableUrlTokens[0]) ? $workableUrlTokens[0] : "home";
        // $request->controllerAction = isset($workableUrlTokens[2]) ? $workableUrlTokens[2] : "index";


        switch ($request->controllerName) {
            case '':
            case '/':
                $request->controllerName = 'Home';
                break;
            case 'too-many-request':
                $request->controllerName = 'TooManyRequest';
                break;
        }

        $request->controllerName = ucfirst($request->controllerName);
    }


    private static function setWorkableUrlForOldScheme($request)
    {
        $urlTokens = explode("/", $request->url);

        //
        $lastTokenOfUrl = null;
        $urlParamsTokens = [];

        if (isset($urlTokens)) {
            
            // Reference only the last part /index.php?p1=v1&p2=v2
            $lastTokenOfUrl = $urlTokens[count($urlTokens) - 1];

            // Remove the '?'...
            $urlParamsStr = explode("?", $lastTokenOfUrl);
            $urlParamsStr = $urlParamsStr[1];

            // Now $urlParamsStr is just 'p1=v1&p2=v2'.
            $urlParamsTokens = explode("&", $urlParamsStr);
        }



        // Now $urlParamsTokens is like this ['p1=v1', 'p2=v2']
        $workableUrl = '';

        foreach ($urlParamsTokens as $param) {
            //
            $paramKeyValuePair = explode("=", $param);

            $paramKey = $paramKeyValuePair[0];
            $paramValue = $paramKeyValuePair[1];

            if ($paramKey === 'menu' || $paramKey === 'action') {
                $workableUrl .= $paramValue . '/';
            }
        }

        //
        $request->workableUrl = $workableUrl;
    }


    private static function setWorkableUrl($request)
    {
        // echo 'In method: setWorkableUrl()<br>';

        $basePublicUrl = null;

        if (IN_DEVELOPMENT) {
            $basePublicUrl = substr(PUBLIC_LOCAL, strlen('http://localhost'));
        } else {
            $basePublicUrl = "https://www.cuteninjar.com";
        }

        // echo "request->url ==> {$request->url}<br>";

        // echo "basePublicUrl ==> {$basePublicUrl}<br>";

        $workableUrl = substr($request->url, strlen($basePublicUrl));
        $workableUrl = ($workableUrl == false) ? "/" : $workableUrl;

        // Remove the trailing '/' if it exists.
        $workableUrlTokens = explode("/", $workableUrl);
        
        $workableUrl = "";
        foreach ($workableUrlTokens as $token => $value) {
            if ($value !== "") {
                $workableUrl .= $value . "/";
            }
        }

        // echo "workableUrl ==> {$workableUrl}<br>";

        $request->workableUrl = $workableUrl;
    }
}
