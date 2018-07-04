<?php
namespace App\Core\Main2;

class CnUrlParser
{
    public static function setRequestVars(Request $request)
    {
        if ($request->isRequestAjax) {
            $requestData = json_decode($request->requestData, true);

            $request->controllerName = (isset($requestData["requestForClass"])) ? $requestData["requestForClass"] : ucfirst(Request::DEFAULT_CONTROLLER_NAME);
            $request->controllerAction = (isset($requestData["crudType"])) ? $requestData["crudType"] : Request::CRUD_TYPE_INDEX;
        } else {
            //
            self::setWorkableUrl($request);
            self::setControllerName($request);
            self::setControllerAction($request);
        }
    }



    private static function setControllerAction($request)
    {
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
                $workableUrl .= $value;
            }
        }

        // echo "workableUrl ==> {$workableUrl}<br>";

        $request->workableUrl = $workableUrl;
    }
}