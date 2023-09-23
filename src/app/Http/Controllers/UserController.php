<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; 

class UserController extends Controller
{
    public function users()
    {
        $users = User::all();
        User::where('id', 1)->update(['admin' => true]);
        return view('users', compact('users'));
    }
}

