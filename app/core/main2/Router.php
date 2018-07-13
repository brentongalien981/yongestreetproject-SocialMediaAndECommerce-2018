<?php

namespace App\Core\Main2;

class Router {

    private static $routes = [
        'Home' => [
            'index'
        ],
        'Login' => [
            'index',
            'create',
            'delete'
        ],
        'Video' => [
            'create',
            'patch'
        ],
        'UserPlaylist' => [
            'read'
        ],
        'Category' => [
            'read'
        ]
    ];

    public static function route($request) {

        if (!self::doesRouteForRequestExist($request)) {
            echo "TODO: Route does not exist. Redirect to 401 page...";
            return;
        }

        $controllerPath = "\\App\\Controller\\{$request->controllerName}Controller";
        


        $controllerObj = new $controllerPath($request->controllerName, $request->controllerAction);
    
    
        $controllerObj->doAction($request);
    }


    public static function doesRouteForRequestExist($request) {

        $actions = isset(self::$routes[$request->controllerName]) ? self::$routes[$request->controllerName] : null;
        
        if (isset($actions)) {

            foreach ($actions as $key => $action) {
                if ($action === $request->controllerAction) {
                    return true;
                }
            }
        }

        return false;
    }
}