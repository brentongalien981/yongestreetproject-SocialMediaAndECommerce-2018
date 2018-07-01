<?php
/**
 * Created by PhpStorm.
 * User: ops
 * Date: 2018-02-04
 * Time: 03:33
 */

namespace App\Controller;

use App\Core\Main\MainController;


class UserSocialMediaAccountController extends MainController implements AjaxCrudHandlerInterface
{
    public function __construct($menu, $action)
    {
        parent::__construct($menu, $action);
    }

    /** @override */
    protected function setFieldsToBeValidated()
    {

        switch ($this->action) {
            case 'create':

            case 'update':

            case 'delete':

            case 'patch':
            case 'fetch':
                break;
            case 'read':

                break;
        }
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

        $userSocialMediaAccounts = parent::read();

        /**/
        foreach ($userSocialMediaAccounts as $userSocialMediaAccount) {

            /*  */
            $socialMediaAccount = $userSocialMediaAccount->getSocialMediaAccount();
            $socialMediaCompany = $socialMediaAccount->getSocialMediaCompany();



            /* Filter the extentional objs. */
            $socialMediaAccount->filterExclude(['id']);
            $socialMediaCompany->filterExclude(['id']);



            /* Replace some obj's field name to avoid confusion. */
            $socialMediaAccount->replaceFieldNamesForAjax(['username' => 'social_media_username']);
            $socialMediaCompany->replaceFieldNamesForAjax(['name' => 'social_media_company_name']);




            /*
             * Decide the mainly-referenced-obj (Notification),
             * and combine it with all the necessary obs.
             */
            $userSocialMediaAccount->combineWithObj($socialMediaAccount);
            $userSocialMediaAccount->combineWithObj($socialMediaCompany);
        }




        /* Remove all the static fields of the newly morphed profile obj. */
        foreach ($userSocialMediaAccounts as $userSocialMediaAccount) {
            $userSocialMediaAccount->removeStaticFields();
        }




        /**/
        return $userSocialMediaAccounts;
    }
}