<?php

namespace App\Http\Controllers\Apis\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        // dd($request->all());
        $data = $request->except('password', 'password_confirmation'); //مبحتفظش بالباسورد بتاع اليوزر بحتفظ بالهاش بتاعه
        $data['password']=Hash::make($request->password);
        dd($data);
    }
}
