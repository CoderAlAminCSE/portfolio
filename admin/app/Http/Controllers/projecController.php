<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProjectModel;
class projecController extends Controller
{
    function ProjectIndex(){
        return view('project');
    }

    function getProjectData(){
        $result= json_encode(ProjectModel::all());
        return $result;
    }

    function addProject(Request $req){
       $project_name= $req->input('name');
       $project_desc= $req->input('desc');
       $project_link= $req->input('link');
       $project_img= $req->input('img');

        $result=ProjectModel::insert([

        'project_name'=>$project_name,
        'project_desc'=>$project_desc,
        'project_link'=>$project_link,
        'project_img'=>$project_img

        ]);

        if($result==true){
            return 1;
        }
        else{
            return 0;
        }
    }


   /* function deleteProject(Request $req){ 
       $id= $req->input('id');
       $result = ProjectModel::where('id','=',$id)->delete();
        if($result==true){
            return 1;
        }
        else{
            return 0;
        }
    }
*/
    function deleteProject(Request $req){
        $id= $req->input('id');
        $result= ProjectModel::where('id','=',$id)->delete();
   
        if($result==true){      
          return 1;
        }
        else{
            return 0;
        }
   }


    function getProjectDetails(Request $req){
        $id= $req->input('id');
        $result= json_encode(ProjectModel::where('id','=',$id)->get());
        return $result;
    }

    function UpdateProject(Request $req){
       $id= $req->input('id');
       $project_name= $req->input('name');
       $project_desc= $req->input('desc');
       $project_link= $req->input('link');
       $project_img= $req->input('img');

       $result = ProjectModel::where('id','=',$id)->update([

        'project_name'=>$project_name,
        'project_desc'=>$project_desc,
        'project_link'=>$project_link,
        'project_img'=>$project_img,

        ]);
        if($result==true){
            return 1;
        }else{
            return 0;
        }
    }


}
