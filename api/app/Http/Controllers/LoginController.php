<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Models
use App\Models\User;

// Hash
use Illuminate\Support\Facades\Hash;

// Auth
use Illuminate\Support\Facades\Auth;

// Validation
use App\Http\Requests\StoreRegister;


class LoginController extends Controller
{
  // 新規登録
  public function register(StoreRegister $request)
  {
    // instance
    $user = new User;

    // value_save
    $user->fill(array_merge($request->all(), ["password" => Hash::make($request->password)]))->save();
  }

  // ログイン
  public function login(Request $request)
  {
    // validation
    $login = $request->validate([
      "email" => "required|email",
      "password" => "required|string|min:8"
    ]);
  }
}
