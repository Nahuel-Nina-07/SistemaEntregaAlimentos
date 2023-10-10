<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $rol=Auth::user()->rol;

        if($rol=='1')
        {
            return view('dash.index');
        }
        if($rol=='2')
        {
            return view('dash.index');
        }
        else
        {
            return view('dash.index');
        }
    }   
}