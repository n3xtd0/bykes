<?php

namespace Tests\Unit\Api;

use Tests\TestCase;
use Illuminate\Http\UploadedFile;

class csvUpload extends TestCase {


    public function testNoFileAttachedReturns400(){
        $apiResponse = $this->post('api/csvUpload',[
            'file' => '',
        ]);

        $apiResponse->assertStatus(400);
    }


    public function testWrongExtensionReturns415(){
        $file = UploadedFile::fake()->create('document.txt', 50, 'text/plain');
        $apiResponse = $this->post('api/csvUpload',[
            'file' => $file,
        ]);

        $apiResponse->assertStatus(415);
    }


    public function testCorrectCSVReturns200(){
        $file = UploadedFile::fake()->create('document.csv', 50, 'text/csv');
        $apiResponse = $this->post('api/csvUpload',[
            'file' => $file,
        ]);

        $apiResponse->assertStatus(200);
    }

    //Todo: testFileGetsSavedOnServer


}
