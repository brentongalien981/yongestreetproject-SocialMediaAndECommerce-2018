<?php
namespace App\Core\Validation;

// use Swift_Validate;


class Validator
{

    public $fieldsToBeValidated = [];
    public $errors = [];
    private $isOverallValidationOk = true;
    private $acceptedUrlPrefixes = [
        "https://farm5.staticflickr.com/",
        "https://www.flickr.com/photos/"
    ];

    /**
     * Validator constructor.
     */
    public function __construct()
    {
        $this->initFieldsToBeValidated();
    }


    private function initFieldsToBeValidated()
    {
        if (is_request_post()) {
            $this->fieldsToBeValidated['csrf_token'] = [
                'csrf' => 1,
                'required' => 1,
                'min' => 16

            ];
        }
    }

    public function validate()
    {
        foreach ($this->fieldsToBeValidated as $field => $validationProcesses) {

            foreach ($validationProcesses as $validationProcess => $validationProcessValue) {
                $isValidationProcessOk = false;

                switch ($validationProcess) {
                    case 'required':
                        $isValidationProcessOk = $this->validateRequiredField($field);
                        break;
                    case 'csrf':
                        $isValidationProcessOk = $this->validateCsrf($field);
                        break;
                    case 'blank':
                        $isValidationProcessOk = $this->validateWhiteSpace($field);
                        break;
                    case 'min':
                        $isValidationProcessOk = $this->validateMinLength($field);
                        break;
                    case 'max':
                        $isValidationProcessOk = $this->validateMaxLength($field);
                        break;
                    case 'numeric':
                        $isValidationProcessOk = $this->validateIsNumeric($field);
                        break;
                    case 'urlPrefix':
                        $isValidationProcessOk = $this->validateUrlPrefix($field);
                        break;
                    case 'areNumeric':
                        $isValidationProcessOk = $this->validateAreNumeric($field);
                        break;
                }

                $this->setIsOverallValidationOk($isValidationProcessOk);
            }
        }

        return $this->isOverallValidationOk;
    }


    /**
     * Basically update the $isOverallValidationOk.
     * If the isOverallValidationOk still ok, (ie it hasn’t been falsified by
     * any individual validationProcess), then go ahead set its updated value.
     * (Note that one erronous validationProcess will permanently keep
     * it false)
     * @param $isValidationProcessOk
     */
    private function setIsOverallValidationOk($isValidationProcessOk)
    {
        if ($this->isOverallValidationOk) {
            $this->isOverallValidationOk = $isValidationProcessOk;
        }
    }

    protected function validateCsrf($field)
    {

        $isValidationProcessOk = false;

        if (is_csrf_token_valid() && is_csrf_token_recent()) {
            $isValidationProcessOk = true;
        } else {
            $errorMsg = "CSRF token is not valid.";
            $this->errors[$field]['csrf'] = $errorMsg;
        }

        return $isValidationProcessOk;
    }

    protected function validateWhiteSpace($field)
    {
        $isValidationProcessOk = false;

        if (isset($_POST[$field])) {
            if (has_presence($_POST[$field])) {
                $isValidationProcessOk = true;
            }
        } else if (isset($_GET[$field])) {
            if (has_presence($_GET[$field])) {
                $isValidationProcessOk = true;
            }
        }

        if (!$isValidationProcessOk) {
            $errorMsg = "{$field} can not be blank.";
            $this->errors[$field]['blank'] = $errorMsg;
        }

        return $isValidationProcessOk;
    }

    protected function validateMinLength($field)
    {
        $isValidationProcessOk = false;

        $requiredMinValue = $this->fieldsToBeValidated[$field]['min'];
        $fieldValue = null;

        if (is_request_post()) {
            $fieldValue = $_POST[$field];
        } else {
            $fieldValue = $_GET[$field];
        }


        if (has_length($fieldValue, ['min' => $requiredMinValue])) {
            $isValidationProcessOk = true;
        } else {
            $errorMsg = "{$field} has to be at least {$requiredMinValue} characters.";
            $this->errors[$field]['min'] = $errorMsg;
        }

        return $isValidationProcessOk;
    }


    protected function validateMaxLength($field)
    {
        $isValidationProcessOk = false;

        $requiredMaxValue = $this->fieldsToBeValidated[$field]['max'];
        $fieldValue = null;

        if (is_request_post()) {
            $fieldValue = $_POST[$field];
        } else {
            $fieldValue = $_GET[$field];
        }


        if (has_length($fieldValue, ['max' => $requiredMaxValue])) {
            $isValidationProcessOk = true;
        } else {
            $errorMsg = "{$field} has to be less than or equal to {$requiredMaxValue} characters.";
            $this->errors[$field]['max'] = $errorMsg;
        }

        return $isValidationProcessOk;
    }


    protected function validateIsNumeric($field)
    {
        $isValidationProcessOk = false;


        $fieldValue = null;


        if (is_request_post()) {
            $fieldValue = $_POST[$field];
        } else {
            $fieldValue = $_GET[$field];
        }


        if ($this->isValueNumeric($fieldValue)) {
            $isValidationProcessOk = true;
        } else {
            $errorMsg = "{$field} has to be a number.";
            $this->errors[$field]['numeric'] = $errorMsg;
        }

        return $isValidationProcessOk;
    }

    protected function validateAreNumeric($field)
    {
        // TODO: If the length of the string is 0, return true.


        $isValidationProcessOk = true;


        //
        $stringifiedIds = null;

        if (is_request_post()) {
            $stringifiedIds = $_POST[$field];
        } else {
            $stringifiedIds = $_GET[$field];
        }


        // Convert the ids to an array.
        $arrayOfIds = explode(",", $stringifiedIds);
//        $numOfIds = count($arrayOfIds);


        // Loop through the array.
        foreach ($arrayOfIds as $id) {

            // Check if each one is numeric.
            if (!$this->isValueNumeric($id)) {

                $isValidationProcessOk = false;
                $errorMsg = "{$field} has to be a string of numbers.";
                $this->errors[$field]['areNumeric'] = $errorMsg;

                break;
            }
        }


        return $isValidationProcessOk;
    }


    protected function validateUrlPrefix($field)
    {
        $isValidationProcessOk = false;


        $fieldValue = null;


        if (is_request_post()) {
            $fieldValue = $_POST[$field];
        } else {
            $fieldValue = $_GET[$field];
        }

        $rawUrl = $fieldValue;

        if ($this->hasUrlPrefix($rawUrl)) {
            $isValidationProcessOk = true;
        } else {
            $errorMsg = "{$field} is not valid.";
            $this->errors[$field]['urlPrefix'] = $errorMsg;
        }

        return $isValidationProcessOk;
    }

    private function hasUrlPrefix($rawUrl)
    {

        foreach ($this->acceptedUrlPrefixes as $prefix) {
            $prefixLength = strlen($prefix);
            $rawPrefix = substr($rawUrl, 0, $prefixLength);

            if ($rawPrefix &&
                $prefix == $rawPrefix) {
                return true;
            }
        }

        return false;

    }


    private function isValueNumeric($value)
    {
        $valueLength = strlen($value);

        for ($i = 0; $i < $valueLength; $i++) {
            $char = substr($value, $i, 1);

            // If it's a negative sign, just accept it and continue to the
            // next char.
            if ($char == "-") { continue; }

            if (!is_numeric($char)) {
                return false;
            }
        }

        return true;

    }


    protected function validateRequiredField($field)
    {
        $isValidationProcessOk = false;

        if (isset($_POST[$field]) || isset($_GET[$field])) {
            $isValidationProcessOk = true;
        } else {
            $errorMsg = "{$field} is not set.";
            $this->errors[$field]['required'] = $errorMsg;
        }

        return $isValidationProcessOk;
    }


}

?>
