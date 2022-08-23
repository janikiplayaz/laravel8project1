<?php

namespace App\Http\Controllers;

use App\Http\Requests\authRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class authController extends Controller
{
    public function auth(authRequest $r)
    {
        if (Auth::attempt(['email' => $r->email, 'password' => $r->password], true)) {
            return true;
        } else {
            return response()->json(['errors'=>['password'=>'Неправильный пароль или логин']], 401);
        }
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('home');
    }
}
