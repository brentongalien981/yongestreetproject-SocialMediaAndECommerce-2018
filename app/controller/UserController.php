<?php
/**
 * Created by PhpStorm.
 * Photo: ops
 * Date: 2017-08-17
 * Time: 20:08
 */

namespace App\Controller;


use App\Core\Main\MainController;

class UserController extends MainController
{
    public function __construct($menu, $action)
    {
        parent::__construct($menu, $action);

    }

    /** @override */
    public function index() {
        $this->sanitizedFields['user_name'] = $this->session->actual_user_name;
        $this->show();

        redirect_to(PUBLIC_LOCAL . "timeline-post/index.php");
    }


    protected function show()
    {

        $usernameToView = $this->sanitizedFields['user_name'];
        $userToView = \App\Model\User::readByUserName($usernameToView);
        $isAllowedToView = false;

        // Does user exist?
        if (isset($userToView)) {

            if ($userToView->private) {

                $friendId = $userToView->user_id;

                if (\App\Model\Friendship::isFollowing($friendId) ||
                    \App\Model\Profile::isTryingToViewOwnProfile($friendId)) {

                    $isAllowedToView = true;
                } else {
                    redirect_to(PUBLIC_LOCAL . "profile/profile-private.php");
                }

            }
            else {
                $isAllowedToView = true;
            }
        }
        else {
            redirect_to(PUBLIC_LOCAL . "profile/profile-non-existent.php");
        }



        //
        if ($isAllowedToView) {

            $this->session->set_currently_viewed_user($userToView->user_id, $userToView->user_name);
        }
    }
}


