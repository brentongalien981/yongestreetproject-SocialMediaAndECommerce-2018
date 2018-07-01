<?php
/**
 * Created by PhpStorm.
 * User: ops
 * Date: 2018-02-04
 * Time: 01:10
 */

namespace App\Model;

use App\Core\MainModel;


class Address extends MainModel
{
    protected static $table_name = "Address";
    protected static $className = "Address";

    protected static $db_fields = array(
        "id",
        "user_id",
        "address_type_code",
        "street1",
        "street2",
        "city",
        "state",
        "zip",
        "country_id",
        "phone"
    );

    public $id;
    public $user_id;
    public $address_type_code;
    public $street1;
    public $street2;
    public $city;
    public $state;
    public $zip;
    public $country_id;
    public $phone;

    public static $searchable_fields = array(
        "street1",
        "street2",
        "city",
        "state",
    );

}