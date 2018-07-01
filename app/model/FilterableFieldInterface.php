<?php
/**
 * Created by PhpStorm.
 * User: ops
 * Date: 2017-12-30
 * Time: 03:13
 */

namespace App\Model;


interface FilterableFieldInterface
{
    public static function setFieldsAllowedForReturn();
    public static function getFieldsAllowedForReturn();
}