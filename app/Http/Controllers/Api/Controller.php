<?php

namespace App\Http\Controllers\Api;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Validator;

use App\Models\UserCsv;
use Exception;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public function csvUpload(Request $request) :JsonResponse
    {
        try {
            $validationHandler = new csvUploadValidationHandler();
            $validatedFile = $validationHandler->getValidatedFile($request);
        }catch(Exception $e){
            return response()->json(['message' => $e->getMessage()], $e->getCode());
        }

        $mockedUserId = 1; //Todo: use authenticated UserId
        $this->saveCSVOnFilesystem($validatedFile);
        $this->saveUserCSVOnDatabase($validatedFile->name, $mockedUserId);

        return response()->json(['message'=>'File correctly uploaded'], 200);
    }

    private function saveUserCSVOnDatabase($filename, $userId) :void
    {
        $userCsv = new UserCsv;
        $userCsv->filename = $filename;
        $userCsv->user_id = $userId;
        $userCsv->save();
    }

    private function saveCSVOnFilesystem($file) :void
    {
        $file->store('testing');
    }



    public function getNotProcessedCSVIds(Request $request) :JsonResponse
    {
        return response()->json(['message'=>'ok'], 200);
    }


}


class csvUploadValidationHandler{
    const RULE_REQUIRED      = 'required';
    const RULE_CSV_FILE_TYPE = 'mimetypes:text/csv';

    protected array $validationRules = [];

    public function __construct()    {
        $this->validationRules = [self::RULE_REQUIRED, self::RULE_CSV_FILE_TYPE];
    }

    public function getValidatedFile($request)
    {
        foreach ($this->validationRules as $rule){
            $validator = Validator::make($request->all(), ['file' => $rule]);

            if ($validator->fails())
                throw new Exception($validator->errors()->get('file')[0], $this->getStatus($rule));
        }
        return $request->all()["file"];
    }

    private function getStatus(String $rule) :int
    {
        if ($rule == self::RULE_REQUIRED)      return 400;
        if ($rule == self::RULE_CSV_FILE_TYPE) return 415;
        return 200;
    }
}


