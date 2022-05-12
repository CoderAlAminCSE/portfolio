<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\VisitorModel;
use App\servicesModel;
use App\CourseModel;
use App\ProjectModel;
use App\ContactModel;
use App\ReviewModel;
class HomeController extends Controller
{
    function HomeIndex(){

        $user_ip=$_SERVER['REMOTE_ADDR'];
        date_default_timezone_set("Asia/Dhaka");
        $time_date=date("Y-m-d h:i:sa");
        VisitorModel::insert(['ip_address'=>$user_ip,'visit_time'=>$time_date]);

       $servicesData= json_decode(servicesModel::all());
       $courseData=json_decode(CourseModel::orderBy('id', 'desc')->take(6)->get()) ;
       $projectData=json_decode(ProjectModel::orderBy('id', 'desc')->take(10)->get()) ;
       $reviewData= json_decode(ReviewModel::all());

        return view('home',[
            'servicesData'=>$servicesData,
            'courseData'=>$courseData,
            'projectData'=>$projectData,
            'reviewData'=>$reviewData,
        ]);
    }

    function contactSend( Request $request){
        $contact_name=$request->input('contact_Name');
        $contact_mobile=$request->input('contact_Mobile');
        $contact_email=$request->input('contact_Email');
        $contact_msg=$request->input('contact_Msg');

        $result=ContactModel::insert([
            'contact_name'=>$contact_name,
            'contact_mobile'=>$contact_mobile,
            'contact_email'=> $contact_email,
            'contact_msg'=>$contact_msg
        ]);
        if($result==true){
            return 1;
        }
        else{
            return 0;
        }
    }
}








// namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// use App\VisitorModel;
// use App\ServicesModel;
// use App\CourseModel;
// use App\ProjectsModel;
// use App\ContactModel;
// use App\ReviewModel;

// class HomeController extends Controller
// {
//     function HomeIndex(){
//         $UserIP=$_SERVER['REMOTE_ADDR'];
//         date_default_timezone_set("Asia/Dhaka");
//         $timeDate= date("Y-m-d h:i:sa");
//         VisitorModel::insert(['ip_address'=>$UserIP,'visit_time'=>$timeDate]);
//         $ServicesData= json_decode( ServicesModel::all());
//         $CoursesData= json_decode(CourseModel::orderBy('id','desc')->limit(6)->get());
//         $ProjectData=json_decode(ProjectsModel::orderBy('id','desc')->limit(10)->get());
//         $ReviewData= json_decode( ReviewModel::all());

//         return view('Home',[
//             'ServicesData'=>$ServicesData,
//             'CoursesData'=>$CoursesData,
//             'ProjectData'=>$ProjectData,
//             'ReviewData'=>$ReviewData,
//         ]);
//     }

//     function ContactSend(Request $request){
//         $contact_name=$request->input('contact_name');
//         $contact_mobile= $request->input('contact_mobile');
//         $contact_email=$request->input('contact_email');
//         $contact_msg=$request->input('contact_msg');
//         $result= ContactModel::insert([
//             'contact_name'=> $contact_name,
//             'contact_mobile'=> $contact_mobile,
//             'contact_email'=>$contact_email,
//             'contact_msg'=>$contact_msg
//         ]);

//        if($result==true){

//             return 1;
//        }
//        else{

//            return 0;
//        }

//     }
// }
