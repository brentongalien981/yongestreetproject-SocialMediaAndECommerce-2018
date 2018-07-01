<?php
/**
 * Created by PhpStorm.
 * User: ops
 * Date: 2018-02-04
 * Time: 03:52
 */

namespace App\Model;

use App\Core\MainModel;


class SocialMediaAccount extends MainModel
{
    protected static $table_name = "SocialMediaAccounts";
    protected static $className = "SocialMediaAccount";

    protected static $db_fields = array(
        "id",
        "username",
        "social_media_company_id",
        "link"
    );

    public $id;
    public $username;
    public $social_media_company_id;
    public $link;

    public function getSocialMediaCompany() {

        $fkId = $this->social_media_company_id;
        return $this->newHasOne("SocialMediaCompany", $fkId);
    }
}