<?php
/**
 * Created by PhpStorm.
 * User: ops
 * Date: 2018-02-06
 * Time: 13:16
 */

namespace App\Controller;

use App\Core\Main\MainController;

class FriendshipController extends MainController implements AjaxCrudHandlerInterface
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

                $this->sanitizedFields['where_clause'] = "WHERE user_id = {$this->session->currently_viewed_user_id}";
                break;

        }
    }


    /** @override */
    protected function read()
    {

        // Find current-main-objs.
        $friendships = parent::read();


        // Loop through each main-obj.
        foreach ($friendships as $friendship) {

            // 1) find a domain-relationship / extentional objs.
            $friend = $friendship->getFriend();
            $friendSocialMediaAccounts = $friend->getUserSocialMediaAccounts();
            $friendProfile = $friend->getProfile();

            // 2) loop through the extentional-obj
            foreach ($friendSocialMediaAccounts as $friendSocialMediaAccount) {

                // find a domain-relationship
                $socialMediaAccountDetails = $friendSocialMediaAccount->getSocialMediaAccount();
                $socialMediaCompany = $socialMediaAccountDetails->getSocialMediaCompany();

                // filter
                $friendSocialMediaAccount->filterInclude();
                $socialMediaAccountDetails->filterExclude(['id', 'social_media_company_id']);
                $socialMediaCompany->filterInclude(['name']);

                // refine
                $socialMediaAccountDetails->replaceFieldNamesForAjax(['username' => 'social_media_username']);
                $socialMediaCompany->replaceFieldNamesForAjax(['name' => 'social_media_company_name']);


                // combine
                $friendSocialMediaAccount->combineWithObj($socialMediaAccountDetails);
                $friendSocialMediaAccount->combineWithObj($socialMediaCompany);
            }

            // 3) filter current-obj
            $friendProfile->filterInclude(['pic_url']);
            $friend->filterInclude(['user_name']);
            $friendship->filterInclude(['friend_id']);

            // 4) refine current-obj

            // 5) combine current-obj to extentional obj.
            $friend->profile = $friendProfile;
            $friend->socialMediaAccounts = $friendSocialMediaAccounts;
            $friendship->friend = $friend;

        }



        //
        return $friendships;
    }
}