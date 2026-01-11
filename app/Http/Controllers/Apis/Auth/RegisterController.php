<?php

namespace App\Http\Controllers\Apis\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\traits\ApiTrait;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;


class RegisterController extends Controller
{      use ApiTrait;

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
       $user->token = "Bearer " .$user->createToken($request->device_name)->plainTextToken;     //هنا بعمل توكن لليوزر بعد ما سجل و بستخدم الديفايس نيم الي جاي من الريكوست علشان احدد بيه التوكن وبيرير بعرفه نوع التوكن دا ايه
    return $this->Data(compact('user'),'successful',201);
}
}
