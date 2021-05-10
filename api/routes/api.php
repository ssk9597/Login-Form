<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
  return $request->user();
});

Route::middleware(['cors'])->group(function () {
  Route::options('accounts', function () {
    return response()->json();
  });

  Route::post("/users/register", "LoginController@register");
  Route::post("/users/login", "LoginController@login");
});
