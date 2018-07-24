<?php

namespace App\Core\Main2;

use App\Core\Main\MainController;


class MainController2 extends MainController {

    protected $request;
    
    public function __construct($request = null) {

        $this->request = $request;

        $requestModelName = isset($request) ? $request->modelName : null;
        $requestControllerAction = isset($request) ? $request->controllerAction : null;
        
        parent::__construct($requestModelName, $requestControllerAction);
    }
}