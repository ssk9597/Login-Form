<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Models
use App\Models\User;

// Hash
use Illuminate\Support\Facades\Hash;

// Auth
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
  public function register(Request $request)
  {
    // instance
    $user = new User;

    // value_save
    $user->fill(array_merge($request->all(), ["password" => Hash::make($request->password)]))->save();

    // token発行
    $token = Auth::user()->createToken('authToken')->accessToken;

    return response(["token" => $token]);
  }
}
