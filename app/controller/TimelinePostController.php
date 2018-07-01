<?php
namespace App\Controller;

use App\Core\Main\MainController;
use App\Controller\AjaxCrudHandlerInterface;

class TimelinePostController extends MainController implements AjaxCrudHandlerInterface
{
    public function __construct($menu, $action)
    {
//         TODO: sleep(3);
        parent::__construct($menu, $action);
    }


    /** @override */
    protected function setFieldsToBeValidated() {

        switch ($this->action) {
            case 'create':
            case 'update':
                $this->validator->fieldsToBeValidated['message'] = [
                    'required' => 1,
                    'min' => 1,
                    'max' => 1000,
                    'blank' => 1
                ];
                break;
            case 'fetch':
                $this->validator->fieldsToBeValidated['latest_timeline_post_date'] = [
                    'required' => 1,
                    'min' => 19,
                    'max' => 20,
                    'blank' => 1
                ];
                break;
            case 'read':

                $this->validator->fieldsToBeValidated['earliestTimelinePostDate'] = [
                    'required' => 1,
                    'min' => 19,
                    'max' => 20,
                    'blank' => 1
                ];
                break;
        }
    }

    protected function setSpecificQueryClauses() {

        $this->sanitizedFields['where_clause'] = "WHERE owner_user_id = {$this->session->currently_viewed_user_id}";
        $this->sanitizedFields['order_by_field'] = "date_posted";

        switch ($this->action) {
            case 'read':

                // Further modify the query.
                if ($this->sanitizedFields['earliestTimelinePostDate'] == "0000-00-00 00:00:00") {
                    $this->sanitizedFields['earliestTimelinePostDate'] = "CURRENT_TIMESTAMP";
                }

                $this->sanitizedFields['where_clause'] .= " AND date_posted < '{$this->sanitizedFields['earliestTimelinePostDate']}'";
                break;

            case 'fetch':

                // Further modify the query.
                if ($this->sanitizedFields['latest_timeline_post_date'] == "0000-00-00 00:00:00") {
                    $this->sanitizedFields['latest_timeline_post_date'] = "CURRENT_TIMESTAMP";
                }

                $this->sanitizedFields['where_clause'] .= " AND date_posted > '{$this->sanitizedFields['latest_timeline_post_date']}'";
                $this->sanitizedFields['order_arrangement'] = "ASC";
                break;

        }
    }


    protected function read() {
//        $crudAction = $this->action;
//        $isCrudOk = $this->menuObj->$crudAction($this->sanitizedFields);
//        return $isCrudOk;

        $this->setSpecificQueryClauses();

        $objs = $this->menuObj->read_by_where_clause($this->sanitizedFields);

        foreach ($objs as $obj) {
            $obj->isProducedBy("User");
            $obj->hasOne("Profile");
        }

//        // Convert obj to an array.
//        $objInArrayForm = get_object_vars($an_obj);



        return $objs;

    }

    protected function fetch() {
        $this->setSpecificQueryClauses();

        $objs = $this->menuObj->fetch($this->sanitizedFields);

        foreach ($objs as $obj) {
            $obj->isProducedBy("User");
            $obj->hasOne("Profile");
        }

        return $objs;

    }


    /** @implement */
    public function doSpecificAjaxCrudAction()
    {
        switch ($this->action) {
            case 'create':
                $this->menuObj->id = null;
                $this->menuObj->owner_user_id = $this->session->currently_viewed_user_id;
                $this->menuObj->poster_user_id = $this->session->actual_user_id;
                $this->menuObj->message = $this->sanitizedFields['message'];
                $this->menuObj->date_posted = 'CURRENT_TIMESTAMP';
                $this->menuObj->date_updated = 'CURRENT_TIMESTAMP';

                break;
            case 'read':
            case 'fetch':
                break;
        }
    }
}