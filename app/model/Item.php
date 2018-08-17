<?php

namespace App\Model;

use App\Core\Main\MainModel;

class Item extends MainModel
{
    protected static $table_name = "Items";
    protected static $className = "Item";

    protected static $db_fields = array(
        "id",
        "user_id",
        "name",
        "description",
        "quantity",
        "price",

        "length",
        "width",
        "height",
        "weight",
        "is_deleted",
        "created_at",
        "updated_at"
    );

    public $id;
    public $user_id;
    public $name;
    public $description;
    public $quantity;
    public $price;
    public $length;
    public $width;
    public $height;
    public $weight;
    public $is_deleted;
    public $created_at;
    public $updated_at;
}