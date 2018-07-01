<?php
/**
 * Created by PhpStorm.
 * User: ops
 * Date: 2017-12-19
 * Time: 13:08
 */

namespace App\Controller;

use App\Core\Main\MainController;
use App\Controller\AjaxCrudHandlerInterface;


class RateableItemController extends MainController implements AjaxCrudHandlerInterface
{
    public function __construct($menu, $action)
    {
        parent::__construct($menu, $action);
    }

    /** @override */
    protected function setFieldsToBeValidated() {

        switch ($this->action) {
            case 'create':

                $this->validator->fieldsToBeValidated['item_x_id'] = [
                    'required' => 1,
                    'min' => 1,
                    'max' => 12,
                    'blank' => 1
                ];

                $this->validator->fieldsToBeValidated['item_x_type_id'] = [
                    'required' => 1,
                    'min' => 1,
                    'max' => 3,
                    'blank' => 1
                ];

                break;
            case 'update':
                break;
            case 'read':
                $this->validator->fieldsToBeValidated['post_id'] = [
                    'required' => 1,
                    'min' => 1,
                    'max' => 12,
                    'blank' => 1
                ];
                $this->validator->fieldsToBeValidated['item_x_type_id'] = [
                    'required' => 1,
                    'min' => 1,
                    'max' => 3,
                    'blank' => 1
                ];
                break;
        }
    }

    /** @implement */
    public function doSpecificAjaxCrudAction()
    {
        switch ($this->action) {
            case 'create':
                $this->menuObj->item_x_id = $this->sanitizedFields['item_x_id'];
                $this->menuObj->item_x_type_id = $this->sanitizedFields['item_x_type_id'];

                break;
            case 'read':
            case 'update':
            case 'delete':
            case 'patch':
            case 'fetch':
                break;
        }

    }

    protected function read() {
        $this->sanitizedFields['where_clause'] = "WHERE item_x_type_id = {$this->sanitizedFields['item_x_type_id']}";
        $this->sanitizedFields['where_clause'] .= " AND item_x_id = {$this->sanitizedFields['post_id']}";

        $objs = $this->menuObj->read_by_where_clause($this->sanitizedFields);

        return $objs;
    }


}