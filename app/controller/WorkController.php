<?php
/**
 * Created by PhpStorm.
 * User: ops
 * Date: 2018-02-06
 * Time: 07:01
 */

namespace App\Controller;

use App\Core\Main\MainController;


class WorkController extends MainController implements AjaxCrudHandlerInterface
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

    /* @override */
    protected function setSpecificQueryClauses()
    {

        switch ($this->action) {
            case 'read':

                $this->sanitizedFields['where_clause'] = "WHERE user_id = {$this->session->currently_viewed_user_id}";
                $this->sanitizedFields['limit'] = 5;
                break;

        }
    }

    /** @override */
        protected function read() {

            $works = parent::read();


        /**/
        foreach ($works as $work) {

            $workDescriptions = $work->getWorkDescriptions();


            /* Filter the sub-objs. */
            foreach ($workDescriptions as $workDescription) {

                $workDescription->filterExclude(['work_id']);
            }


            /* Filter the objs. */
            $work->filterExclude(['id', 'user_id']);


            /* Dynamically attach objs to the parent obj. */
            $work->descriptions = $workDescriptions;
        }



        /**/
        foreach ($works as $work) {
            $work->removeStaticFields();
        }

        //
        return $works;
    }
}