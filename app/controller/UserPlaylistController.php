<?php
/**
 * Created by PhpStorm.
 * User: ops
 * Date: 2018-04-13
 * Time: 19:46
 */

namespace App\Controller;

use App\Core\Main\MainController;

class UserPlaylistController extends MainController implements AjaxCrudHandlerInterface
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
    protected function read() {

        //
        $readData = [
            'user_id' => $this->session->currently_viewed_user_id,
            'created_at' => [
                'comparisonOperator' => '<',
                'value' => $this->sanitizedFields['earliest_el_date']
            ],
            'limit' => 10,
            'orderByFields' => 'created_at'
        ];

        //
        $userPlaylists = \App\Model\UserPlaylist::readByWhereClause($readData);

        //

        //
        for ($i = 0; $i < count($userPlaylists); $i++) {

            $userPlaylist = $userPlaylists[$i];

            $playlist = \App\Model\Playlist::readById(['id' => $userPlaylist->playlist_id])[0];

            if ($playlist->isGuardedForPrivacy()) {
//                unset($userPlaylists[$i]);
//                --$i;
                $userPlaylists[$i] = null;
                continue;
            }

            //
            $userPlaylist->filterInclude(['created_at']);
            $playlist->filterInclude(['id', 'title']);

            //
            $userPlaylist->playlist = $playlist;
        }


        //
        return $userPlaylists;
    }

}