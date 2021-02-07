<?php

namespace App\Http\Controllers\Admin;
use Gate;

class HomeController
{
    public function index()
    {

         return view('home');
    }
}
