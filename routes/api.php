<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Apis\ProductController;

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
  Route::post('store/{id}',[ProductController::class,'store']);
  Route::put('update/{id}',[ProductController::class,'update']);

});
