<?php

namespace App\Model;

use App\Core\Main\MainModel;

class ImageLink extends MainModel
{
    protected static $table_name = "ImageLinks";
    protected static $className = "ImageLink";

    protected static $db_fields = array(
        "id",
        "item_id",
        "url"
    );

    public $id;
    public $item_id;
    public $url;
}