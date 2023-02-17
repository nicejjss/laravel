<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    //
    public function __construct()
    {
      //  $this->middleware('test');
        $this->middleware('using')->only('index2');
        $this->middleware('role')->except('index');
    }

    public function show($name ="jack",$id)
    {
        echo "<br> Name: ".$name;
        echo "<br> ID: ".$id;
    }
    public function index($name ="jack"){
        return 'Home index page:  '.$name;
    }
    public function index2($name ="jack"){
        return 'Home index2 page:  '.$name;
    }
}
