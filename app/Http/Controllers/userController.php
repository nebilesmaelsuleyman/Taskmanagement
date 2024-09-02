<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\User;

class userController extends Controller
{
    public function user()
    {
        $users=User::all();
      
        return view('task.layouts.create',compact('users'));
    }

}
