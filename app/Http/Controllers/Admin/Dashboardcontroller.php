<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Dashboardcontroller extends Controller
{
    public function index(){
        return view('back-end.admin.dashboard');
    }
}
