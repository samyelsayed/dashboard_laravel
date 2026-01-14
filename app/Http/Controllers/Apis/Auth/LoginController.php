<?php

namespace App\Http\Controllers\Apis\Auth;

use Illuminate\Http\Request;
use App\Http\traits\ApiTrait;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{use ApiTrait;
        public function login(Request $request){
}


public function logoutAllDevices(Request $request){
$authenticatedUser = Auth::guard('sanctum')->user();
$authenticatedUser->tokens()->delete();
return $this->SuccessMessage('Logged out from all devices successfully');
}

public function logout(Request $request){
}
}
