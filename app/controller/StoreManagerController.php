<?php


namespace App\Controller;

use App\Core\Main2\MainController2;

class StoreManagerController extends MainController2 implements AjaxCrudHandlerInterface
{

    /** @implement */
    public function doSpecificAjaxCrudAction()
    {
        switch ($this->action) {
            case 'create':
                // $this->menuObj->id = null;
                break;
            case 'update':
            case 'delete':
            case 'read':
            case 'fetch':
                break;
        }
    }


    /** @override */
    public function index()
    {
        if (!$this->request->isRequestAjax) {

            require_once(PUBLIC_PATH . "store-manager/index/index.php");

        }
    }


}
