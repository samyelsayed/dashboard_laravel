<?php

namespace App\Http\Controllers\Apis\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Apis\Auth\SendCodeRequest;
use App\Models\User; // عشان نقدر نكلم جدول المستخدمين
use App\Http\traits\ApiTrait;
use Illuminate\Support\Facades\Hash; // هنحتاجها لما نيجي نغير الباسورد
use Illuminate\Support\Facades\Validator; // عشان نعمل check على الداتا

class ForgotPasswordController extends Controller
{use ApiTrait;
    public function sendCode(SendCodeRequest $reuest){
        $code = rand(10000,99999);
        $user =User::where('email',$reuest->email)->first();
        $code_expired_at =now()->addMinutes(2);
        $user->update([
            'code'=> $code,
            'code_expired_at'=>$code_expired_at
        ]);
        return $this->Data(['code' =>$code],'code sent successfully',200);
    }
}
