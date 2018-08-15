<?php

namespace App\Controller;

use App\Core\Main2\MainController2;

class ItemController extends MainController2 implements AjaxCrudHandlerInterface
{

        /** @override */
    protected function setFieldsToBeValidated()
    {
        switch ($this->action) {
            case 'create':
            case 'update':

                if (!$this->request->isRequestAjax) {
                    return;
                }

                $this->validator->fieldsToBeValidated['name'] = [
                    'required' => 1,
                    'min' => 1,
                    'max' => 255,
                    'blank' => 1
                ];

                $this->validator->fieldsToBeValidated['quantity'] = [
                    'required' => 1,
                    'min' => 1,
                    'max' => 11,
                    'numeric' => 1
                ];

                $this->validator->fieldsToBeValidated['description'] = [
                    'required' => 1,
                    'min' => 0,
                    'max' => 256
                ];


                $this->validator->fieldsToBeValidated['length'] = [
                    'required' => 1,
                    'min' => 1,
                    'max' => 11,
                    'numeric' => 1
                ];
                $this->validator->fieldsToBeValidated['width'] = [
                    'required' => 1,
                    'min' => 1,
                    'max' => 11,
                    'numeric' => 1
                ];
                $this->validator->fieldsToBeValidated['height'] = [
                    'required' => 1,
                    'min' => 1,
                    'max' => 11,
                    'numeric' => 1
                ];
                $this->validator->fieldsToBeValidated['weight'] = [
                    'required' => 1,
                    'min' => 1,
                    'max' => 11,
                    'numeric' => 1
                ];

    
                $this->validator->fieldsToBeValidated['photoUrls'] = [
                    'required' => 1,
                    'itemsCount' => 5,
                    'itemMin' => 12,
                    'itemMax' => 512,
                    'itemBlank' => 1,
                    'itemUrlPrefix' => 1
                ];

                $this->validator->fieldsToBeValidated['tags'] = [
                    'required' => 1,
                    'min' => 0,
                    'max' => 1024
                ];

                break;
    
            case 'delete':

            case 'patch':
            case 'fetch':
            case 'index':
                break;
            case 'read':
                break;
        }
    }

    /** @implement */
    public function doSpecificAjaxCrudAction()
    {
        switch ($this->action) {
            case 'create':
            case 'update':
            case 'delete':
            case 'read':
            case 'fetch':
                break;
        }
    }


    /** @override */
    protected function create()
    {
        if ($this->request->isRequestAjax) {
            return true;
        } else {
            require_once(PUBLIC_PATH . "item/create/index.php");
        }
    }
}
