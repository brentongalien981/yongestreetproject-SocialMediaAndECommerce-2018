<?php

namespace App\Controller;

use App\Core\Main2\MainController2;
use App\Model\RateableItem;

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

                $this->validator->fieldsToBeValidated['price'] = [
                    'required' => 1,
                    'min' => 1,
                    'max' => 12,
                    'numeric' => 1
                ];

                $this->validator->fieldsToBeValidated['description'] = [
                    'required' => 1,
                    'min' => 0,
                    'max' => 512
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
                    'itemsMaxCount' => 5,
                    'itemsMin' => 12,
                    'itemsMax' => 512,
                    'itemsBlank' => 1,
                    'itemsUrlPrefix' => 1
                ];

                $this->validator->fieldsToBeValidated['tags'] = [
                    'required' => 1,
                    'min' => 0,
                    'max' => 512
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

                $this->menuObj->id = null;
                $this->menuObj->user_id = $this->session->actual_user_id;
                $this->menuObj->name = $this->sanitizedFields['name'];
                $this->menuObj->description = $this->sanitizedFields['description'];

                $this->menuObj->quantity = $this->sanitizedFields['quantity'];
                $this->menuObj->price = $this->sanitizedFields['price'];

                $this->menuObj->length = $this->sanitizedFields['length'];
                $this->menuObj->width = $this->sanitizedFields['width'];
                $this->menuObj->height = $this->sanitizedFields['height'];
                $this->menuObj->weight = $this->sanitizedFields['weight'];

                $this->menuObj->is_deleted = 0;
                
                $this->menuObj->created_at = \App\Core\Main\MainModel::CURRENT_TIMESTAMP;
                $this->menuObj->updated_at = \App\Core\Main\MainModel::CURRENT_TIMESTAMP;

                // Dynamic property.
                $this->menuObj->photoUrls = $this->sanitizedFields['photoUrls'];
                break;
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

            // 1) Create the Item-obj.
            $this->menuObj->create();


            // 2) Create the ImageLinks objs.
            foreach ($this->menuObj->photoUrls as $photoUrl) {
                $imageLink = new \App\Model\ImageLink();
                $imageLink->item_id = $this->menuObj->id;
                $imageLink->url = $photoUrl;
                $imageLink->create();
            }

            
            // 3) Create the RateableItem obj.
            $rateableItem = $this->menuObj->createOneRelationship(['withModel' => RateableItem::class]);
            $rateableItem->item_x_id = $this->menuObj->id;
            $rateableItem->item_x_type_id = RateableItem::ITEM_X_TYPE_ID_ITEM;
            $rateableItem->create();

            
            // 5) Create the RateableItemsTags mapping-objs.
            $rateableItem->createRateableItemsTags([
                'tags' => $this->sanitizedFields['tags']
            ]);


            // 6) Refine the Item obj.
            $this->menuObj->doRefinements([
                'excludedProps' => ['unwantedJsonProps']
            ]);


            // 7) Return the newly created Item-obj.
            return $this->menuObj;
        } else {
            require_once(PUBLIC_PATH . "item/create/index.php");
        }
    }


    /** @override */
    protected function doRequestFinalization($isCrudOk)
    {
        switch ($this->action) {
    
                case 'create':
                case 'update':
                    
                    if ($isCrudOk instanceof \App\Model\Item) {
                        $this->json['objs'][] = $isCrudOk;
                    }
                     
                    break;
            }
    
    
        parent::doRequestFinalization($isCrudOk);
    }
}
