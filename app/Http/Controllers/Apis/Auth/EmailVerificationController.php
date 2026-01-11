<?php

namespace App\Http\Controllers\Apis\Auth;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class EmailVerificationController extends Controller
{
    function sendCode(Request $request){
        // logic to send verification code to user's email
       $token = $request->header('Authorization'); // get token from request header
       //get user
       $authenticatedUser = Auth::guard('sanctum')->user(); // دايما بجيب اليوزر الي عامل اوثنتيكيشن بالتوكن الي بعتة في الهيدر
          dd($authenticatedUser);
          $code = rand(10000, 99999); // generate a random 4-digit code

        $expirationTime = now()->addMinutes(2);   // code expiration time set to 2 minutes from now

        // Save the code and its expiration time to the user's record in the database}
}
