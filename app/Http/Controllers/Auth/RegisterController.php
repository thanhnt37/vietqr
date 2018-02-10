<?php

namespace App\Http\Controllers\Auth;

use App\Organization;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = 'businesses/register';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|min:3|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            'gender' => 'nullable|in:male,female,other',
            'phone' => [
                "nullable",
                "regex:/^(0|84)[0-9]{9,10}$/"
            ],
            'date_of_birth' => 'nullable|date'
        ], [
            'name.*' => 'Tên không hợp lệ.',
            'email.*' => 'Địa chỉ email không hợp lệ.',
            'password.*' => 'Mật khẩu không hợp lệ.',
            'gender.*' => 'Giới tính không hợp lệ.',
            'phone.*' => 'Số điện thoại không hợp lệ.',
            'date_of_birth.*' => 'Ngày sinh không đúng.'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'gender' => 'male',//$data['gender'],
//            'phone' => $data['phone'],
//            'date_of_birth' => $data['date_of_birth'],
        ]);

        $this->registerBusiness($user);

        return $user;
    }

    protected function registerBusiness($user)
    {
        DB::beginTransaction();

        $business = Organization::create([]);

        $user->guaranteeServices()->create([
            'business_id' => $business->id
        ]);

        DB::commit();
    }
}
