<?php

namespace App\Http\Controllers;

use App\Models\TestModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class TestController extends Controller
{
    public function books(Request $request)
    {
        $test = TestModel::$globalDate;

        $random = rand(1,9);

        return View::make('welcome',compact('test','random'));
    }

    public function contactUs()
    {
        return view('contact-us');
    }

    public function aboutUs()
    {
        return view('about-us');
    }

    public function home()
    {
        return view('home');
    }
}
