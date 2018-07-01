<?php
/**
 * Created by PhpStorm.
 * User: ops
 * Date: 2018-02-05
 * Time: 01:15
 */

namespace App\Controller;

use App\Core\Main\MainController;


class UserTopActivityController extends MainController implements AjaxCrudHandlerInterface
{
    public function __construct($menu, $action)
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

    protected function setSpecificQueryClauses()
    {

        switch ($this->action) {
            case 'read':

                $this->sanitizedFields['where_clause'] = "WHERE user_id = {$this->session->currently_viewed_user_id}";
                $this->sanitizedFields['limit'] = 10;
                break;

        }
    }
}