<?php
/**
 * Created by PhpStorm.
 * User: ops
 * Date: 2018-01-14
 * Time: 01:59
 */

namespace App\Controller;

use App\Core\Main\MainController;


class PhotoController extends MainController implements AjaxCrudHandlerInterface
{
    public function __construct($menu, $action)
    {
        parent::__construct($menu, $action);
    }

    /** @override */
    protected function setFieldsToBeValidated()
    {

        switch ($this->action) {
            case 'create':
            case 'update':
            case 'delete':
            case 'patch':
            case 'fetch':
            case 'read':

                $this->validator->fieldsToBeValidated['earliestElDate'] = [
                    'required' => 1,
                    'min' => 19,
                    'max' => 20,
                    'blank' => 1
                ];
                break;
        }
    }

    protected function setSpecificQueryClauses()
    {

        switch ($this->action) {
            case 'read':
                $this->sanitizedFields['where_clause'] = "WHERE created_at < '{$this->sanitizedFields['earliestElDate']}'";
                $this->sanitizedFields['where_clause'] .= " AND private = 0";
                $this->sanitizedFields['order_by_field'] = "created_at";
                $this->sanitizedFields['limit'] = 10;
                break;

        }
    }


    public function doSpecificAjaxCrudAction()
    {
        switch ($this->action) {
            case 'create':

                break;
            case 'read':
            case 'fetch':
                break;
        }
    }


//    protected function read()
//    {
//        $objs = parent::read();
//
//        return $objs;
//    }

}