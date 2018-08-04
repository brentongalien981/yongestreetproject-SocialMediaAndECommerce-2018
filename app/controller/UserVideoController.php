<?php


namespace App\Controller;

use App\Core\Main2\MainController2;
use App\Model\Video;

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

                $this->validator->fieldsToBeValidated['stringified_already_read_obj_ids'] = [
                    'required' => 1,
                    'min' => 0,
                    'max' => 8192,
                    'areNumeric' => 1
                ];

                break;

            case 'delete':

                $this->validator->fieldsToBeValidated['video_id'] = [
                    'required' => 1,
                    'min' => 1,
                    'max' => 20,
                    'blank' => 1,
                    'numeric' => 1
                ];
                break;
        }
    }

    /** @override */
    protected function read()
    {
        $userVideos = \App\Model\Video::getUserVideos($this->sanitizedFields);

        return $userVideos;
    }


    /** @override */
    protected function delete()
    {

        // 1) Delete the video-categories mapping records.
        $video = Video::readStatic(['id' => $this->sanitizedFields['video_id']])[0];
        $videoCategories = $video->cnHasMany([
            'extentionalClassName' => 'Category',
            'limit' => 16
        ]);

        foreach ($videoCategories as $category) {
            $category->cnDeleteByPk();
        }


        // 2) Delete the playlists-videos mapping records.
        $playlistVideos = $video->cnBelongsToMany([
            'extentionalClassName' => 'Playlist',
            'limit' => 32
        ]);

        foreach ($playlistVideos as $playlistVideo) {
            $playlistVideo->cnDeleteByPk();
        }


        // 3) Delete the rateableItems-tags mapping records.
        $rateableItem = $video->getRateableItemWithRefinements();
        $rateableItemTags = $rateableItem->cnHasMany([
            'extentionalClassName' => 'Tag',
            'limit' => 32
        ]);

        foreach ($rateableItemTags as $rateableItemTag) {
            $rateableItemTag->cnDeleteByPk();
        }



        // I decided not to "actually" delete the video record
        // and the reateable-item record so that the notifications
        // still reference valid info about the video.
        $video->is_deleted = 1;
        $video->update();
        // // 4) Delete the ratealbeItem record.
        // $rateableItem->cnDeleteByPk();



        // // 5) Delete the video record.
        // $video->cnDeleteByPk();

        return true;
    }
}
