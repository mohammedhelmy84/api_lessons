<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    use GeneralTrait;
    public function login(Request $request)
    {
      try{
        $rules = [
            'email' => 'required|exists:admins,email',
            'password' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()){
           $code = $this->returnCodeAccordingToInput($validator);
           return $this->returnValidationError($code,$validator);
        }

        }catch(\Exception $exception){
             return $this->returnError($exception->getCode(),$exception->getMessage());
        }
    }
}
