<?php

namespace App\Core\Main2;

class Router {

    public static function route($request) {

        $controllerPath = "\\App\\Controller\\{$request->controllerName}Controller";


        $controllerObj = new $controllerPath($request->controllerName, $request->controllerAction);
    
    
        $controllerObj->doAction($request);
    }
}