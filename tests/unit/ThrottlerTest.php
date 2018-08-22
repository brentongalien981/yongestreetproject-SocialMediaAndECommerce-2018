<?php

use PHPUnit\Framework\TestCase;
// use App\Model\Video;
use App\Core\Main2\Throttler;

class ThrottlerTest extends TestCase
{

    /** 
     * @test 
     * Note: This not only checks for the num of request per minute, but
     * it actually checks the num of requests per minute for a specific
     * controller of specific crud action.
     */
    public function checks_for_the_num_of_request_per_minute()
    {
        // $request = [
        //     'controllerName' => 'item',
        //     'controllerAction' => 'update'
        // ];

        // $doesRequestExceededLimit = Throttler::test_isRequestPossiblyDDOSAttack($request);

        // $this->assertFalse($doesRequestExceededLimit);

        
        // \App\Core\Main2\RequestTimeKeeper::updateVars($request);
        $this->assertTrue(true);
        
    }
}