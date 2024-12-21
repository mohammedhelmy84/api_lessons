<?php
namespace App\Http\Traits;
Trait GeneralTrait{
   public function getCurrentLanguage(){
      return app()->getLocale();
   }

   public function returnError($err_num="0" ,$msg=""){
      return response()->json([
        'status'=>'false',
        'error_num'=>$err_num,
        'msg'=>$msg
      ]);
   }

   public function returnSuccess($err_num="0" ,$msg=""){
    return response()->json([
      'status'=>'true',
      'error_num'=>$err_num,
      'msg'=>$msg
    ]);
 }

 public function returnData($key,$value, $err_num="0", $msg=""){
    return response()->json([
        'status'=>'true',
        'error_num'=>$err_num,
        'msg'=>$msg, $key=>$value
    ]);
 }
}
