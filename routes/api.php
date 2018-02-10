<?php

use App\Organization;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/register', function (Request $request) {

    $data = $request->all();

    $validator = Validator::make($data, [
        'name' => 'required|min:3|max:255',
        'email' => 'required|email|max:255|unique:users',
        'password' => 'required|min:6',
    ], [
        'name.*' => 'Tên không hợp lệ, ít nhất 3 ký tự.',
        'email.*' => 'Địa chỉ email không hợp lệ hoặc đã tồn tại.',
        'password.*' => 'Mật khẩu không hợp lệ, ít nhất 6 ký tự.',
    ]);

    if ($validator->fails()) {

        $errors = array_map(function ($message) {
            return [
                'message' => $message
            ];
        }, $validator->errors()->all());

        return response()->json([
            "error" => [
                "message" => "Request invalid",
                "errors" => $errors
            ]
        ]);
    }

    $user = User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => bcrypt($data['password']),
        'gender' => 'male',
    ]);

    DB::beginTransaction();

    $business = Organization::create([]);

    $user->guaranteeServices()->create([
        'business_id' => $business->id
    ]);

    DB::commit();

    return response()->json([
        "success" => true
    ]);
});
