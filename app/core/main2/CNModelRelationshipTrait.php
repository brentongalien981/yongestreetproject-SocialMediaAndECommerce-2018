<?php

namespace App\Core\Main2;

trait CNModelRelationshipTrait
{
    public function cnUpdateRelationship($data)
    {
        $updatedObjs = [];

        if ($data['relationshipType'] == 'oneToMany') {
            $updatedObjs = $this->cnUpdateOneToManyRelationship($data);
        } elseif ($data['relationshipType'] == 'manyToMany') {
            $updatedObjs = $this->cnUpdateManyToManyRelationship($data);
        }

        //
        foreach ($updatedObjs as $updatedObj) {
            $updatedObj->filterExclude();
        }

        return $updatedObjs;
    }



    public function cnUpdateManyToManyRelationship($data)
    {
        $extentionalClassName = $data['withClass'];
        $relationshipType = $data['relationshipType'];
        $potentialAttribsOfNewObjs = $data['potentialAttribsOfNewObjs'];


        // Try to unique save the new extentional-objs..
        // Remember that these extentional-objs are just the
        // right side of the mapping-objs, not the morped-objs.
        $attrName = $potentialAttribsOfNewObjs['attrName'];
        $attrVals = $potentialAttribsOfNewObjs['attrVals'];

        $extentionalClassPath = "\\App\\Model\\" . $extentionalClassName;

        $extentionalClassPath::staticUniqueSaveMany([
            'attrName' => $attrName,
            'attrVals' => $attrVals
        ]);



        // Try to unique read the new extentional-objs (the extentional
        // objs that at the end of the whole update process, will be
        // the remaining extentional-objs.
        $updatedExtentionalObjs = $extentionalClassPath::uniqueReadMany([
            'uniqueFieldName' => $attrName,
            'uniqueFieldValues' => $attrVals
        ]);


                
        // Get the old mapping-objs for this base-obj.
        $oldMappingObjs = $this->getMappedObjs([
            'extentionalClassName' => $extentionalClassName
        ]);
                
                
        //
        foreach ($updatedExtentionalObjs as $updatedExtentionalObj) {
                
            // Flag.
            $finding = null;
                                
            // Loop through all the oldMappingObjs.
            foreach ($oldMappingObjs as $oldMappingObj) {

                // If the currently looped updatedExtentionalObj's id
                // is equal to the oldMappingObj's fk-id
                // (ie if $tag->id == $rateableItemTag->tag_id),
                // then that means the base-obj is still referencing
                // that extentional-obj.
                // Then dynamically add a property "isStillReferenced"
                // to this mapping-obj.
                // Break the loop.

                //
                $fkName = self::getPascalCasedNameOf($extentionalClassName) . "_id";
                $fkValue = $oldMappingObj->$fkName;

                if ($updatedExtentionalObj->id == $fkValue) {
                    $oldMappingObj->isStillReferenced = true;
                    $finding = 'isStillReferenced';
                    break;
                }
            }
                

            // If there's no finding, that means that the
            // currently looped updatedExtentionalObj is a new
            // obj that is being referenced by the base-obj.
            // So create a new mapping-record for this relationship.
            if ($finding != 'isStillReferenced') {

                $this->cnCreateManyToManyRelationship([
                    'withObjs' => $updatedExtentionalObj
                ]);
            }
        }
                
                
                
        // Delete the no-longer-referenced mapping-records.
        foreach ($oldMappingObjs as $oldMappingObj) {

            if (!isset($oldMappingObj->isStillReferenced)) {
                $oldMappingObj->cnDeleteByPk();
            }
        }

        //
        return $updatedExtentionalObjs;
    }



    public function cnUpdateOneToManyRelationship($data)
    {
        $extentionalClassName = $data['withClass'];
        $relationshipType = $data['relationshipType'];
        $potentialAttribsOfNewObjs = $data['potentialAttribsOfNewObjs'];

        // Try to unique save some new extentional-objs if the
        // attrValues given for that attrName will be unique.
        // ie. Say the user already has this base-obj
        // Item: {
        //     id: 1,
        //     name: 'itemName1',
        //     imageLinks: [
        //         { id: 1, item_id: 1, url: "url.com1" },
        //         { id: 2, item_id: 1, url: "url.com2" }
        //     ]
        // }
        // Then you're trying to add new ImageLink-objs
        // [
        //     { url: 'url.com1'},
        //     { url: 'url.com3'}
        // ]
        // Then the { url: 'url.com3' } should be the only obj
        // that's added and not the other one.

        if ($relationshipType == 'oneToMany') {
            $basisObj = $this;

            $oldExtentionalObjs = $basisObj->cnHasMany([
                'extentionalClassName' => $extentionalClassName
            ]);

            // Compare if the potential-new-obj's attr-val does
            // not yet exist and being reference before using
            // attrName as the basis of uniqueness.
            $attrName = $potentialAttribsOfNewObjs['attrName'];
            $attrVals = $potentialAttribsOfNewObjs['attrVals'];
            if (!is_array($attrVals)) {
                $attrVals = explode(",", $attrVals);
            }

            $basisAttrValsOfOldExtentionalObjs = [];

            foreach ($oldExtentionalObjs as $oldExtentionalObj) {
                $basisAttrValsOfOldExtentionalObjs[] = $oldExtentionalObj->url;

                if (!in_array($oldExtentionalObj->$attrName, $attrVals)) {
                    $oldExtentionalObj->cnDeleteByPk();
                }
            }


            // Check each of the potentialAttrVals should be created
            // as a field of the newObj.
            $extentionalObjs = [];

            for ($i=0; $i < count($attrVals); $i++) {
                if (!in_array($attrVals[$i], $basisAttrValsOfOldExtentionalObjs)) {
                    $extentionalObjs[] = $basisObj->cnCreateOneToOneRelationship([
                        'withClass' => $extentionalClassName,
                        'relationshipType' => 'oneToOne',
                        'attribs' => [
                            [
                                'attrName' => $attrName,
                                'attrVal' => $attrVals[$i]
                            ]
                        ]
                    ]);
                }
            }

            //
            $updatedExtentionalObjs = $basisObj->cnHasMany([
                'extentionalClassName' => $extentionalClassName
            ]);
            return $updatedExtentionalObjs;
        }
    }


    public static function staticUniqueSave($data = [])
    {
        $result = null;

        $attr = $data['attr'];

        $doesRecordAlreadyExist = static::doesCnRecordExist([
            'tableName' => static::$table_name,
            'fields' => [
                $attr['name'] => $attr['value']
            ]

        ]);

        if (!$doesRecordAlreadyExist) {
            $obj = new static;
            $attrName = $attr['name'];
            $attrValue = $attr['value'];
            $obj->$attrName = $attrValue;
            
            try {
                $obj->create();
                $result = $obj;
            } catch (Error $e) {
                $result = "Error on method: staticSave(), class: Tag.\n Reason ==> {$e}\n";
            }
        }

        return $result;
    }


    public static function staticUniqueSaveMany($data = [])
    {
        $objs = [];

        $attrVals = $data['attrVals'];
        $attrName = $data['attrName'];

        if (is_array($attrVals)) {
            for ($i=0; $i < count($attrVals); $i++) {
                $obj = static::staticUniqueSave([
                    'attr' => [
                        'name' => $attrName,
                        'value' => $attrVals[$i]
                    ]
                ]);

                if ($obj instanceof static) {
                    $objs[] = $obj;
                }
            }
        } elseif ($attrVals != "") {
            $attrVals = explode(',', $attrVals);
            $data['attrVals'] = $attrVals;
            $objs = static::staticUniqueSaveMany($data);
        }

        return $objs;
    }


    public function cnCreateManyToManyRelationship($data)
    {
        $extentionalObjs = $data['withObjs'];
        if (!is_array($extentionalObjs)) {
            $extentionalObjs = [$extentionalObjs];
        }

        $baseObj = $this;
        $baseClassName = static::$className;
        $extentionalClassName = $extentionalObjs[0]::$className;


        // Dynamically figure out the name of the pivot table/class by
        // combining this class's name and the extentional obj's class name.
        $mappingClass = "\\App\\Model\\" . $baseClassName . $extentionalClassName;


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

            $mappingObj->create();
        }
    }



    public function cnCreateOneToOneRelationship($data)
    {
        $extentionalClassName = $data['withClass'];
        $relationshipType = $data['relationshipType'];
        $attribs = $data['attribs'];

        $extentionalClassPath = "\\App\\Model\\" . $extentionalClassName;
        

        // Dynamically figure out the name of the field of the extentional
        // obj based on this obj's class name and then appending the string "_id".
        // ex. $fkName = (i)tem_id
        $fkName = self::getPascalCasedNameOf(static::$className) . "_id";

        $baseObj = $this;
        $baseObjPkName = isset($this->primary_key_id_name) ? $this->primary_key_id_name : static::$primaryKeyName;

        $baseObjPkValue = $baseObj->$baseObjPkName;
        
        $extentionalObj = new $extentionalClassPath();
        $extentionalObj->$fkName = $baseObjPkValue;

        foreach ($attribs as $attrib) {
            $attrName = $attrib['attrName'];
            $attrVal = $attrib['attrVal'];
            $extentionalObj->$attrName = $attrVal;
        }

        $extentionalObj->create();
        $extentionalObj->filterExclude();

        return $extentionalObj;
    }



    public function cnBelongsToMany($data = [])
    {
        $data['relationshipType'] = 'belongsTo';
        $extentionalObjs = $this->getCnModelRelationshipObjs($data);
        return $extentionalObjs;
    }


    public function cnBelongsToOne($data = [])
    {
        $data['limit'] = 1;
        $objs = $this->cnBelongsToX($data);
        
        return $objs[0];
    }



    public function cnHasMany($data = [])
    {
        // $data['relationshipType'] = 'has';
        if (!isset($data['limit'])) {
            $data['limit'] = 32;
        }
        $extentionalObjs = $this->cnHasX($data);
        return $extentionalObjs;
    }


    public function cnReadManyToManyRelationship($data) {
        $extentionalClassName = $data['extentionalClassName'];

        $mappingObjs = $this->getMappingObjs($data);

        $morphedObjs = [];

        foreach ($mappingObjs as $mappingObj) {
            $morphedObjs[] = $mappingObj->cnBelongsToOne([
                'extentionalClassName' => $extentionalClassName
            ]);
        }

        return $morphedObjs;
    }


    private function cnHasX($data = [])
    {

        //
        $objs = [];
        $path = null;

        if (isset($data['extentionalClassName'])) {
            $path = "\\App\\Model\\" . $data['extentionalClassName'];
        } else {
            return $objs;
        }
        

        // Dynamically figure out the name of the field of the extentional
        // obj based on this obj's class name and then appending the string "_id".
        $fkName = self::getPascalCasedNameOf(static::$className) . "_id";

        $pkName = isset($this->primary_key_id_name) ? $this->primary_key_id_name : static::$primaryKeyName;


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


    private function cnBelongsToX($data = [])
    {

        //
        $objs = [];
        $path = null;
        $extentionalClassName = $data['extentionalClassName'];
        $foreignObj = $this;

        if (isset($data['extentionalClassName'])) {
            $path = "\\App\\Model\\" . $extentionalClassName;
        } else {
            return $objs;
        }
        

        // Dynamically figure out the name of the field of the extentional
        // obj based on this obj's class name and then appending the string "_id".
        // ie. $fkName = 'video_id' or 'tag_id'.
        $fkName = self::getPascalCasedNameOf($extentionalClassName) . "_id";
        $pkValue = $foreignObj->$fkName;
        

        $pkName = isset($data['pkName']) ? $data['pkName'] : 'id';

        $limit = isset($data['limit']) ? $data['limit'] : 32;
        $objs = $path::readByWhereClause([
            'disregardUsingPkIdForQuery' => true,
            $pkName => $pkValue,
            'limit' => $limit
        ]);

        //
        return $objs;
    }


    public function getMappingObjs($data = []) {
        return $this->getMappedObjs($data);
    }


    
    public function getMappedObjs($data = [])
    {
        if (!isset($data['relationshipType'])) {
            $data['relationshipType'] = 'has';
        }

        $extentionalObjs = $this->getCnModelRelationshipObjs($data);
        return $extentionalObjs;
    }


    public function cnHasOne($class)
    {
        if (!isset($class)) {
            return null;
        }
        
        $path = "\\App\\Model\\" . $class;

        //
        $data = [
            'extentionalClassName' => $class,
            'limit' => 1
        ];

        // $objs = $this->hasX($class, $path);
        $objs = $this->cnHasX($data);

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

        $pkName = isset($this->primary_key_id_name) ? $this->primary_key_id_name : static::$primaryKeyName;

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
        if (!isset($data['limit'])) {
            $data['limit'] = 32;
        }
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
