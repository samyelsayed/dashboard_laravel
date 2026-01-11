<?php

use App\Http\Controllers\Apis\Auth\EmailVerificationController;
use App\Http\Controllers\Apis\Auth\RegisterController;
use App\Http\Controllers\Apis\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// جرب إضافة هذا المسار للتأكد من عمل الـ API
Route::get('/test', function () {
    return response()->json([
        'status' => 'success',
        'message' => 'API is working correctly ya smsm!'
    ]);
});

// Route::get('/test', function () {
//     return response()->json(['status' => 'success', 'message' => 'API is working!']);
// });


Route::group(['prefix' => 'products'],function () {
  Route::get('/',[ProductController::class,'index']);
  Route::get('create',[ProductController::class,'create']);
  Route::get('edit/{id}',[ProductController::class,'edit']);
  Route::post('store',[ProductController::class,'store']);
  Route::post('update/{id}',[ProductController::class,'update']);
  Route::post('destroy/{id}',[ProductController::class,'destroy']);
});


Route::group(['prefix' => 'users'],function () {
    Route::post('register',RegisterController::class);
    // Route::post('send-code',[EmailVerificationController::class,'sendCode']);
});



// api.php
Route::middleware('auth:sanctum')->group(function () {
    // أي Route هنا هيعرف يقرأ التوكن ويجيب اليوزر
    Route::post('auth/send-code', [EmailVerificationController::class, 'sendCode']);
});
