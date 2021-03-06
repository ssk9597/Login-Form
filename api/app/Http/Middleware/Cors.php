<?php

namespace App\Http\Middleware;

use Closure;

class Cors
{
  public function handle($request, Closure $next)
  {
    return $next($request)
      ->header('Access-Control-Allow-Origin', 'http://localhost:3000')
      ->header('Access-Control-Allow-Methods', 'GET, POST')
      ->header('Access-Control-Allow-Headers', 'Content-Type, X-XSRF-TOKEN, Authorization')
      ->header('Access-Control-Allow-Credentials', 'true');
  }
}
