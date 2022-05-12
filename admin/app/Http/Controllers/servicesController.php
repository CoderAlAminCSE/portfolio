<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\servicesModel;
class servicesController extends Controller
{
    function ServicesIndex(){
        return view('services');
    }

    function getServicesData(){
        $result= json_encode(servicesModel::all());
        return $result;
    }

    function getServicesDetails(Request $req){
        $id= $req->input('id');
        $result= json_encode(servicesModel::where('id','=',$id)->get());
        return $result;
    }

    function deleteService(Request $req){
       $id= $req->input('id');
       $result = servicesModel::where('id','=',$id)->delete();
        if($result==true){
            return 1;
        }else{
            return 0;
        }
    }

    function UpdateService(Request $req){
       $id= $req->input('id');
       $name= $req->input('name');
       $desc= $req->input('desc');
       $image= $req->input('img');

       $result = servicesModel::where('id','=',$id)->update(['service_name'=>$name,'service_desc'=>$desc,'service_image'=>$image]);
        if($result==true){
            return 1;
        }else{
            return 0;
        }
    }


    function addService(Request $req){
        $name=$req->input('name');
        $desc=$req->input('desc');
        $image=$req->input('img');

        $result=servicesModel::insert(['service_name'=>$name,'service_desc'=>$desc,'service_image'=>$image]);

        if($result==true){
            return 1;
        }
        else{
            return 0;
        }
    }
} 
