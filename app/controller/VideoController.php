<?php
/**
 * Created by PhpStorm.
 * User: ops
 * Date: 2018-02-18
 * Time: 03:33
 */

namespace App\Controller;

use App\Core\Main\MainController;
use App\Model\RateableItem;
use App\Model\Tag;
use App\Model\Category;

class VideoController extends MainController implements AjaxCrudHandlerInterface
{
    public function __construct($menu = null, $action = null)
    {
//        sleep(1);]
        parent::__construct($menu, $action);

        //
        $this->checkIsRequestShow();
    }

    protected function checkIsRequestShow()
    {
        //
        if ($this->action == "index" && isset($_GET['id'])) {
//            $this->setAction('show');
            $url = PUBLIC_LOCAL . "video/show.php?id={$_GET['id']}";
            redirect_to($url);
        }
    }

    protected function setSpecificQueryClauses()
    {
        switch ($this->action) {
            case 'read':

//                $this->sanitizedFields['where_clause'] = "WHERE created_at < '{$this->sanitizedFields['earliestElDate']}'";
                $this->sanitizedFields['where_clause'] = "WHERE private = 0";

                if (strlen($this->sanitizedFields['displayedVideoIds']) != 0) {
                    $this->sanitizedFields['where_clause'] .= " AND id NOT IN(" . $this->sanitizedFields['displayedVideoIds'] . ")";
                }


                $this->sanitizedFields['order_by_field'] = "created_at";
                $this->sanitizedFields['limit'] = 6;

                break;

            case 'show':
//                $this->sanitizedFields['id'] = $this->sanitizedFields['id'];
                break;

        }
    }

    /**
     * @return mixed
     */
    public function doSpecificAjaxCrudAction()
    {
        switch ($this->action) {
            case 'create':
                $this->menuObj->id = null;
                $this->menuObj->user_id = $this->session->actual_user_id;
                $this->menuObj->title = $this->sanitizedFields['title'];

                $this->menuObj->owner_name = $this->sanitizedFields['owner_name'];
                $this->menuObj->description = $this->sanitizedFields['description'];
                $this->menuObj->url = $this->sanitizedFields['url'];
                
                // $this->menuObj->private = 0;
                $this->menuObj->private = $this->sanitizedFields['private'];

                $this->menuObj->created_at = \App\Core\Main\MainModel::CURRENT_TIMESTAMP;
                $this->menuObj->updated_at = \App\Core\Main\MainModel::CURRENT_TIMESTAMP;

                break;

            case 'update':

                $this->menuObj->id = $this->sanitizedFields['id'];
                $this->menuObj->user_id = $this->session->actual_user_id;
                $this->menuObj->title = $this->sanitizedFields['title'];

                $this->menuObj->owner_name = $this->sanitizedFields['owner_name'];
                $this->menuObj->description = $this->sanitizedFields['description'];
                $this->menuObj->url = $this->sanitizedFields['url'];
                
                // $this->menuObj->private = 0;
                $this->menuObj->private = $this->sanitizedFields['private'];

                // $this->menuObj->created_at = $this->sanitizedFields[];
                $this->menuObj->updated_at = \App\Core\Main\MainModel::CURRENT_TIMESTAMP;

                break;
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
            case 'create':
            case 'update':

                if (!\App\Core\Main2\Request::isAjax()) {
                    return;
                }

                if ($this->action == 'update') {
                    $this->validator->fieldsToBeValidated['id'] = [
                        'required' => 1,
                        'min' => 1,
                        'max' => 12,
                        'blank' => 1,
                        'numeric' => 1
                    ];
                }

                $this->validator->fieldsToBeValidated['title'] = [
                    'required' => 1,
                    'min' => 1,
                    'max' => 255,
                    'blank' => 1
                ];

                $this->validator->fieldsToBeValidated['description'] = [
                    'required' => 1,
                    'min' => 0,
                    'max' => 2048
                ];

                $this->validator->fieldsToBeValidated['url'] = [
                    'required' => 1,
                    'min' => 16,
                    'max' => 512,
                    'blank' => 1,
                    'urlPrefix' => 1
                ];

                $this->validator->fieldsToBeValidated['owner_name'] = [
                    'required' => 1,
                    'min' => 0,
                    'max' => 50
                ];

                $this->validator->fieldsToBeValidated['tags'] = [
                    'required' => 1,
                    'min' => 0,
                    'max' => 1024
                ];

                $this->validator->fieldsToBeValidated['categories'] = [
                    'required' => 1,
                    'min' => 0,
                    'max' => 32,
                    'areNumeric' => 1
                ];

                $this->validator->fieldsToBeValidated['private'] = [
                    'required' => 1,
                    'blank' => 1,
                    'min' => 1,
                    'max' => 1
                ];

                break;

            case 'delete':

            case 'patch':
            case 'fetch':
            case 'index':
                break;
            case 'read':

                $this->validator->fieldsToBeValidated['displayedVideoIds'] = [
                    'min' => 0,
                    'max' => 320,
                    'areNumeric' => 1
                ];

                break;
            case 'show':
                //
                $this->validator->fieldsToBeValidated['id'] = [
                    'required' => 1,
                    'min' => 1,
                    'max' => 12,
                    'blank' => 1,
                    'numeric' => 1
                ];

                break;
        }
    }


    protected function sanitizeFieldsToBeValidated()
    {


        // Because method: Sanitizer::stripHtmlTags
        // returns '' if the parameter is false,
        // then disregard stripping it and stick with
        // the original bool value if it is actually
        // a bool value.
        if (isset($_GET['private'])) {
            if ($_GET['private'] == true) {
                $_GET['private'] = 1;
            } else {
                $_GET['private'] = 0;
            }
        } elseif (isset($_POST['private'])) {
            if ($_POST['private'] == true) {
                $_POST['private'] = 1;
            } else {
                $_POST['private'] = 0;
            }
        }

        parent::sanitizeFieldsToBeValidated();
    }

    /** @override */
    public function index()
    {
        require_once(PUBLIC_PATH . "video/index.php");
    }


    /** @override */
    protected function update()
    {
        if (\App\Core\Main2\Request::isAjax()) {
            
            // 
            $this->menuObj->updateTags([
                'tagNames' => $this->sanitizedFields['tags']
            ]);

            $this->menuObj->updateCategories([
                'categoryIds' => $this->sanitizedFields['categories']
            ]);

            $this->menuObj->update();

            return true;
        } else {
            require_once(PUBLIC_PATH . 'video/update/index.php');
        }
    }
    

    /** @override */
    protected function read()
    {
        $videos = parent::read();

        /**/
        foreach ($videos as $video) {

            // Find the extentional obj.
            $posterUser = $video->getPosterUser();

            // Filter the main obj.

            // Refine the main obj.

            // Combine the extentional and main obj.
            $video->combineWithObj($posterUser);
        }


        /**
         * Remove all the static fields of the newly morphed profile obj.
         * NOTE that I do this removing of static fields in another loop and not also in
         * the previous loop because doing so in the previous loop would remove the static
         * vars of each userProfile obj. As a result, there would be a problem when subsequent
         * lines of codes uses the static vars, like calling static::class_name will no longer
         * give a value of "Profile", but a MainController default value of "DEFAULT_CLASS_NAME".
         */
        foreach ($videos as $video) {
            $video->removeStaticFields();
        }

        //
        return $videos;
    }


    /** @override */
    protected function create()
    {
        if (\App\Core\Main2\Request::isAjax()) {

            //
            $this->menuObj->create();

            //
            $rateableItem = $this->menuObj->createOneRelationship(['withModel' => RateableItem::class]);
            $rateableItem->item_x_id = $this->menuObj->id;
            $rateableItem->item_x_type_id = RateableItem::ITEM_X_TYPE_ID_VIDEO;
            $rateableItem->create();

            $this->createVideoTags($rateableItem);
            $this->createVideoCategories();
            
            return true;
        } else {
            require_once(PUBLIC_PATH . 'video/create/index.php');
        }
    }


    private function createVideoTags($rateableItem)
    {
        $stringifiedTags = $this->sanitizedFields['tags'];
        if ($stringifiedTags == "") {
            return;
        }

        // Unique-save all the tags in the db.
        $isSavingOk = Tag::trySave(['withData' => $stringifiedTags]);


        // Now all the intended tags for the video is
        // saved. Loop through all the stringified tags and
        // read the corresponding tag-obj for that tag.
        $tags = explode(',', $stringifiedTags);
        $tagObjs = [];
    
        for ($i=0; $i < count($tags); $i++) {
            $tagName = $tags[$i];
            $tagObjs[] = Tag::readByWhereClause(['tag' => $tagName])[0];
        }
        

        // You may have read repeated tag-objs so sort out
        // the repeated ones.
        $uniqueTagObjIds = [];
        foreach ($tagObjs as $i => $tagObj) {
            if (!in_array($tagObj->id, $uniqueTagObjIds)) {
                $uniqueTagObjIds[] = $tagObj->id;
            }
        }

        $tempTagObjs = [];
        foreach ($uniqueTagObjIds as $i => $uniqueId) {
            foreach ($tagObjs as $j => $tagObj) {
                if ($tagObj->id == $uniqueId) {
                    $tempTagObjs[] = $tagObj;
                    break;
                }
            }
        }

        $tagObjs = $tempTagObjs;




        // Create the mapping-model (pivot-table...).
        $rateableItem->saveManyRelationships([
            'withClassName' => 'Tag',
            'withObjs' => $tagObjs
        ]);
    }


    private function createVideoCategories()
    {
        $stringifiedCategoryIds = $this->sanitizedFields['categories'];
        if ($stringifiedCategoryIds == "") {
            return;
        }

        // Now all the intended tags for the video is
        // saved. Loop through all the stringified-category-ids and
        // read the corresponding category-obj for that category.
        $categoryIds = explode(',', $stringifiedCategoryIds);
        $categoryObjs = [];
    
        for ($i=0; $i < count($categoryIds); $i++) {
            $categoryId = $categoryIds[$i];
            $categoryObjs[] = Category::readById(['id' => $categoryId])[0];
        }
        

        // You may have read repeated category-objs so sort out
        // the repeated ones.
        $uniqueCategoryObjIds = [];
        foreach ($categoryObjs as $i => $categoryObj) {
            if (!in_array($categoryObj->id, $uniqueCategoryObjIds)) {
                $uniqueCategoryObjIds[] = $categoryObj->id;
            }
        }

        $tempCategoryObjs = [];
        foreach ($uniqueCategoryObjIds as $i => $uniqueId) {
            foreach ($categoryObjs as $j => $categoryObj) {
                if ($categoryObj->id == $uniqueId) {
                    $tempCategoryObjs[] = $categoryObj;
                    break;
                }
            }
        }

        $categoryObjs = $tempCategoryObjs;


        // Create the mapping-model (pivot-table...).
        $this->menuObj->saveManyRelationships([
            'withClassName' => 'Category',
            'withObjs' => $categoryObjs
        ]);
    }

    /** @override */
    protected function show()
    {
        if (!\App\Core\Main2\Request::isAjax()) {
            require_once(PUBLIC_PATH . "video/show.php");
            return;
        }

        

        $videos = parent::show();

        /**/
        foreach ($videos as $video) {

            // If the video to be viewed is private and not being viewed by the
            // poster-user, then retun null.
            if ($video->private == "1") {
                if ($video->user_id != $this->session->actual_user_id) {
                    return false;
                }
            }

            // Find the extentional obj.
            $posterUser = $video->getPosterUser();
            $rateableItem = $video->getRateableItem();

            // Filter the main obj.

            // Refine the main obj.

            // Combine the extentional and main obj.
            $video->combineWithObj($posterUser);
            $video->rateableItem = $rateableItem;

            /* Add a carbon-date field to the obj. */
            $rawDateTimeFieldName = "created_at";
            $video->addReadableDateField($rawDateTimeFieldName);
        }



        /*
    Remove all the static fields of the newly morphed profile obj.
    NOTE that I do this removing of static fields in another loop and not also in
    the previous loop because doing so in the previous loop would remove the static
    vars of each userProfile obj. As a result, there would be a problem when subsequent
    lines of codes uses the static vars, like calling static::class_name will no longer
    give a value of "Profile", but a MainController default value of "DEFAULT_CLASS_NAME".
*/
        foreach ($videos as $video) {
            $video->removeStaticFields();
        }

        //
        return $videos;
    }


    /** @deprecated */
    protected function patch()
    {
    }
}
