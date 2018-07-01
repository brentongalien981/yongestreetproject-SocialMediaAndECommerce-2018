<?php
/**
 * Created by PhpStorm.
 * User: ops
 * Date: 2018-02-04
 * Time: 03:37
 */

namespace App\Model;

use App\Core\MainModel;


class UserSocialMediaAccount extends MainModel
{
    protected static $table_name = "UserSocialMediaAccounts";
    protected static $className = "UserSocialMediaAccount";

    protected static $db_fields = array(
        "user_id",
        "social_media_account_id"
    );
//    public static $searchable_fields = array("title");

    public $user_id;
    public $social_media_account_id;

    public $primary_key_id_name = null;


    public function getSocialMediaAccount() {

        $fkId = $this->social_media_account_id;
        return $this->newHasOne("SocialMediaAccount", $fkId);
    }
}