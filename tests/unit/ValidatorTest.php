<?php

use PHPUnit\Framework\TestCase;

class RandomArrayValidator
{
    use \App\Core\Validation\CnArrayValidatorTrait;
}

class ValidatorTest extends TestCase
{

    /** @test */
    public function validates_item_count_of_an_array()
    {
        $photoUrls = [
            'url1',
            'url2',
            'url3'
        ];


        $globalVar = [
            'requestType' => 'get',
            'requestUrl' => 'www.ysp.com',
            'photoUrls' => $photoUrls
        ];

        $fieldNameToBeValidated = 'photoUrls';

        $maxNumOfPhotoUrls = 5;

        $validator = new RandomArrayValidator();

        // $validationResult = $validator->validateItemsCount($globalVar, $fieldNameToBeValidated, $maxNumOfPhotoUrls);
        $validationResult = $validator->validateItemsCount([
            'globalVar' => $globalVar,
            'fieldNameToBeValidated' => $fieldNameToBeValidated,
            'limitType' => 'max',
            'limitValue' => $maxNumOfPhotoUrls
        ]);

        $this->assertTrue($validationResult);


        // Error case for exceeding the max limit.
        $globalVar = [
            'requestType' => 'get',
            'requestUrl' => 'www.ysp.com',
            'photoUrls' => [
                'url1',
                'url2',
                'url3',
                'url4',
                'url5',
                'url6'
            ]
        ];

        $validationResult = $validator->validateItemsCount([
            'globalVar' => $globalVar,
            'fieldNameToBeValidated' => $fieldNameToBeValidated,
            'limitType' => 'max',
            'limitValue' => $maxNumOfPhotoUrls
        ]);

        $this->assertFalse($validationResult);



        // OK case for making the min limit.
        $globalVar = [
            'requestType' => 'get',
            'requestUrl' => 'www.ysp.com',
            'photoUrls' => [
                'url1',
                'url2'
            ]
        ];
        
        $validationResult = $validator->validateItemsCount([
            'globalVar' => $globalVar,
            'fieldNameToBeValidated' => $fieldNameToBeValidated,
            'limitType' => 'min',
            'limitValue' => 2
        ]);
        
        $this->assertTrue($validationResult);


        // OK case for exceeding the min limit.
        $globalVar = [
            'requestType' => 'get',
            'requestUrl' => 'www.ysp.com',
            'photoUrls' => [
                'url1',
                'url2',
                'url3'
            ]
        ];
                
        $validationResult = $validator->validateItemsCount([
            'globalVar' => $globalVar,
            'fieldNameToBeValidated' => $fieldNameToBeValidated,
            'limitType' => 'min',
            'limitValue' => 2
        ]);
                
        $this->assertTrue($validationResult);



        // ERROR case for not reaching the min limit.
        $globalVar = [
            'requestType' => 'get',
            'requestUrl' => 'www.ysp.com',
            'photoUrls' => [
                'url1'
            ]
        ];
                
        $validationResult = $validator->validateItemsCount([
            'globalVar' => $globalVar,
            'fieldNameToBeValidated' => $fieldNameToBeValidated,
            'limitType' => 'min',
            'limitValue' => 2
        ]);
                
        $this->assertFalse($validationResult);
    }
}
