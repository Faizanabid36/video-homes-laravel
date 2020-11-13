<?php

namespace App\Http\Controllers\Auth;

use App\AccountType;
use App\Http\Controllers\Controller;
use App\User;
use App\UserCategory;
use App\UserExtra;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller {
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
    public function __construct() {
        $this->middleware( 'guest' );
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showRegistrationForm() {
        $user_category          = UserCategory::levelCategories();
//        $user_category = collect( buildTree( $user_category ) )->values();

//        return $user_category;
        return view( 'auth.register', compact( 'user_category' ) );
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator( array $data ) {
        return Validator::make( $data, [
            'name'        => [ 'string', 'max:255' ],
            'email'       => [ 'required', 'string', 'email', 'max:255', 'unique:users' ],
            'password'    => [ 'required', 'string', 'min:8', 'confirmed' ],
            'g-recaptcha-response'    => [ 'required'],
        ] );
    }

//    /**
//     * Create a new user instance after a valid registration.
//     *
//     * @param array $data
//     *
//     * @return \App\User
//     */
    protected function create( array $data ) {
        $user_data['name']             = $data['name'];
        $user_data['email']            = $data['email'];
        $user_data['username']         = \Str::random( 7 );
        $user_data['password']         = Hash::make( $data['password'] );
        $user                          = User::create( $user_data );
        $usersetting                   = new UserExtra();
        $usersetting->user_id          = $user->id;
        $usersetting->user_category_id = $data['category_id'];
        $usersetting->profile_picture = asset('images/blank.png');
        $usersetting->save();
        return $user;
    }
}
