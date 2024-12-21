<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\LessonResource;
use App\Http\Traits\GeneralTrait;
use App\Models\Lesson;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    use GeneralTrait;
    public function index(){
    //    return  LessonResource::collection(Lesson::all());
    //    return  Lesson::select('id','lesson_title_'.app()->getLocale())->get();
    $lessons = Lesson::select('id','lesson_title_'.app()->getLocale())->get();
    return $this->returnSuccess('lessons',$lessons);
    }

    public function getbyid(Request $request){
        $lesson = Lesson::select()->find($request->id);
         if(!$lesson){
            return $this->returnError('1','Not Found');
         }
        return $this->returnData('lesson',$lesson);
    }

    public function change_status(Request $request){
      $lesson = Lesson::where('id',$request->id)->update(['active'=>$request->active]);
      return $this->returnSuccess('0','Data Changed');
    }

    public function show(Lesson $lesson){
        return LessonResource::make($lesson);
    }

    public function store(Request $request){
       $lesson = new Lesson();
       $lesson->lesson_title = $request->lesson_title;
       $lesson->lesson_notes = $request->lesson_notes;
       $lesson->save();

       return response()->json("Data added successfully");
    }

    public function update(Request $request){
      $lesson = Lesson::findOrFail($request->id);
      $lesson->lesson_title = $request->lesson_title;
      $lesson->lesson_notes = $request->lesson_notes;
      $lesson->update();

      return response()->json("Data has been modified successfully");
    }

    public function destroy(Request $request){
       $lesson = Lesson::findOrFail($request->id);
       $lesson->delete();
       return response()->json("Data deleted successfully");
    }
}
