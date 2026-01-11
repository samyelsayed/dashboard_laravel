<?php

namespace App\Http\Controllers\Apis\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\CheckCodeRequest;
use App\Http\traits\ApiTrait;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class EmailVerificationController extends Controller
{       use ApiTrait;
    function sendCode(Request $request){
        // logic to send verification code to user's email
       $token = $request->header('Authorization'); // get token from request header
       //get user
       $authenticatedUser = Auth::guard('sanctum')->user(); // دايما بجيب اليوزر الي عامل اوثنتيكيشن بالتوكن الي بعتة في الهيدر
          // dd($authenticatedUser);
          $code = rand(10000, 99999); // generate a random 4-digit code

        $code_expired_at = now()->addMinutes(2);   // code expiration time set to 2 minutes from now

        // Save the code and its expiration time to the user's record in the database

        $user = User::find($authenticatedUser->id);         //هنا اخخدت اوبجت من كلاس الموديل يوزر واسندت إاليه القيم بتاع الكود و الاكسبيرد
        $user->code =$code;
        $user->code_expired_at = $code_expired_at;
        $user->save();
          $user->token =  $token;
        return $this->Data(compact('user'));
      
    }
      public function checkCode(CheckCodeRequest $request){
        $token = $request->header('Authorization'); // get token from request header
        $authenticatedUser = Auth::guard('sanctum')->user(); // دايما بجيب اليوزر الي عامل اوثنتيكيشن بالتوكن الي بعتة في الهيدر
        $user = User::find($authenticatedUser->id); //دا كدا اوبكت شايل اليوزر من الداتا بيز
      // if($user-> code == $request-> code &&$user-> code_expired_a < data('y-m-d H:i:s')){}
      if($user-> code == $request-> code &&$user->code_expired_at->gt(now())){}
      
      
      }
}