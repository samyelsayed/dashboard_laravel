<?php

namespace App\Http\Controllers\Apis\Auth;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\traits\ApiTrait;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Apis\Auth\SendCodeRequest;
use App\Http\Requests\Apis\Auth\VerifyCodeRequest;
use App\Http\Requests\Apis\Auth\ResetPasswordRequest;
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
                // $user->email_verified_at= now();
                // $user->code =null;
                // $user->code_expired_at =null;
                // $user->save();
                // return $this->SuccessMessage('code is valid',201,[]);
              $token = Str::random(60);
              DB::table('password_reset_tokens')->updateOrInsert(
                ['email'=>$user->email],
                ['token'=>Hash::make($token),'created_at'=>now()]
              );
                 $user->email_verified_at= now();
                $user->code =null;
                $user->code_expired_at =null;
                $user->save();
                return $this->Data(['reset_token' =>$token],'code is valid',201,[]);
                }
}


             public function ResetPassword(ResetPasswordRequest $request){
                $user = User::where('email',$request->email)->first();
                $resetData= DB::table('password_reset_tokens')->where('email',$request->email)->first();
                if(is_null($resetData)){
                    return $this->ErrorMessage([],'Invalid reset token');

                }elseif(!Hash::check( $request->reset_token ,$resetData->token)){
                    return $this->ErrorMessage([],'Invalid reset token');
                }else{
                    $user->password = Hash::make($request->password);
                    $user->save();
                    DB::table('password_reset_tokens')->where(
                ['email'=>$user->email])->delete();
              return $this->SuccessMessage('Password has been reset successfully', 200);
                }

}
}
