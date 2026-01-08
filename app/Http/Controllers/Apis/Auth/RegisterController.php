<?php

namespace App\Http\Controllers\Apis\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
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
        // dd($data);
       $user = User::create($data);          //كدا هقدر اكريت اليوزر في الداتا بيز , ميثورد ال كريات ليها ريترن فاليو عبارة عن المستخدم الي هيا لسا مسجلاه الدا تا بيز
    //    dd($user);
    return $this->successMessage('successful')
}
}
