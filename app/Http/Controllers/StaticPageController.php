<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StaticPageController extends Controller
{
    //homepage
    public function home(){
        return view('home');
    }
    //about
    public function about(){
        return view('about');
    }
}
