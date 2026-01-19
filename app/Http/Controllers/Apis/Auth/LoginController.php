<?php

namespace App\Http\Controllers\Apis\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\traits\ApiTrait;
use App\Http\Requests\loginReguest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{use ApiTrait;
        public function login(loginReguest $request){
        $user = User::where('email',$request->email)->first();     //في اللاين دا انا ضامن ان الاميل صح لاني شيكت عليه في الفالديشن
        if(! Hash::check($request->password,$user->password)){
            return $this->ErrorMessage(['email'=>'the provided credentials are incorrect'],'Wrong Attempt',422);     //credentials معناها بيانات الدخول
            }
           $user->token = 'Bearer ' . $user->createToken($request->device_name)->plainTextToken;
        if(is_null($user->email_verified_at)){
            return $this->Data(compact('user'),'Your account is not verified yet',401);
        }
        return $this->Data(compact('user'));
        }
public function logoutAllDevices(Request $request){
$authenticatedUser = Auth::guard('sanctum')->user();
$authenticatedUser->tokens()->delete();
return $this->SuccessMessage('Logged out from all devices successfully');
}

public function logout(Request $request){
    $authenticatedUser = Auth::guard('sanctum')->user();
    $token = $request->header('Authorization'); // get token from request header
    $BearerWithId =explode('|',$token)[0];
    // $tokenId = str_replace('Bearer ','',$BearerWithId); // الفانكشن دي بيقولي اديني الحاجة الي انت عاوز تستبدلها وعاوز تستبدلها بايه والحاجة دي متخزنه في انه فريبول
      $tokenId = explode(' ',$BearerWithId)[1];

   $authenticatedUser->tokens()->where('id',$tokenId)->delete();
    return $this->SuccessMessage('Logged out successfully');
}
}
