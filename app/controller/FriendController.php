<?php
/**
 * Created by PhpStorm.
 * User: ops
 * Date: 2018-02-08
 * Time: 04:44
 */

namespace App\Controller;

use App\Core\Main\MainController;

class FriendController extends MainController implements AjaxCrudHandlerInterface
{
    public function __construct($menu, $action)
    {
        parent::__construct($menu, $action);
    }

    /**
     * @return mixed
     */
    public function doSpecificAjaxCrudAction()
    {
        // TODO: Implement doSpecificAjaxCrudAction() method.
    }

    protected function setSpecificQueryClauses()
    {

        switch ($this->action) {
            case 'read':

                $this->sanitizedFields['id'] = $this->session->currently_viewed_user_id;
                break;

        }
    }

    /** @override */
    protected function read()
    {
        //
        $this->setSpecificQueryClauses();

        //
        $userPath = "\\App\\Model\\" . "User";
        $data = $this->sanitizedFields;


        $currentUser = $userPath::readById($data)[0];


        $friends = $currentUser->getFriends();

        foreach ($friends as $friend) {

            // 1) find
            $socialMediaAccounts = $friend->getSocialMediaAccounts();
            $profile = $friend->getProfile();

            // 2) filter
            $profile->filterInclude(['pic_url']);

            // 3) refine
            $friend->filterInclude(['user_name']);

            // 4) combine
            $friend->socialMediaAccounts = $socialMediaAccounts;
            $friend->profile = $profile;
        }


        //
        return $friends;
    }
}