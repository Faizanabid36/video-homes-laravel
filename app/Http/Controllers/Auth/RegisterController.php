<?php

namespace App\Http\Controllers\Auth;

use App\AccountType;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
//    protected $redirectTo = RouteServiceProvider::HOME;
    protected $redirectTo = '/dashboard';

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
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user_data['password'] = Hash::make($data['password']);
        $user_data['name'] = $data['name'];
        $user_data['username'] = $data['username'];
        $user_data['email'] = $data['email'];
        $user_data['role'] = $data['role'];
        $user_data['address'] = $data['address'];
        $user_data['phone'] = $data['phone'];
        $user_data['phone2'] = $data['phone2'];
        $user = User::create($user_data);
        $account_type = new AccountType();
        $account_type->sub_role_category = isset($data['sub_role_category'])?$data['sub_role_category']:"";
        $account_type->sub_role = isset($data['sub_role'])?$data['sub_role']:"";
        $account_type->user_id =$user->id;
        $account_type->role = isset($data['role'])?$data['role']:"";
        $account_type->save();
        return $user;
        // dd ($data['account_type']);

        // dd($data);
    }
}
