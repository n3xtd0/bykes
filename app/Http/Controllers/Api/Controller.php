<?php

namespace App\Http\Controllers\Api;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Validator;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    const RULE_REQUIRED      = 'required';
    const RULE_CSV_FILE_TYPE = 'mimetypes:text/csv';

    protected array $validationRules = [];

    public function __construct()    {
        $this->validationRules = [self::RULE_REQUIRED, self::RULE_CSV_FILE_TYPE];
    }

    public function csvUpload(Request $request) :JsonResponse {
        foreach ($this->validationRules as $rule){
            $validator = Validator::make($request->all(), ['file' => $rule]);

            if ($validator->fails())
                return response()->json(['message' => $validator->errors()->get('file')], $this->getStatus($rule));
        }

        return response()->json(['message'=>'ok'], 200);
    }


    private function getStatus(String $rule) :int {
        if ($rule == self::RULE_REQUIRED)      return 400;
        if ($rule == self::RULE_CSV_FILE_TYPE) return 415;
        return 200;
    }

}
