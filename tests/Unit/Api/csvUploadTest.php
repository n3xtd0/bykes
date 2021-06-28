<?php
namespace Tests\Unit\Api;

use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;

use App\Models\UserCsv;

class csvUploadTest extends TestCase {
    use RefreshDatabase;


    public function testNoFileAttachedReturns400(){
        $this->assertStatusOnAndDeleteTestFile(400);
    }


    public function testWrongExtensionReturns415(){
        $file = UploadedFile::fake()->create('document.txt', 50, 'text/plain');
        $this->assertStatusOnAndDeleteTestFile(415, $file);
    }


    public function testCorrectCSVReturns200(){
        $file = UploadedFile::fake()->create('document.csv', 50, 'text/csv');
        $this->assertStatusOnAndDeleteTestFile(200, $file);
    }


    private function assertStatusOnAndDeleteTestFile($statusCodeToAssert, $file = '')
    {
        $apiResponse = $this->post('api/csvUpload', ['file' => $file]);
        $apiResponse->assertStatus($statusCodeToAssert);
        if (!empty($file))
            Storage::disk('testing')->delete($file->hashName());
    }


    public function testCSVGetsStoredOnFilesystem($fileNameToTest = ''){
        $fileNameToTest = !empty($fileNameToTest) ? $fileNameToTest : 'document.csv';
        $file = UploadedFile::fake()->create($fileNameToTest, 50, 'text/csv');
        $this->post('api/csvUpload', ['file' => $file]);
        Storage::disk('testing')->assertExists($file->hashName());
        Storage::disk('testing')->delete($file->hashName());
    }


    public function testCSVGetsStoredOnDatabase(){
        $fileNameToTest = 'document.csv';
        $this->testCSVGetsStoredOnFilesystem($fileNameToTest);

        $mockedUserId = 1; //Todo: Test with authenticated UserId
        $uploadedCSV = UserCsv::where('filename', 'like', "%$fileNameToTest")
            ->where('is_processed', 0)
            ->where('user_id', $mockedUserId)
            ->get()->first();

        $this->assertSame($fileNameToTest, $uploadedCSV->filename);
    }

}
