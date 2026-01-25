<?php

namespace App\Http\Controllers\Apis\Auth;
use Illuminate\Http\Request;
use App\Http\traits\ApiTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\Apis\Auth\SendCodeRequest;
use App\Http\Requests\Apis\Auth\VerifyCodeRequest;
use App\Models\User; // عشان نقدر نكلم جدول المستخدمين
use Illuminate\Support\Facades\Hash; // هنحتاجها لما نيجي نغير الباسورد
use Illuminate\Support\Facades\Validator; // عشان نعمل check على الداتا

class ForgotPasswordController extends Controller
{use ApiTrait;
    public function sendCode(SendCodeRequest $reuest){
        $code = rand(10000,99999);
        $user =User::where('email',$reuest->email)->first();
        $code_expired_at =now()->addMinutes(5);
        $user->update([
            'code'=> $code,
            'code_expired_at'=>$code_expired_at
        ]);
        return $this->Data(['code' =>$code],'code sent successfully',200);
    }


        public function checkCode(VerifyCodeRequest $request){

    $user = User::where([['email',$request->email],['code',$request->code]])->first();
    // dd($user);
    if(is_null($user)){
        return $this->ErrorMessage([],'The code or email invalid');
    }elseif($user->code_expired_at->lt(now())){
        return $this->ErrorMessage([],'The code is expired');
     }else{
        $user->email_verified_at= now();
        $user->code =null;
        $user->code_expired_at =null;
        $user->save();
        return $this->SuccessMessage('code is valid',201,[]);
     }
}
}
