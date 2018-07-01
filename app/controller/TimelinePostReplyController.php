<?php
/**
 * Created by PhpStorm.
 * User: ops
 * Date: 2017-12-19
 * Time: 11:44
 */

namespace App\Controller;

use App\Core\Main\MainController;
use App\Controller\AjaxCrudHandlerInterface;

class TimelinePostReplyController extends MainController implements AjaxCrudHandlerInterface
{
    /** @implement */
    public function doSpecificAjaxCrudAction()
    {
        switch ($this->action) {
            case 'create':

                $this->menuObj->id = null;
                $this->menuObj->parent_post_id = $this->sanitizedFields['parent_post_id'];
                $this->menuObj->owner_user_id = $this->session->currently_viewed_user_id;
                $this->menuObj->poster_user_id = $this->session->actual_user_id;
                $this->menuObj->message = $this->sanitizedFields['message'];
                $this->menuObj->date_posted = 'CURRENT_TIMESTAMP';
                $this->menuObj->date_updated = 'CURRENT_TIMESTAMP';

                break;

            case 'update':
            case 'delete':
                break;
            case 'read':
                break;
        }
    }

    public function __construct($menu, $action)
    {
        parent::__construct($menu, $action);
    }

    /** @override */
    protected function doRequestFinalization($isCrudOk)
    {

        //
        if ($this->action == "create" && $isCrudOk) {
            $this->json['timelinePostReplyId'] = $this->menuObj->id;
        }

        //
        parent::doRequestFinalization($isCrudOk);

    }

    protected function setSpecificQueryClauses() {

        switch ($this->action) {
            case 'read':

                // Further modify the query.
                if ($this->sanitizedFields['latestTimelinePostReplyDate'] == "0000-00-00 00:00:00") {
                    $this->sanitizedFields['latestTimelinePostReplyDate'] = "CURRENT_TIMESTAMP";
                }

                //
                $this->sanitizedFields['where_clause'] = "WHERE owner_user_id = {$this->session->currently_viewed_user_id}";
                $this->sanitizedFields['where_clause'] .= " AND parent_post_id = {$this->sanitizedFields['timeline_post_id']}";
                $this->sanitizedFields['where_clause'] .= " AND date_posted > '{$this->sanitizedFields['latestTimelinePostReplyDate']}'";

                //
                $this->sanitizedFields['order_by_field'] = "date_posted";
                $this->sanitizedFields['order_arrangement'] = "ASC";

                break;
        }
    }

    protected function read() {

        $this->setSpecificQueryClauses();

        $objs = $this->menuObj->read_by_where_clause($this->sanitizedFields);

        foreach ($objs as $obj) {
            $obj->isProducedBy("User");
            $obj->hasOne("Profile");
        }

        return $objs;
    }

    /** @override */
    protected function setFieldsToBeValidated() {

        switch ($this->action) {
            case 'create':

                $this->validator->fieldsToBeValidated['message'] = [
                    'required' => 1,
                    'min' => 1,
                    'max' => 1000,
                    'blank' => 1
                ];

                $this->validator->fieldsToBeValidated['parent_post_id'] = [
                    'required' => 1,
                    'min' => 1,
                    'max' => 11,
                    'blank' => 1,
                    'numeric' => 1
                ];

                break;

            case 'update':
                break;

            case 'read':

                $this->validator->fieldsToBeValidated['timeline_post_id'] = [
                    'required' => 1,
                    'min' => 1,
                    'max' => 11,
                    'blank' => 1
                ];

                $this->validator->fieldsToBeValidated['latestTimelinePostReplyDate'] = [
                    'required' => 1,
                    'min' => 19,
                    'max' => 20,
                    'blank' => 1
                ];

                break;
        }
    }
}