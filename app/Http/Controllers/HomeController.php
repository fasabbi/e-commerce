<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;


class HomeController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    
    public function index()
    {
        $users = user::all();
        return view('home',compact('users'));
    }
    public function honey()
    {
        return view('contact');
    }
    
}
