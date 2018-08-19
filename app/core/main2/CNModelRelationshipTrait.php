<?php

namespace App\Core\Main2;

trait CNModelRelationshipTrait
{
    public function cnBelongsToMany($data = [])
    {
        $data['relationshipType'] = 'belongsTo';
        $extentionalObjs = $this->getCnModelRelationshipObjs($data);
        return $extentionalObjs;
    }



    public function cnHasMany($data = [])
    {
        // $data['relationshipType'] = 'has';
        $extentionalObjs = $this->cnHasX($data);
        return $extentionalObjs;
    }


    private function cnHasX($data = [])
    {

        //
        $objs = [];
        $path = null;

        if (isset($data['extentionalClassName'])) {
            $path = "\\App\\Model\\" . $data['extentionalClassName'];
        } 
        else {
            return $objs;
        }
        

        // Dynamically figure out the name of the field of the extentional
        // obj based on this obj's class name and then appending the string "_id".
        $fkName = self::getPascalCasedNameOf(static::$className) . "_id";

        $pkName = isset($this->primary_key_id_name) ? $this->primary_key_id_name : $this->primaryKeyName;


        $pkValue = $this->$pkName;
        $data[$fkName] = $pkValue;


        // Then call the readByWhereClause() to get the extentional obs.
        static::reWriteClassForExemptedCases($path);

        unset($data['extentionalClassName']);
        unset($data['relationshipType']);

        $objs = $path::readByWhereClause($data);

        //
        return $objs;
    }


    public function getMappedObjs($data = []) {

        if (!isset($data['relationshipType'])) {
            $data['relationshipType'] = 'has';
        }

        $extentionalObjs = $this->getCnModelRelationshipObjs($data);
        return $extentionalObjs;
    }


    public function cnHasOne($class)
    {
        if (!isset($class)) { return null; }
        
        $path = "\\App\\Model\\" . $class;

        //
        $objs = $this->hasX($class, $path);

        //
        return $objs[0];
    }

    private function getCnModelRelationshipObjs($data = [])
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
        if ($data['relationshipType'] == 'belongsTo') {
            $extentionalClass = static::class;
            $extentionalClass = str_replace($className, $data['extentionalClassName'] . $className, $extentionalClass);
        }
        
        static::reWriteClassForExemptedCases($extentionalClass);

        //
        unset($data['extentionalClassName']);
        unset($data['relationshipType']);
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
