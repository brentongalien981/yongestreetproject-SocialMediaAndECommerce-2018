<?php
/**
 * Created by PhpStorm.
 * User: ops
 * Date: 2017-12-19
 * Time: 17:24
 */

namespace App\Controller;

use App\Core\Main\MainController;
use App\Controller\AjaxCrudHandlerInterface;


class RateableItemUserController extends MainController implements AjaxCrudHandlerInterface
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

                $this->validator->fieldsToBeValidated['rateable_item_id'] = [
                    'required' => 1,
                    'min' => 1,
                    'max' => 12,
                    'blank' => 1,
                    'numeric' => 1
                ];

                $this->validator->fieldsToBeValidated['rate_value'] = [
                    'required' => 1,
                    'min' => 1,
                    'max' => 2,
                    'blank' => 1,
                    'numeric' => 1
                ];
                break;

            case 'read':

                $this->validator->fieldsToBeValidated['rateable_item_id'] = [
                    'required' => 1,
                    'min' => 1,
                    'max' => 12,
                    'blank' => 1
                ];

                $this->validator->fieldsToBeValidated['what_to_read'] = [
                    'required' => 1,
                    'min' => 9,
                    'max' => 16,
                    'blank' => 1
                ];
                break;
        }
    }

    /** @implement */
    public function doSpecificAjaxCrudAction()
    {
        switch ($this->action) {
            case 'update':
                $this->menuObj->rateable_item_id = $this->sanitizedFields['rateable_item_id'];;
                $this->menuObj->responder_user_id = $this->session->actual_user_id;;
                $this->menuObj->rate_value = $this->sanitizedFields['rate_value'];
                $this->menuObj->date_updated = 'CURRENT_TIMESTAMP';

                if (!$this->menuObj->doesRecordExist()) {
                    $this->action = "create";
                    // Recursive method call.
                    $this->doSpecificAjaxCrudAction();
                }
                break;
            case 'create':
                $this->menuObj->date_created = 'CURRENT_TIMESTAMP';
                break;
        }
    }

    protected function setSpecificQueryClauses()
    {

        $whatToRead = $this->sanitizedFields['what_to_read'];

        switch ($whatToRead) {
            case "rate_tags":
                $actualUserId = (isset($this->session->actual_user_id)) ? $this->session->actual_user_id : -69;
                $this->sanitizedFields['where_clause'] = "WHERE responder_user_id = {$actualUserId}";
                $this->sanitizedFields['where_clause'] .= " AND rateable_item_id = {$this->sanitizedFields['rateable_item_id']}";
                break;
            case "rate_sigma":
                $this->sanitizedFields['fields'] = "rateable_item_id, COUNT(*) AS 'count'";
                $this->sanitizedFields['where_clause'] = "WHERE rateable_item_id = {$this->sanitizedFields['rateable_item_id']}";
                $this->sanitizedFields['groupByClause'] = "GROUP BY rateable_item_id";
                $this->sanitizedFields['doNotInstantiate'] = true;
                break;
            case "rate_value_sigma":
                $this->sanitizedFields['fields'] = "rateable_item_id, COUNT(*) AS 'count', SUM(rate_value) AS 'rate_value_sum'";
                $this->sanitizedFields['where_clause'] = "WHERE rateable_item_id = {$this->sanitizedFields['rateable_item_id']}";
                $this->sanitizedFields['groupByClause'] = "GROUP BY rateable_item_id";
                $this->sanitizedFields['doNotInstantiate'] = true;
                break;
        }
    }

    /** @override */
    protected function read()
    {
        $whatToRead = $this->sanitizedFields['what_to_read'];

        $objs = null;

        switch ($whatToRead) {
            case "rate_tags":
                $objs = parent::read();
                break;

            case "rate_sigma":
            case "rate_value_sigma":

                $this->setSpecificQueryClauses();

                $objs = $this->menuObj->read_by_where_clause($this->sanitizedFields);

                break;
        }


        //
        return $objs;
    }

    /** @override */
    protected function update() {

        $dataForUpdate = [
            'rateable_item_id' => $this->database->escape_value($this->menuObj->rateable_item_id),
            'responder_user_id' => $this->database->escape_value($this->menuObj->responder_user_id)
        ];

        $whereClause = $this->menuObj::createWhereClause($dataForUpdate);
        $isCrudOk = $this->menuObj->updateByWhereClause($whereClause);
        return $isCrudOk;
    }
}