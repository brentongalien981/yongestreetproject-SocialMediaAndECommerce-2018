<?php
/**
 * Created by PhpStorm.
 * User: ops
 * Date: 2018-04-06
 * Time: 18:07
 */

namespace App\Model;

use App\Core\Main\MainModel;
use PHPUnit\Framework\Error\Error;

class Tag extends MainModel
{
    protected static $table_name = "Tags";
    protected static $className = "Tag";

    protected static $db_fields = array(
        "id",
        "tag",
        "created_at",
        "updated_at"
    );

    public $id;
    public $tag;
    public $created_at;
    public $updated_at;


    public static function staticSave($data = [])
    {
        $result = null;

        $doesRecordAlreadyExist = static::doesCnRecordExist([
            'tableName' => static::$table_name,
            'fields' => [
                'tag' => $data['tag']
            ]

        ]);

        if (!$doesRecordAlreadyExist) {
            $obj = new static;
            $obj->tag = $data['tag'];
            
            try {
                $obj->create();
            } catch (Error $e) {
                $result['errors'][] = "Error on method: staticSave(), class: Tag.\n Reason ==> {$e}\n";
            }
        }

        return $result;
    }


    public static function staticSaveMany($data = [])
    {
        $results = [];

        if (!isset($data['withTags'])) { return $results; }

        $tagNames = $data['withTags'];

        if (is_array($tagNames)) {
            for ($i=0; $i < count($tagNames); $i++) {
                $results[] = static::staticSave(['tag' => $tagNames[$i]]);
            }
        } elseif ($tagNames != "") {
            $tagNames = explode(',', $tagNames);
            static::staticSaveMany(['withTags' => $tagNames]);
        }

        return $results;
    }


    public static function trySave($data = [])
    {
        if (isset($data['withData']) && is_string($data['withData'])) {
            $stringifiedTags = $data['withData'];

            $tags = explode(',', $stringifiedTags);
        
    
            for ($i=0; $i < count($tags); $i++) {
                $tagName = $tags[$i];

                $doesTagAlreadyExist = static::doesCnRecordExist([
                    'tableName' => static::$table_name,
                    'fields' => [
                        'tag' => $tagName
                    ]

                ]);

                if ($doesTagAlreadyExist) {
                    continue;
                }

                $tagObj = new Tag();
                $tagObj->tag = $tagName;
                
                try {
                    $tagObj->create();
                } catch (\Exception $e) {
                }
            }

            return true;
        } else {
            return false;
        }
    }
}
