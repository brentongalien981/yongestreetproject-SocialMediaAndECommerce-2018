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
            'index',
            'create',
            'read',
            'patch',
            'show',
            'update'
        ],
        'UserVideo' => [
            'read',
            'update',
            'delete'
        ],
        'UserPlaylist' => [
            'read'
        ],
        'Category' => [
            'index',
            'read'
        ],
        'RateableItem' => [
            'create',
            'read',
            'update',
            'delete',
            'index',
            'show',
            'patch',
            'save',
            'fetch'
        ],
        'RateableItemUser' => [
            'create',
            'read',
            'update',
            'delete',
            'index',
            'show',
            'patch',
            'save',
            'fetch'
        ],
        'Comment' => [
            'create',
            'read',
            'update',
            'delete',
            'index',
            'show',
            'patch',
            'save',
            'fetch'
        ],
        'VideoRecommendationItem' => [
            'create',
            'read',
            'update',
            'delete',
            'index',
            'show',
            'patch',
            'save',
            'fetch'
        ],
        'Playlist' => [
            'create',
            'read',
            'update',
            'delete',
            'index',
            'show',
            'patch',
            'save',
            'fetch'
        ],
        'VideoManager' => [
            'index'
        ],
        'NotificationRateableItem' => [
            'create',
            'read',
            'update',
            'delete',
            'index',
            'show',
            'patch',
            'save',
            'fetch'
        ],
        'NotificationTimelinePostReply' => [
            'create',
            'read',
            'update',
            'delete',
            'index',
            'show',
            'patch',
            'save',
            'fetch'
        ],
        'StoreManager' => [
            'index'
        ],
        'Item' => [
            'index',
            'create',
            'read',
            'update',
            'delete',
            'show'
        ],
        'MyStore' => [
            'index'
        ]
        
    ];

    public static function route($request) {

        if (!self::doesRouteForRequestExist($request)) {
            echo "TODO: Route does not exist. Redirect to 401 page...";
            return;
        }

        $controllerPath = "\\App\\Controller\\{$request->controllerName}Controller";
        
        $controllerObj = null;


        if ($request->isUsingRecipeFramework || self::isRequestConsideredUsingRecipeFramework($request->controllerName)) {
            $controllerObj = new $controllerPath($request);
        } else {
            $controllerObj = new $controllerPath($request->controllerName, $request->controllerAction);
        }
        
    
    
        $controllerObj->doAction($request);
    }


    /**
     * This is used for regular-url-request that are using
     * the Recipe Framework.
     *
     * @param [String] $controllerName
     * @return boolean
     */
    private static function isRequestConsideredUsingRecipeFramework($controllerName) {

        switch ($controllerName) {
            case 'StoreManager':
            case 'Item':
            case 'MyStore':
                return true;
            
            default:
                return false;
        }
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