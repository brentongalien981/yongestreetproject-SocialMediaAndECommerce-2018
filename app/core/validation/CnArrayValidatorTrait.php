<?php
namespace App\Core\Validation;

trait CnArrayValidatorTrait
{
    public function validateItemsUrlPrefix($data = [])
    {

        // 1) Set local vars.
        $globalVar = null;

        if (isset($data['globalVar'])) {
            $globalVar = $data['globalVar'];
        } else {
            if (is_request_get()) {
                $globalVar = $_GET;
            } else {
                $globalVar = $_POST;
            }
        }

        $fieldNameToBeValidated = isset($data['fieldNameToBeValidated']) ? $data['fieldNameToBeValidated'] : null;

        // 2) If necessary local vars are not set, return.
        if (!isset($fieldNameToBeValidated)) {
            return false;
        }


        // 3) Validate each item in the global field.
        $isValidationProcessOk = true;
        $actualFieldValue = $globalVar[$fieldNameToBeValidated];
        
        for ($i = 0; $i < count($actualFieldValue); $i++) {

            $item = $actualFieldValue[$i];

            $itemNum = $i + 1;

            if (!$this->hasUrlPrefix($item)) {

                $isValidationProcessOk = false;
                $errorMsg = "The {$fieldNameToBeValidated} (item #{$itemNum}) is not from a safe domain.";
                $this->errors[$fieldNameToBeValidated]['itemsUrlPrefix'][] = $errorMsg;
            } 
        }

        // 
        return $isValidationProcessOk;
    }


    public function validateItemsWhiteSpace($data = [])
    {

        // 1) Set local vars.
        $globalVar = null;

        if (isset($data['globalVar'])) {
            $globalVar = $data['globalVar'];
        } else {
            if (is_request_get()) {
                $globalVar = $_GET;
            } else {
                $globalVar = $_POST;
            }
        }

        $fieldNameToBeValidated = isset($data['fieldNameToBeValidated']) ? $data['fieldNameToBeValidated'] : null;

        // 2) If necessary local vars are not set, return.
        if (!isset($fieldNameToBeValidated)) {
            return false;
        }


        // 3) Validate each item in the global field.
        $isValidationProcessOk = true;
        $actualFieldValue = $globalVar[$fieldNameToBeValidated];
        
        for ($i = 0; $i < count($actualFieldValue); $i++) {

            $item = $actualFieldValue[$i];

            $itemNum = $i + 1;

            if (!has_presence($item)) {
                $isValidationProcessOk = false;
                $errorMsg = "The {$fieldNameToBeValidated} (item #{$itemNum}) can not be blank.";
                $this->errors[$fieldNameToBeValidated]['itemsBlank'][] = $errorMsg;
            }

        }

        // 
        return $isValidationProcessOk;
    }

    public function validateItemsLength($data = [])
    {

        // 1) Set local vars.
        $globalVar = null;

        if (isset($data['globalVar'])) {
            $globalVar = $data['globalVar'];
        } else {
            if (is_request_get()) {
                $globalVar = $_GET;
            } else {
                $globalVar = $_POST;
            }
        }

        $fieldNameToBeValidated = isset($data['fieldNameToBeValidated']) ? $data['fieldNameToBeValidated'] : null;
        $limitType = isset($data['limitType']) ? $data['limitType'] : 'max';
        $limitValue = isset($data['limitValue']) ? $data['limitValue'] : null;


        // 2) If necessary local vars are not set, return.
        if (!isset($fieldNameToBeValidated) || !isset($limitValue)) {
            return false;
        }


        // 3) Validate each item in the global field.
        $isValidationProcessOk = true;
        $actualFieldValue = $globalVar[$fieldNameToBeValidated];

        for ($i = 0; $i < count($actualFieldValue); $i++) {

            $item = $actualFieldValue[$i];

            $itemNum = $i + 1;

            if ($limitType == 'min') {
                if (!has_length($item, ['min' => $limitValue])) {
                    $isValidationProcessOk = false;
                    $errorMsg = "The {$fieldNameToBeValidated} (item #{$itemNum}) has to be at least {$limitValue} characters.";
                    $this->errors[$fieldNameToBeValidated]['itemsMin'][] = $errorMsg;
                }
            } else {
                if (!has_length($item, ['max' => $limitValue])) {
                    $isValidationProcessOk = false;
                    $errorMsg = "The {$fieldNameToBeValidated} (item #{$itemNum}) has to be at most {$limitValue} characters.";
                    $this->errors[$fieldNameToBeValidated]['itemsMax'][] = $errorMsg;
                }
            }
        }

        //
        return $isValidationProcessOk;
    }


    public function validateItemsCount($data = [])
    {
        
        // 1) Set local vars.
        $globalVar = null;

        if (isset($data['globalVar'])) {
            $globalVar = $data['globalVar'];
        } else {
            if (is_request_get()) {
                $globalVar = $_GET;
            } else {
                $globalVar = $_POST;
            }
        }


        $fieldNameToBeValidated = null;
        $fieldNameToBeValidated = $data['fieldNameToBeValidated'];
        $limitType = isset($data['limitType']) ? $data['limitType'] : 'max';
        $limitValue = isset($data['limitValue']) ? $data['limitValue'] : null;


        // 2) If necessary local vars is not set, return.
        $isValidationProcessOk = false;
        if (!isset($fieldNameToBeValidated) || !isset($limitValue)) {
            return $isValidationProcessOk;
        }


        //
        $arrayOfItems = $globalVar[$fieldNameToBeValidated];


        // 3) Set the appropriate errorMsg.
        $errorMsg = null;

        if ($limitType == 'max') {
            if (count($arrayOfItems) <= $limitValue) {
                $isValidationProcessOk = true;
            } else {
                $errorMsg = "{$fieldNameToBeValidated} has to be at most {$limitValue} items.";
                $this->errors[$fieldNameToBeValidated]['itemsMaxCount'][] = $errorMsg;
            }
        } else {
            if (count($arrayOfItems) >= $limitValue) {
                $isValidationProcessOk = true;
            } else {
                $errorMsg = "{$fieldNameToBeValidated} has to be at least {$limitValue} items.";
                $this->errors[$fieldNameToBeValidated]['itemsMinCount'][] = $errorMsg;
            }
        }

        


        // // TODO: Remove this
        // echo "#########################\n";
        // echo "errorMsg ==> {$errorMsg}\n";
        // echo "#########################\n";

        //
        return $isValidationProcessOk;
    }
}
