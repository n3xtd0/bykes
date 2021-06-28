<?php
namespace Tests\Unit\Api;

use Tests\TestCase;

class nightlyCSVToPDFProcessTest extends TestCase {


    public function testGetNotProcessedCSVs(){
        $apiResponse = $this->get('api/TransformNewCSVsToPDFAndSendEmails');
        $apiResponse->assertStatus(200);
        //Todo: implement
    }


}
