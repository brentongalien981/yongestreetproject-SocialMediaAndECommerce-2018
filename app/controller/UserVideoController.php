<?php


namespace App\Controller;

use App\Core\Main2\MainController2;

// use App\Model\RateableItem;
// use App\Model\Tag;
// use App\Model\Category;

class UserVideoController extends MainController2 implements AjaxCrudHandlerInterface
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
    protected function setFieldsToBeValidated()
    {
        switch ($this->action) {
            case 'read':

                $this->validator->fieldsToBeValidated['earliest_el_date'] = [
                    'required' => 1,
                    'min' => 19,
                    'max' => 20,
                    'blank' => 1
                ];

                break;
        }
    }

    /** @override */
    protected function read()
    {
        $userVideos = \App\Model\Video::getUserVideos();

        return $userVideos;
    }
}
