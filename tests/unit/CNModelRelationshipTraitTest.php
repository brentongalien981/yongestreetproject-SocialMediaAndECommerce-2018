<?php

use PHPUnit\Framework\TestCase;
use App\Core\Main2\MainModel;
use App\Model\Item;
use App\Model\RateableItem;
use App\Model\Tag;

class CNModelRelationshipTraitTest extends TestCase
{

    /** @test */
    public function cnUpdateManyToManyRelationship_test() {

        $item = Item::readById(['id' => 51])[0];
        $item->filterExclude();

        $rateableItem = RateableItem::readByWhereClause([
            'item_x_id' => $item->id,
            'item_x_type_id' => RateableItem::ITEM_X_TYPE_ID_ITEM
        ])[0];



        $updatedTags = $rateableItem->cnUpdateRelationship([
            'withClass' => 'Tag',
            'relationshipType' => 'manyToMany',
            'potentialAttribsOfNewObjs' => [
                'attrName' => 'tag',
                'attrVals' => ['tag-shit-69', 'tag-shit-71']
            ] 
        ]);


        $morphedTags = $rateableItem->cnReadManyToManyRelationship([
            'extentionalClassName' => 'Tag'
        ]);

        $this->assertEquals(count($updatedTags), count($morphedTags));


        $allUpdatedTagNames = [];
        foreach ($updatedTags as $tag) {
            $allUpdatedTagNames[] = $tag->tag;
        }
        foreach ($morphedTags as $morphedTag) {
            $this->assertTrue(in_array($morphedTag->tag, $allUpdatedTagNames));
        }


    }


    /** @test */
    public function staticUniqueSaveMany_test() {

        $item = Item::readById(['id' => 51])[0];
        $item->filterExclude();

        $rateableItem = RateableItem::readByWhereClause([
            'item_x_id' => $item->id,
            'item_x_type_id' => RateableItem::ITEM_X_TYPE_ID_ITEM
        ])[0];

        $basisObjPkName = $rateableItem->primary_key_id_name;
        $basisObjPkValue = $rateableItem->$basisObjPkName;
        $fkName = MainModel::getPascalCasedNameOf('Tag') . "_id";
        $attrName = 'tag';
        $attrVals = ['tag300', 'tag400'];

        Tag::staticUniqueSaveMany([
            'attrName' => $attrName,
            'attrVals' => $attrVals
        ]);

        $updatedTags = Tag::uniqueReadMany([
            'uniqueFieldName' => $attrName,
            'uniqueFieldValues' => $attrVals
        ]);


        $rateableItem->cnCreateManyToManyRelationship([
            'withObjs' => $updatedTags
        ]);


        $morphedTags = $rateableItem->cnReadManyToManyRelationship([
            'extentionalClassName' => 'Tag'
        ]);



        $allUpdatedTagNames = [];
        foreach ($updatedTags as $tag) {
            $allUpdatedTagNames[] = $tag->tag;
        }

        foreach ($attrVals as $attrVal) {
            $this->assertTrue(in_array($attrVal, $allUpdatedTagNames));
        }

    }


    /** @test */
    public function cnUpdateOneToManyRelationship_test() {

        $item = Item::readById(['id' => 51])[0];
        $item->filterExclude();

        $updatedImageLinks = $item->cnUpdateRelationship([
            'withClass' => 'ImageLink',
            'relationshipType' => 'oneToMany',
            'potentialAttribsOfNewObjs' => [
                'attrName' => 'url',
                'attrVals' => ['url.com1', 'url.com3']
            ]                
        ]);

        $imageLinksAfter = $item->cnHasMany([
            'extentionalClassName' => 'ImageLink'
        ]);

        $this->assertEquals(count($updatedImageLinks), count($imageLinksAfter));
    }



    /** @test */
    public function cnCreateOneToOneRelationship_test()
    {
        $item = Item::readById(['id' => 51])[0];
        $item->filterExclude();

        $imageLinksBefore = $item->cnHasMany([
            'extentionalClassName' => 'ImageLink'
        ]);

        $imageLinksCountBefore = count($imageLinksBefore);


        $newImageLinks = [];
        $newImageLinks[] = $item->cnCreateOneToOneRelationship([
            'withClass' => 'ImageLink',
            'relationshipType' => 'oneToOne',
            'attribs' => [
                [
                    'attrName' => 'url',
                    'attrVal' => 'url.com6'
                ]
            ]
        ]);

        
        $imageLinksAfter = $item->cnHasMany([
            'extentionalClassName' => 'ImageLink'
        ]);

        $imageLinksCountAfter = count($imageLinksAfter);

        $this->assertEquals($imageLinksCountAfter, $imageLinksCountBefore + 1);

        foreach ($imageLinksAfter as $imageLink) {
            echo "\n";
            echo $imageLink->id . ' <==> ' . $imageLink->item_id . ' <==> ' . $imageLink->url . "\n";
        }
    }
}