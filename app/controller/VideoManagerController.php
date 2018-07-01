<?php
/**
 * Created by PhpStorm.
 * User: ops
 * Date: 2018-04-25
 * Time: 19:57
 */

namespace App\Controller;

use App\Core\Main\MainController;

class VideoManagerController extends MainController implements AjaxCrudHandlerInterface
{
    public function __construct($menu = null, $action = null)
    {
        parent::__construct($menu, $action);

    }

    /**
     * @return mixed
     */
    public function doSpecificAjaxCrudAction()
    {
        // TODO: Implement doSpecificAjaxCrudAction() method.
    }


    /** @override */
    protected function setFieldsToBeValidated()
    {

        switch ($this->action) {
            case 'create':
                break;
            case 'read':
                break;

            case 'update':
            case 'delete':
            case 'patch':
                break;
            case 'fetch':
                break;
            case 'index':
            case 'show':
                break;
        }
    }
}