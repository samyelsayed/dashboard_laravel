<?php

namespace App\Http\Middleware;

use App\Http\traits\ApiTrait;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserVerifeid
{ use ApiTrait;
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

      $user = Auth::guard('sanctum')->user();

      if(is_null($user) || is_null($user->email_verified_at)){
        return $this->ErrorMessage(['message'=>'Your email is not verified'],'unauthorized',401);
      }

        return $next($request);


    }
}
