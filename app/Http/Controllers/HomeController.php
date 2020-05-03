<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

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
        $result = User::whereId($user['id'])->update(
            ['email' => $user['email'], 'gender' => $user['gender'], 'name' => $user['name'], 'username' => $user['username'], 'role' => $user['role']]
        );
        return compact('tab', 'result');
    }
}
