<?php

use PHPUnit\Framework\TestCase;
use App\Model\Video;
use App\Model\RateableItem;
use App\Model\Tag;
use App\Model\Category;

class VideoTest extends TestCase
{

    /** @test */
    public function creates_video_with_categories()
    {
        $newVideo = $this->getSampleVideoObj();
        $creationResult = $newVideo->create();

        if (!$creationResult) {
            return false;
        }
        
        $rateableItem = $newVideo->createOneRelationship(['withModel' => RateableItem::class]);
        $rateableItem->item_x_id = $newVideo->id;
        $rateableItem->item_x_type_id = RateableItem::ITEM_X_TYPE_ID_VIDEO;
        $rateableItem->create();

        $stringifiedCategoryIds = '1,3,6';


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
        $newVideo->saveManyRelationships([
            'withClassName' => 'Category',
            'withObjs' => $categoryObjs
        ]);


        //
        $manyReadCategoryObjs = $newVideo->hasMany2('Category');

        foreach ($manyReadCategoryObjs as $i => $categoryObj) {
            $this->assertTrue(in_array($categoryObj->id, $categoryIds));
            // echo $categoryObj->id . " ==> " . $categoryObj->name . "\n";
        }
    }

    /** @test */
    public function creates_video_with_tags()
    {
        $newVideo = $this->getSampleVideoObj();
        $creationResult = $newVideo->create();

        if (!$creationResult) {
            return false;
        }
        
        $rateableItem = $newVideo->createOneRelationship(['withModel' => RateableItem::class]);
        $rateableItem->item_x_id = $newVideo->id;
        $rateableItem->item_x_type_id = RateableItem::ITEM_X_TYPE_ID_VIDEO;
        $rateableItem->create();

        $stringifiedTags = 'basketball,pinoy,kanto,basketball,kanto-boys';

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


        //
        $manyReadTagObjs = $rateableItem->hasMany2('Tag');
        foreach ($manyReadTagObjs as $i => $tagObj) {
            $this->assertTrue(in_array($tagObj->tag, $tags));
            // echo $tagObj->tag . "\n";
        }
    }

    /** @test */
    public function creates_video_with_no_tags_and_no_categories()
    {
        $newVideo = $this->getSampleVideoObj();
        $creationResult = $newVideo->create();

        if (!$creationResult) {
            return false;
        }

        $aReadVideo = Video::readById(['id' => $newVideo->id])[0];

        $this->assertEquals($newVideo->id, $aReadVideo->id);
        $this->assertEquals($newVideo->title, $aReadVideo->title);



        $rateableItem = $newVideo->createOneRelationship(['withModel' => RateableItem::class]);
        $rateableItem->item_x_id = $newVideo->id;
        $rateableItem->item_x_type_id = RateableItem::ITEM_X_TYPE_ID_VIDEO;
        $rateableItem->create();

        $aReadRateableItem = RateableItem::readById(['id' => $rateableItem->id])[0];
        
        $this->assertEquals($rateableItem->item_x_id, $aReadRateableItem->item_x_id);
        $this->assertEquals($newVideo->id, $aReadRateableItem->item_x_id);
    }


    private function getSampleVideoObj()
    {
        $newVideo = new Video();
        $newVideo->user_id = 8;
        $newVideo->title = 'A Video Title';
        $newVideo->url = 'A Video URL';
        $newVideo->private = 0;
        return $newVideo;
    }
}
