<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookingsController extends Controller
{
    public function index(){
    	return view('dashboard.content');
    }

    
}
