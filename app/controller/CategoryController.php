<?php
/**
 * Created by PhpStorm.
 * User: ops
 * Date: 2018-04-25
 * Time: 19:57
 */

namespace App\Controller;

use App\Core\Main\MainController;

class CategoryController extends MainController implements AjaxCrudHandlerInterface
{
    public function __construct($menu = null, $action = null)
    {
        parent::__construct($menu, $action);
    }

    /**
     * @return mixed
     */
    public function doSpecificAjaxCrudAction()
    {
        // TODO: Implement doSpecificAjaxCrudAction() method.
    }



    /** @override */
    public function setGlobalRequestMethodFields($request)
    {
        $requestObj = [];
        if (isset($request->requestData['requestObj'])) {
            $requestObj = $request->requestData['requestObj'];
        }
    
        foreach ($this->validator->fieldsToBeValidated as $field => $value) {
            if (isset($requestObj[$field])) {
                $requestValue = $requestObj[$field];
    
                if (is_request_get()) {
                    $_GET[$field] = $requestValue;
                } else {
                    $_POST[$field] = $requestValue;
                }
            }
        }
    }
    


    /** @override */
    protected function setFieldsToBeValidated()
    {
        switch ($this->action) {
            case 'create':
                break;
            case 'read':

                $this->validator->fieldsToBeValidated['stringified_ids_of_already_been_read_categories'] = [
                    'required' => 1,
                    'min' => 0,
                    'max' => 8192,
                    'areNumeric' => 1
                ];

                $this->validator->fieldsToBeValidated['earliest_el_date'] = [
                    'required' => 1,
                    'min' => 19,
                    'max' => 20,
                    'blank' => 1
                ];

                break;

            case 'update':
            case 'delete':
            case 'patch':
                break;
            case 'fetch':
                break;
            case 'index':
            case 'show':
                break;
        }
    }


    /** @override */
    protected function read()
    {
        // Find main-objs.
        $dataForProducingReadQuery = [
            'earliest_el_date' => $this->sanitizedFields['earliest_el_date'],
            'limit' => 5,
            'stringifiedIdsOfAlreadyBeenReadCategories' => $this->sanitizedFields['stringified_ids_of_already_been_read_categories']
        ];


        /**/
        $readQuery = \App\Model\CategoryQueryProducer::getReadQuery($dataForProducingReadQuery);

        $instantiateObjsToBeRead = true;
        $categories = \App\Model\Category::readByRawQuery($readQuery, $instantiateObjsToBeRead);




        foreach ($categories as $category) {

            // 1) Find extentional-objs.


            // 2) Filter
            $category->filterExclude();

            // 3) Refine


            // 4) Combine

            /* Add a carbon-date field to the obj. */
            $rawDateTimeFieldName = "created_at";
            $category->addReadableDateField($rawDateTimeFieldName);
        }


        //
        return $categories;
    }


    public function index()
    {
        if (\App\Core\Main2\Request::isAjax()) {

        //      // Find main-objs.
            //     $dataForProducingReadQuery = [
            //     'earliest_el_date' => $this->sanitizedFields['earliest_el_date'],
            //     'limit' => 5,
            //     'stringifiedIdsOfAlreadyBeenReadCategories' => $this->sanitizedFields['stringified_ids_of_already_been_read_categories']
            // ];
        
            $this->sanitizedFields['limit'] = 1000;
            $categories = parent::read();


            foreach ($categories as $category) {

                // 1) Find extentional-objs.
    
    
                // 2) Filter
                $category->filterInclude(['id', 'name']);
    
                // 3) Refine
    
    
                // 4) Combine
    
                /* Add a carbon-date field to the obj. */
            }

            return $categories;
        } else {
            require_once(PUBLIC_PATH . 'video/create/index.php');
        }
    }
}
