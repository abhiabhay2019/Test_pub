<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SiteController extends Controller
{
    //
    public function index(Request $request){
        
        return view('admin/site_setup'); 
    }
}
