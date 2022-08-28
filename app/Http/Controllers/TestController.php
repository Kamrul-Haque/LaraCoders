<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function books(Request $request)
    {
        $user = User::$globalDate;

        return $user;
    }
}
