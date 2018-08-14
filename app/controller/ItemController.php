<?php

namespace App\Controller;

use App\Core\Main2\MainController2;

class ItemController extends MainController2 implements AjaxCrudHandlerInterface
{

    /** @implement */
    public function doSpecificAjaxCrudAction()
    {
        switch ($this->action) {
            case 'create':
            case 'update':
            case 'delete':
            case 'read':
            case 'fetch':
                break;
        }
    }


    /** @override */
    protected function create()
    {
        if ($this->request->isRequestAjax) {

        } else {
            require_once(PUBLIC_PATH . "item/create/index.php");
        }
    }
}
