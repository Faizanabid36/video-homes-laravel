<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserExtra;
use App\User;
use App\BlockedUser;
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

    public function block_user()
    {
        if (\request('tab') == 'block-user') {
            $user = User::where('username', \request('selectedValue'))->with('blockedbyusers')->first();
            $alreadyblocked = false;
            if (!is_null($user->blockedby)) {
                foreach ($user->blockedby as $blockedby) {
                    if ($blockedby['blocked_user_id'] == $user['id'] && $blockedby['user_id'] == auth()->user()->id)
                        $alreadyblocked = true;
                }
            }
            $blocked = null;
            if (!$alreadyblocked) {
                $blocked = BlockedUser::create([
                    'user_id' => auth()->user()->id,
                    'blocked_user_id' => $user['id'],
                ]);
            }
            $message = !$alreadyblocked && !is_null($blocked) ? 'User Blocked Successfully' : 'Could Not Block User';
            return compact('message', 'user');
        } elseif (\request('tab') == 'privacy-settings') {
            if (!is_null(\request('whoWatches'))) {
                UserExtra::updateOrCreate(['user_id' => auth()->user()->id], ['who_watches' => \request('whoWatches')]);
            }
            if (!is_null(\request('whoComments'))) {
                UserExtra::updateOrCreate(['user_id' => auth()->user()->id], ['who_comments' => \request('whoComments')]);
            }
            if (!is_null(\request('whoShares'))) {
                UserExtra::updateOrCreate(['user_id' => auth()->user()->id], ['who_shares' => \request('whoShares')]);
            }
            $message='Settings Updated';
            return compact('message');
        }
    }

    public function search_to_block_user()
    {
        $q = \request('searchField');
        $users = User::where('username', 'LIKE', $q . "%")
            ->where('id', '!=', auth()->user()->id)
            ->get();
        $userOptions = collect($users)->map(function ($user) use ($users) {
            $blocked = BlockedUser::where('user_id', auth()->user()->id)->where('blocked_user_id', $user->id)->first();
            if (is_null($blocked)) {
                return (object)[
                    'key' => $user->id,
                    'text' => $user->username,
                    'value' => $user->username
                ];
            } else {
                return (object)[];
            }
        });

        return compact('userOptions');
    }
}
