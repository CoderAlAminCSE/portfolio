<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CourseModel;
class courseController extends Controller
{
    function CourseIndex(){
        return view('courses');
    }

    function getCourseData(){
        $result= json_encode(CourseModel::all());
        return $result;
    }

    function getCourseDetails(Request $req){
        $id= $req->input('id');
        $result= json_encode(CourseModel::where('id','=',$id)->get());
        return $result;
    }

    function deleteCourse(Request $req){ 
       $id= $req->input('id');
       $result = CourseModel::where('id','=',$id)->delete();
        if($result==true){
            return 1;
        }
        else{
            return 0;
        }
    }

    function UpdateCourse(Request $req){
       $id= $req->input('id');
       $course_name= $req->input('course_name');
       $course_desc= $req->input('course_desc');
       $course_fee= $req->input('course_fee');
       $course_totalEnroll= $req->input('course_enroll');
       $course_totalClass= $req->input('course_class');
       $course_link= $req->input('course_link');
       $course_img= $req->input('course_img');

       $result = CourseModel::where('id','=',$id)->update([

        'course_name'=>$course_name,
        'course_desc'=>$course_desc,
        'course_fee'=>$course_fee,
        'course_totalEnroll'=>$course_totalEnroll,
        'course_totalClass'=>$course_totalClass,
        'course_link'=>$course_link,
        'course_img'=>$course_img,

        ]);
        if($result==true){
            return 1;
        }else{
            return 0;
        }
    }

     function addCourse(Request $req){
       $course_name= $req->input('course_name');
       $course_desc= $req->input('course_desc');
       $course_fee= $req->input('course_fee');
       $course_totalEnroll= $req->input('course_enroll');
       $course_totalClass= $req->input('course_class');
       $course_link= $req->input('course_link');
       $course_img= $req->input('course_img');

        $result=CourseModel::insert([

        'course_name'=>$course_name,
        'course_desc'=>$course_desc,
        'course_fee'=>$course_fee,
        'course_totalEnroll'=>$course_totalEnroll,
        'course_totalClass'=>$course_totalClass,
        'course_link'=>$course_link,
        'course_img'=>$course_img

        ]);

        if($result==true){
            return 1;
        }
        else{
            return 0;
        }
    }


}
