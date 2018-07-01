<?php
/**
 * Created by PhpStorm.
 * User: ops
 * Date: 2018-04-06
 * Time: 16:00
 */

namespace App\Controller;

use App\Core\Main\MainController;
use phpDocumentor\Reflection\Types\Integer;


class VideoRecommendationItemController extends MainController implements AjaxCrudHandlerInterface
{
    public function __construct($menu = null, $action = null)
    {
//        sleep(1);
        parent::__construct($menu, $action);

    }

    /**
     * @implement
     * @return mixed
     */
    public function doSpecificAjaxCrudAction()
    {
        // TODO: Implement doSpecificAjaxCrudAction() method.
    }

    /** @override */
    protected function setFieldsToBeValidated()
    {

        switch ($this->action) {
            case 'create':
                break;

            case 'read':

                $this->validator->fieldsToBeValidated['rateable_item_id'] = [
                    'required' => 1,
                    'min' => 1,
                    'max' => 12,
                    'blank' => 1,
                    'numeric' => 1
                ];

                $this->validator->fieldsToBeValidated['video_id'] = [
                    'required' => 1,
                    'min' => 1,
                    'max' => 12,
                    'blank' => 1,
                    'numeric' => 1
                ];

                $this->validator->fieldsToBeValidated['stringified_video_ids_of_already_recommendeded_items'] = [
                    'required' => 1,
                    'min' => 0,
                    'max' => 8192,
                    'areNumeric' => 1
                ];

                $this->validator->fieldsToBeValidated['earliest_el_date'] = [
                    'required' => 1,
                    'min' => 19,
                    'max' => 20,
                    'blank' => 1
                ];

                break;

            case 'update':
            case 'delete':
            case 'patch':
                break;
            case 'fetch':
                break;
            case 'index':
            case 'show':
                break;
        }
    }


    /** @override */
    protected function read()
    {

        //
        $rateableItemId = $this->sanitizedFields['rateable_item_id'];
        $rateableItemData = ['id' => $rateableItemId];
        $rateableItem = \App\Model\RateableItem::readById($rateableItemData)[0];
        $referenceTags = $rateableItem->getTags();

        //
        if (count($referenceTags) == 0) {
            $this->json['comments'][] = "No reference tags provided.";
            return null;
        }

        $queryData = [
            'itemXTypeId' => $rateableItem->item_x_type_id,
            'tags' => $referenceTags,
            'referenceVideoId' => $this->sanitizedFields['video_id'],
            'stringifiedVideoIdsOfAlreadyRecommendedItems' => $this->sanitizedFields['stringified_video_ids_of_already_recommendeded_items']
        ];


        // The query string.
        $videoRecommendationItemQ = \App\Model\RecommendationItemQueryProducer::getQuery($queryData);

        //
        $videoRecommendationItemRecords = \App\Model\RateableItemTag::readByRawQuery($videoRecommendationItemQ);


        //
        $recommendedVideos = [];

        foreach ($videoRecommendationItemRecords as $recommendationItemRecord) {

            $readData = ['id' => $recommendationItemRecord['video_id']];
            $recommendedVideos[] = \App\Model\Video::readById($readData)[0];
        }

        //
        foreach ($recommendedVideos as $video) {

            // Find the extentional obj.
            $posterUser = $video->getPosterUser();

            // Filter the main obj.
            $video->filterExclude();

            // Refine the main obj.

            // Combine the extentional and main obj.
            $video->combineWithObj($posterUser);

        }

        //
        return $recommendedVideos;
    }
}