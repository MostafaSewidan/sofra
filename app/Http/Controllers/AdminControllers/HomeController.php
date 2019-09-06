<?php

namespace App\Http\Controllers\AdminControllers;


use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        return view('AdminDashBord.home.index');
    }



}
