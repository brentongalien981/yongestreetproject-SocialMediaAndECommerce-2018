<?php
/**
 * Created by PhpStorm.
 * User: ops
 * Date: 2018-02-04
 * Time: 03:56
 */

namespace App\Model;

use App\Core\MainModel;


class SocialMediaCompany extends MainModel
{
    protected static $table_name = "SocialMediaCompanies";
    protected static $className = "SocialMediaCompany";

    protected static $db_fields = array(
        "id",
        "name",
        "website"
    );

    public $id;
    public $name;
    public $website;
}