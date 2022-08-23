<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\registerRequest;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class registerController extends Controller
{

    public function profile()
    {
        return view('profile');
    }

    public function register(registerRequest $r)
    {
        if ($r->pass1 == $r->pass2) {
            User::create([
                'name' => $r->name,
                'email' => $r->email,
                'password' => Hash::make($r->pass1)
            ]);

            return true;
        } else {
            return response()->json(['errors' => ['password' => 'Пароли не совпадают']], 400);
        }
    }
}
