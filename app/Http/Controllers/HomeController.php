<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return redirect('dashboard');
    }

    public function logged_user()
    {
        $user = auth()->user();
        return compact('user');
    }

    public function edit_user_profile()
    {
        $tab = \request('tab');
        $user = \request('user');
        if ($tab == 'general') {
            $result = User::whereId($user['id'])->update(
                ['email' => $user['email'], 'gender' => $user['gender'], 'name' => $user['name'], 'username' => $user['username'], 'role' => $user['role']]
            );
            $message = $result == 1 ? 'Profile Updated' : 'Could Not Update Profile';
            return compact('tab', 'message');
        } elseif ($tab == 'delete-account') {
            $password = \request('password');
            $User = User::whereId($user['id'])->first();
            if (Hash::check($password, $User['password'])) {
                $message = User::whereId($user['id'])->delete() == 1 ? 'Account Deleted' : 'Could Not Delete Account';
                return compact('tab', 'message');
            }
            $message = 'Incorrect Password Entered';
            return compact('tab', 'message');
        } elseif ($tab == 'change-password') {
            $User = User::whereId($user['id'])->first();
            $password = \request('password');
            if (Hash::check($password, $User['password'])) {
                $message = User::whereId($user['id'])->update(['password' => Hash::make(\request('new_password'))]) ? 'Password Successfully Changed' : 'Could Not Change Password';
                return compact('tab', 'message');
            }
            $message = 'Incorrect Password Entered';
            return compact('tab', 'message');
        }
    }
}
