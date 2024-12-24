<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use illuminate\Auth\Middleware\Authenticate as  Middleware;
class Authenticate extends Middleware
{
   protected function redirectTo(Request $request){
    return route ('login');
   }


}
