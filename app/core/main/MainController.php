<?php
/**
 * Created by PhpStorm.
 * User: ops
 * Date: 2017-12-11
 * Time: 11:52
 */

namespace App\Core\Main;

use App\Core\Main\CNMain;
use App\Core\Validation\Validator;
use App\Core\CNTrait\CNDataManipulator;


class MainController extends CNMain
{
    use CNDataManipulator;

    public $validator;
    protected $menu;
    protected $action;
    protected $menuObj;
    protected $sanitizedFields = [];
    protected $json = [];
    private $isRequestShow = false;
//    protected $crudAction;


    protected function setIsRequestShow($value) {
        $this->setAction('show');
    }



    /**
     * MainController constructor.
     */
    public function __construct($menu = null, $action = null)
    {
        parent::__construct();

        $this->validator = new Validator();

        $this->setMenu($menu);
        $this->setAction($action);

        $this->setMenuObject($menu);
        $this->initJson();
    }

    protected function initJson()
    {
        $this->json['is_result_ok'] = false;
        $this->json['comments'] = array();
    }


    public function setSanitizedFields($superImposingSanitizedFields = null)
    {
        if ($superImposingSanitizedFields == null) {
            foreach ($this->validator->fieldsToBeValidated as $field => $value) {
                $fieldValue = (isset($_POST[$field]) ? $_POST[$field] : $_GET[$field]);
                $this->sanitizedFields[$field] = $fieldValue;
            }
        }
        else {
            $this->sanitizedFields = $superImposingSanitizedFields;
        }

    }



    protected function setFieldsToBeValidated()
    {
        // TODO: Override this.
    }

    protected function doRequestFinalization($isCrudOk)
    {

        switch ($this->action) {
            case 'create':
            case 'update':
            case 'delete':
                $isCrudOk ? $this->json['is_result_ok'] = true : null;
                break;
            case 'read':
            case 'show':
            case 'fetch':
                // On $action read, $isCrudOk is either false or json['objs']
                if ($isCrudOk != false) {
                    $this->json['is_result_ok'] = true;
                    $this->json['objs'] = $isCrudOk;
                }
                break;
        }


        //
        $this->json['errors'] = $this->validator->errors;
        $this->json['is_viewing_own_account'] = $this->session->is_viewing_own_account();

        //
        echo json_encode($this->json);
    }


    /**
     * Instantiate the relative-specific menu obj for any controller.
     * For ex, if the request-url is ajax_handler.php?menu=TimelinePost&action=create,
     * then this will be like
     *      $menuObj = new TimelinePost()
     * ...
     */
    protected function setMenuObject($menu = null)
    {

        if (!$this->hasModel()) {
            return;
        }


//        //
//        if (isset($menu)) {
//            $class = "App\\Model\\{$this->menu}";
//            $this->menuObj = new $class();
//            return;
//        }

        $class = "App\\Model\\{$this->menu}";
        try {
            $this->menuObj = new $class();
        } catch (Exception $e) {
            $cnError = $e->getMessage();
        }

    }


    /** If there's no corresponding model class for the menu.. */
    private function hasModel()
    {
        switch ($this->menu) {
            case 'NonExistentModel':
            case 'Login':
            case 'VideoRecommendationItem':
                return false;
            default:
                return true;
        }
    }



    protected function setMenu($menu = null)
    {
        if (isset($menu)) {
            $this->menu = $menu;
            return;
        }

        if (is_request_post()) {
            $this->menu = $_POST['menu'];
        } else {
            $this->menu = $_GET['menu'];
        }
    }


    public function setAction($value = null)
    {
        if (isset($value)) {
            $this->action = $value;
            return;
        }

        if (is_request_post()) {
            $this->action = $_POST['action'];
        } else {
            $this->action = $_GET['action'];
        }

    }


    /**
     * This is almost like the method setSpecificQueryClauses(), but for 6th iteration.
     */
    public static function setQueryData() {

    }


    /**
     * Handle the action for both a regular request
     * and ajax request..
     */
    public function doAction()
    {
        $this->setFieldsToBeValidated();
        $isValidationOk = $this->validator->validate();
        $isCrudOk = false;



        if ($isValidationOk) {
            $this->setSanitizedFields();


//            // This is almost like the method setSpecificQueryClauses(), but for 6th iteration.
//            $this->setQueryData();

            // Execute the crud action.
            if (isRequestAjax()) {
                $this->doSpecificAjaxCrudAction();
            }


            //
            $crudAction = $this->action;
            $isCrudOk = $this->$crudAction();

        }

        //
        if (isRequestAjax()) {
            $this->doRequestFinalization($isCrudOk);
        }
    }

    public function index() {
        // Override this.
        return null;
    }


    protected function setSpecificQueryClauses()
    {

    }

    protected function show() {

        $this->setSpecificQueryClauses();

        $objs = $this->menuObj->show($this->sanitizedFields);

        /* Filter unwanted fields of the objs. */
        foreach ($objs as $obj) {
            $obj->filterExclude([]);

        }

        /**/
        foreach ($objs as $obj) {
            $obj->removeStaticFields();
        }


        return $objs;
    }


    /* @deprecated */
    protected function read() {

        $this->setSpecificQueryClauses();

        $objs = $this->menuObj->read($this->sanitizedFields);

        /* Filter unwanted fields of the objs. */
        foreach ($objs as $obj) {
            $obj->filterExclude([]);
        }

        /**/
        foreach ($objs as $obj) {
            $obj->removeStaticFields();
        }


        return $objs;
    }

    protected function create() {
        $crudAction = $this->action;
        $isCrudOk = $this->menuObj->$crudAction();
        return $isCrudOk;
    }

    protected function update() {
        $crudAction = $this->action;
        $isCrudOk = $this->menuObj->$crudAction();
        return $isCrudOk;
    }


    protected function delete() {
        $isCrudOk = $this->menuObj->deleteByPk();
        return $isCrudOk;
    }

    protected function setDateForHumansAttrib($rawDateAttribName, $objs) {

        foreach ($objs as $obj) {

            foreach ($obj as $field => $value) {

                if ($field == $rawDateAttribName) {

                    $obj->human_date = $obj::getMyCarbonDate($obj->$field);
                    break;
                }
            }
        }
    }

}