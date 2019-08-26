<?php

namespace App\Http\Controllers\AdminControllers;

use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        return view('AdminDashBord.home.index');
    }



}
