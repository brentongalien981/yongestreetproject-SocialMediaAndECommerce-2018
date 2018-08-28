<?php

namespace App\Controller;

use App\Core\Main2\MainController2;

class MyStoreController extends MainController2 implements AjaxCrudHandlerInterface
{
    /** @implement */
    public function doSpecificAjaxCrudAction()
    {
        switch ($this->action) {
    
                case 'create':
                    break;
    
                case 'update':
                    break;
    
                case 'delete':
                case 'read':
                case 'fetch':
                    break;
            }
    }

    /** @override */
    public function index() {

        if (!$this->request->isRequestAjax) {
            require_once(PUBLIC_PATH . 'my-store/index/index.php');
            return;
        }


    }
}
