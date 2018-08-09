<?php

namespace App\Core\Main2;

use App\Core\Main\MainController;

class MainController2 extends MainController
{
    public const INTENTIONALLY_NULL = -1;

    protected $request;
    
    public function __construct($request = null)
    {
        $this->request = $request;

        $requestModelName = self::INTENTIONALLY_NULL;

        if (isset($request) && isset($request->modelName)) {
            $requestModelName = $request->modelName;
        }

        $requestControllerAction = isset($request) ? $request->controllerAction : null;
        
        parent::__construct($requestModelName, $requestControllerAction);
    }

    protected function delete()
    {
        $isCrudOk = $this->menuObj->cnDeleteByPk();
        return $isCrudOk;
    }

    /** @override */
    protected function setMenuObject($menu = null) {
        if (!isset($this->menu)) { return; }
        else {
            parent::setMenuObject();
        }
    }


    /** @override */
    protected function setMenu($menu = null) {
        if ($menu == self::INTENTIONALLY_NULL) { $menu = null; }

    }
}
