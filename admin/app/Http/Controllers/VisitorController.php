<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\VisitorModel;

class VisitorController extends Controller
{
    function VisitorIndex(){

      $visitor_data= json_decode( VisitorModel::orderBy('id','desc')->take(5)->get());

        return view('visitor',['visitor_data'=>$visitor_data]);
    }
}
