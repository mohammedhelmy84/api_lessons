<?php

use App\Http\Controllers\Api\Admin\AuthController;
use App\Http\Controllers\Api\LessonController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

/* new comment */

Route::group(['middleware'=>['input_password','change_language']],function(){
    // Route::apiResource('/lessons',LessonController::class);
    Route::post('/lessons',[LessonController::class,'index']);
    Route::put('lessons/update',[LessonController::class,'update']);
    Route::delete('lessons/delete',[LessonController::class,'destroy']);
    Route::post('lesson_by_id/',[LessonController::class,'getbyid']);
    Route::post('change_status/',[LessonController::class,'change_status']);

    Route::group(['prefix'=>'admin','namespace'=>'Admin'],function(){
        Route::post('/admin_login',[AuthController::class,'login']);
    });
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['middleware'=>['input_password','change_language','check_admin:admin-api']],function(){
    // Route::apiResource('/lessons',LessonController::class);
    Route::post('/count',[LessonController::class,'index']);

});
