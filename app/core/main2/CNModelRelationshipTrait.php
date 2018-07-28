<?php

namespace App\Core\Main2;

trait CNModelRelationshipTrait
{
    public function cnHasMany($data = [])
    {
        $extentionalObjs = $this->cnHasX($data);
        return $extentionalObjs;
    }

    private function cnHasX($data = [])
    {
        $extentionalObjs = [];
        
        if (!isset($data['extentionalClassName'])) {
            return $extentionalObjs;
        }

        // Dynamically figure out the name of the field of the extentional
        // obj based on this obj's class name and then appending the string "_id".
        $classPathTokens = explode('\\', static::class);
        $className = $classPathTokens[count($classPathTokens) - 1];
        $fkName = self::getPascalCasedNameOf($className) . "_id";

        $pkName = isset($this->primary_key_id_name) ? $this->primary_key_id_name : $this->primaryKeyName;

        $pkValue = $this->$pkName;
        $data[$fkName] = $pkValue;

        
        //
        $extentionalClass = static::class . $data['extentionalClassName'];
        static::reWriteClassForExemptedCases($extentionalClass);

        //
        unset($data['extentionalClassName']);
        $extentionalObjs = $extentionalClass::readByWhereClause($data);

        return $extentionalObjs;
    }


    public static function reWriteClassForExemptedCases(&$class)
    {
        if ($class == "\\App\\Model\\UserFriend") {
            $class = "\\App\\Model\\Friendship";
        }
    }

    

    public function createOneRelationship($data = [])
    {
        if (!isset($data['withModel'])) {
            return null;
        }

        $baseObj = $this;
        $extentionalObj = null;
        $extentionalObj = new $data['withModel'];

        if (!self::isClassExemptedInCreatingOneRelationship($data['withModel'])) {
            // Save the new extentional-obj to db.
        }

        return $extentionalObj;
    }


    public function saveManyRelationships($data = [])
    {
        $baseClassName = static::$className;
        $extentionalClassName = $data['withClassName'];


        // Dynamically figure out the name of the pivot table/class by
        // combining this class's name and the extentional obj's class name.
        $mappingClass = "\\App\\Model\\" . $baseClassName . $extentionalClassName;

        $baseObj = $this;
        $extentionalObjs = $data['withObjs'];

        foreach ($extentionalObjs as $i => $extentionalObj) {

            // Dynamically figure out the FK-names of the fields of
            // the mapping class based on the 2 obj's class name and then appending the string "_id".
            $fkName1 = self::getPascalCasedNameOf($baseClassName) . "_id";
            $fkName2 = self::getPascalCasedNameOf($extentionalClassName) . "_id";

            $pkName1 = $baseObj->primary_key_id_name;
            $pkValue1 = $baseObj->$pkName1;

            $pkName2 = $extentionalObj->primary_key_id_name;
            $pkValue2 = $extentionalObj->$pkName2;

            $mappingObj = new $mappingClass;
            $mappingObj->$fkName1 = $pkValue1;
            $mappingObj->$fkName2 = $pkValue2;

            // $doesRecordAlreadyExist = $mappingObj::doesCnRecordExist([
            //     'tableName' => $mappingObj::$table_name,
            //     'fields' => [
            //         $fkName1 => $pkValue1,
            //         $fkName2 => $pkValue2
            //     ]

            // ]);

            // if (!$doesRecordAlreadyExist) {
            //     $mappingObj->create();
            // }

            $mappingObj->create();
        }
    }


    public static function isClassExemptedInCreatingOneRelationship($classPath)
    {
        switch ($classPath) {
            case 'App\Model\RateableItem':
                return true;
            default:
                return false;
        }
    }
}
