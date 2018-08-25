<?php

namespace App\Controller;

use App\Core\Main2\MainController2;
use App\Model\RateableItem;

class ItemController extends MainController2 implements AjaxCrudHandlerInterface
{

        /** @override */
    protected function setFieldsToBeValidated()
    {
        if (!$this->request->isRequestAjax) {
            return;
        }

        switch ($this->action) {
            case 'create':
            case 'update':

                if ($this->action == 'update') {
                    $this->validator->fieldsToBeValidated['id'] = [
                        'required' => 1,
                        'min' => 1,
                        'max' => 12,
                        'blank' => 1,
                        'numeric' => 1
                    ];
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

                $this->validator->fieldsToBeValidated['item_id'] = [
                    'required' => 1,
                    'min' => 1,
                    'max' => 20,
                    'blank' => 1,
                    'numeric' => 1
                ];
                break;

            case 'patch':
            case 'fetch':
            case 'index':
                break;
            case 'read':

                if (!$this->request->isRequestAjax) {
                    return;
                }

                $this->validator->fieldsToBeValidated['earliest_el_date'] = [
                    'required' => 1,
                    'min' => 19,
                    'max' => 20,
                    'blank' => 1
                ];

                $this->validator->fieldsToBeValidated['stringified_already_read_obj_ids'] = [
                    'required' => 1,
                    'min' => 0,
                    'max' => 8192,
                    'areNumeric' => 1
                ];

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

                $this->action = 'create';
                $this->doSpecificAjaxCrudAction();
                $this->action = 'update';
                $this->menuObj->id = $this->sanitizedFields['id'];
                

                break;

            case 'delete':
            case 'read':
            case 'fetch':
                break;
        }
    }


    /** @override */
    protected function read()
    {
        $userItems = \App\Model\Item::getUserItems($this->sanitizedFields);

        return $userItems;
    }


    /** @override */
    protected function update()
    {
        if ($this->request->isRequestAjax) {
            
            // 2) Update the ImageLinks.
            $updatedImageLinks = $this->menuObj->cnUpdateRelationship([
                'withClass' => 'ImageLink',
                'relationshipType' => 'oneToMany',
                'potentialAttribsOfNewObjs' => [
                    'attrName' => 'url',
                    'attrVals' => $this->sanitizedFields['photoUrls']
                ]
            ]);


            // 3) Update the Tags.
            $rateableItem = RateableItem::readByWhereClause([
                'item_x_id' => $this->menuObj->id,
                'item_x_type_id' => RateableItem::ITEM_X_TYPE_ID_ITEM
            ])[0];

            $updatedTags = $rateableItem->cnUpdateRelationship([
                'withClass' => 'Tag',
                'relationshipType' => 'manyToMany',
                'potentialAttribsOfNewObjs' => [
                    'attrName' => 'tag',
                    'attrVals' => $this->sanitizedFields['tags']
                ]
            ]);


            //
            $oldObj = \App\Model\Item::readById(['id' => $this->menuObj->id])[0];
            $this->menuObj->created_at = $oldObj->created_at;
            $this->menuObj->update();

            

            // 4) Refine the Item obj.
            $updatedObj = \App\Model\Item::readById(['id' => $this->menuObj->id])[0];
            $updatedObj->filterExclude();
            $updatedObj->imageLinks = $updatedImageLinks;
            $updatedObj->tags = $updatedTags;

            /* Add a carbon-date field to the obj. */
            $rawDateTimeFieldName = "created_at";
            $updatedObj->addReadableDateField($rawDateTimeFieldName);
            
            $updatedObj->replaceFieldNamesForAjax(['human_date' => 'created_at_human_date']);
            
            /* Add a carbon-date field to the obj. */
            $rawDateTimeFieldName = "updated_at";
            $updatedObj->addReadableDateField($rawDateTimeFieldName);
            
            $updatedObj->replaceFieldNamesForAjax(['human_date' => 'updated_at_human_date']);
            


            // 5) Return the updated Item obj.
            return $updatedObj;
        } else {
            require_once(PUBLIC_PATH . 'item/update/index.php');
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


    /**
     * @override
     * Note that we're not actually trying to delete the item,
     * but just to make its record-attribute: is_deleted to 1 or true.
     * We do this so that there would be no problem referencing the
     * item by Notifications, RateableItems, etc...
     */
    protected function delete()
    {
        // 1) Delete the RateableItemsTags mapping records.
        $rateableItem = RateableItem::readByWhereClause([
            'item_x_id' => $this->sanitizedFields['item_id'],
            'item_x_type_id' => RateableItem::ITEM_X_TYPE_ID_ITEM
        ])[0];

        $rateableItemTags = $rateableItem->getMappedObjs([
            'extentionalClassName' => 'Tag',
            'limit' => 32
        ]);

        foreach ($rateableItemTags as $rateableItemTag) {
            $rateableItemTag->cnDeleteByPk();
        }


        // 2) Delete the ImageLink records.
        $item = \App\Model\Item::readById(['id' => $this->sanitizedFields['item_id']])[0];
        $imageLinks = $item->cnHasMany([
            'extentionalClassName' => 'ImageLink',
            'limit' => 5
        ]);


        foreach ($imageLinks as $imageLink) {
            $imageLink->cnDeleteByPk();
        }


        // 3) Update the object's record attr: is_deleted to 1.
        $item->is_deleted = 1;
        $item->update();

    
        return true;
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
