<?php

namespace Tests\Unit\Api;

use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use App\Models\UserCsv;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;

class csvUploadTest extends TestCase {
    use RefreshDatabase;


    public function testNoFileAttachedReturns400(){
        $apiResponse = $this->post('api/csvUpload', ['file' => '']);
        $apiResponse->assertStatus(400);
    }


    public function testWrongExtensionReturns415(){
        $file = UploadedFile::fake()->create('document.txt', 50, 'text/plain');
        $apiResponse = $this->post('api/csvUpload', ['file' => $file]);

        $apiResponse->assertStatus(415);
    }


    public function testCorrectCSVReturns200(){
        $file = UploadedFile::fake()->create('document.csv', 50, 'text/csv');
        $apiResponse = $this->post('api/csvUpload', ['file' => $file]);

        $apiResponse->assertStatus(200);
    }


    public function testCSVGetsStoredOnFilesystem(){
        $fileNameToTest = 'document.csv';

        $file = UploadedFile::fake()->create($fileNameToTest, 50, 'text/csv');
        $this->post('api/csvUpload', ['file' => $file]);
        Storage::disk('testing')->assertExists($file->hashName());
    }


    public function testCSVGetsStoredOnDatabase(){
        $fileNameToTest = 'document.csv';

        $file = UploadedFile::fake()->create($fileNameToTest, 50, 'text/csv');
        $this->post('api/csvUpload', ['file' => $file]);

        $mockedUserId = 1; //Todo: Test with authenticated UserId
        $uploadedCSV = UserCsv::where('filename', 'like', "%$fileNameToTest")
            ->where('is_processed', 0)
            ->where('user_id', $mockedUserId)
            ->get()->first();

        $this->assertSame($fileNameToTest, $uploadedCSV->filename);
    }

}
