<?php
/**
 * Created by PhpStorm.
 * User: ops
 * Date: 2018-01-14
 * Time: 01:59
 */

namespace App\Controller;

use App\Core\Main\MainController;


class MyPhotoController extends MainController implements AjaxCrudHandlerInterface
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

                $this->validator->fieldsToBeValidated['photo_title'] = [
                    'required' => 1,
                    'min' => 4,
                    'max' => 255,
                    'blank' => 1
                ];

                $this->validator->fieldsToBeValidated['href'] = [
                    'required' => 1,
                    'min' => 16,
                    'max' => 1024,
                    'blank' => 1,
                    'urlPrefix' => 1
                ];

                $this->validator->fieldsToBeValidated['src'] = [
                    'required' => 1,
                    'min' => 16,
                    'max' => 1024,
                    'blank' => 1,
                    'urlPrefix' => 1
                ];

                $this->validator->fieldsToBeValidated['width'] = [
                    'required' => 1,
                    'min' => 2,
                    'max' => 4,
                    'blank' => 1,
                    'numeric' => 1
                ];

                $this->validator->fieldsToBeValidated['height'] = [
                    'required' => 1,
                    'min' => 2,
                    'max' => 4,
                    'blank' => 1,
                    'numeric' => 1
                ];

                break;

            case 'update':

                $this->validator->fieldsToBeValidated['my_photo_update_photo_id'] = [
                    'required' => 1,
                    'min' => 1,
                    'max' => 12,
                    'blank' => 1
                ];

                $this->validator->fieldsToBeValidated['my_photo_update_photo_title'] = [
                    'required' => 1,
                    'min' => 4,
                    'max' => 255,
                    'blank' => 1
                ];

                $this->validator->fieldsToBeValidated['my_photo_update_href'] = [
                    'required' => 1,
                    'min' => 16,
                    'max' => 1024,
                    'blank' => 1,
                    'urlPrefix' => 1
                ];

                $this->validator->fieldsToBeValidated['my_photo_update_src'] = [
                    'required' => 1,
                    'min' => 16,
                    'max' => 1024,
                    'blank' => 1,
                    'urlPrefix' => 1
                ];

                $this->validator->fieldsToBeValidated['my_photo_update_width'] = [
                    'required' => 1,
                    'min' => 2,
                    'max' => 4,
                    'blank' => 1,
                    'numeric' => 1
                ];

                $this->validator->fieldsToBeValidated['my_photo_update_height'] = [
                    'required' => 1,
                    'min' => 2,
                    'max' => 4,
                    'blank' => 1,
                    'numeric' => 1
                ];

                break;

            case 'delete':

                $this->validator->fieldsToBeValidated['photo_id'] = [
                    'required' => 1,
                    'min' => 1,
                    'max' => 12,
                    'blank' => 1
                ];

                break;

            case 'patch':
            case 'fetch':
            case 'read':

                // Sleep because after creating a new photo, the db doesn't update quick
                // enough to read the latest photo.
                sleep(1);

                //
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
                $this->sanitizedFields['where_clause'] .= " AND user_id = {$this->session->currently_viewed_user_id}";

                // Don't show the private photos unless the account being viewed
                // is the own account.
                if (!$this->session->is_viewing_own_account()) {
                    $this->sanitizedFields['where_clause'] .= " AND private = 0";
                }

                $this->sanitizedFields['order_by_field'] = "created_at";
                $this->sanitizedFields['limit'] = 10;
                break;

        }
    }


    public function doSpecificAjaxCrudAction()
    {
        switch ($this->action) {
            case 'create':
                $this->menuObj->id = null;
                $this->menuObj->user_id = $this->session->actual_user_id;
                $this->menuObj->title = $this->sanitizedFields['photo_title'];
                $this->menuObj->href = $this->sanitizedFields['href'];

                $this->menuObj->src = $this->sanitizedFields['src'];
                $this->menuObj->width = $this->sanitizedFields['width'];
                $this->menuObj->height = $this->sanitizedFields['height'];
//                $this->menuObj->rate_value = 0;
                $this->menuObj->private = 0;

                $this->menuObj->created_at = 'CURRENT_TIMESTAMP';
                $this->menuObj->updated_at = 'CURRENT_TIMESTAMP';

                break;

            case 'update':

                $this->menuObj->id = $this->sanitizedFields['my_photo_update_photo_id'];
                $this->menuObj->title = $this->sanitizedFields['my_photo_update_photo_title'];
                $this->menuObj->href = $this->sanitizedFields['my_photo_update_href'];

                $this->menuObj->src = $this->sanitizedFields['my_photo_update_src'];
                $this->menuObj->width = $this->sanitizedFields['my_photo_update_width'];
                $this->menuObj->height = $this->sanitizedFields['my_photo_update_height'];
                $this->menuObj->updated_at = 'CURRENT_TIMESTAMP';


                break;

            case 'delete':

                $this->menuObj->id = $this->sanitizedFields['photo_id'];

                break;
            case 'read':
            case 'fetch':
                break;
        }
    }

    /** @override */
    protected function doRequestFinalization($isCrudOk)
    {

        switch ($this->action) {
            case 'read':
                $isCrudOk ? $this->json['is_viewing_own_account'] = $this->session->is_viewing_own_account() : null;
                break;
        }


        //
        parent::doRequestFinalization($isCrudOk);
    }


}