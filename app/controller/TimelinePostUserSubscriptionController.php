<?php
/**
 * Created by PhpStorm.
 * User: ops
 * Date: 2018-01-08
 * Time: 19:28
 */

namespace App\Controller;

use App\Core\Main\MainController;


class TimelinePostUserSubscriptionController extends MainController implements AjaxCrudHandlerInterface
{
    public function doSpecificAjaxCrudAction()
    {
        switch ($this->action) {
            case 'create':

                $this->menuObj->timeline_post_id = $this->sanitizedFields["timeline_post_id"];
                $this->menuObj->subscriber_user_id = $this->session->actual_user_id;
                $this->menuObj->subscription_date = 'CURRENT_TIMESTAMP';

                break;

            case 'read':
            case 'update':
            case 'delete':
            case 'fetch':
            case 'patch':
                break;
        }
    }

    public function __construct($menu, $action)
    {
        parent::__construct($menu, $action);
    }

    protected function setFieldsToBeValidated() {

        switch ($this->action) {
            case 'create':

                $this->validator->fieldsToBeValidated['timeline_post_id'] = [
                    'required' => 1,
                    'min' => 1,
                    'max' => 11,
                    'blank' => 1,
                    'numeric' => 1
                ];
                break;

            case 'read':
            case 'update':
            case 'delete':
            case 'fetch':
            case 'patch':
                break;
        }
    }

}