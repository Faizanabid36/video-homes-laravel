<?php

namespace App\Http\Controllers;

use App\AccountType;
use App\Video;
use App\VideoView;
use App\VideoLikesDislikes;
use Illuminate\Http\Request;
use App\UserExtra;
use App\User;
use App\BlockedUser;
use App\Playlist;
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



    public function logged_user()
    {
        $user = auth()->user();
        $user = collect($user)->except('user_extra.user_id');
        return compact('user');
    }

    public function edit_user_profile()
    {
        $tab = \request('tab');
        $user = \request('user');
        $latitude=\request('location_latitude');
        $longitude=\request('location_longitude');
        if ($tab == 'general') {
            $exists=User::whereUsername($user['username'])->where('id','!=',auth()->user()->id)->first();
            if(!is_null($exists))
            {
                return ['message'=>'Username already taken'];
            }
            if(strlen($user['bio'])>600)
                return ['message'=>'Bio can consist of only 600 characters'];
            $result = User::whereId($user['id'])->update(
                [
                    'email' => $user['email'],
                    'name' => $user['name'],
                    'username' => $user['username'],
                    'role' => $user['role'],
                    'address'=>$user['address'],
                    'phone'=>$user['phone'],
                    'phone2'=>$user['phone2'],
                    'liscense'=>$user['liscense'],
                    'website_title'=>$user['website_title'],
                    'website_link'=>$user['website_link'],
                    'bio'=>$user['bio'],
                ]
            );
            UserExtra::whereUserId($user['id'])->update(['location_latitude'=>$latitude,'location_longitude'=>$longitude]);
            AccountType::whereUserId($user['id'])->update(['role'=>$user['role'],'sub_role_category'=>\request('sub_role_cat'),'sub_role'=>\request('sub_role')]);
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
            $message = 'Settings Updated';
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

    public function get_playlist()
    {
        $playlists = Playlist::whereUserId(auth()->user()->id)->get();
        return compact('playlists');
    }

    public function delete_playlist()
    {
        $id = \request('id');
        $deleted = Playlist::whereUserId(auth()->user()->id)->whereId($id)->delete();
        return compact('deleted');
    }

    public function update_playlist()
    {
        if (\request('purpose') == 'add') {
            $created = Playlist::create([
                'name' => \request('name'),
                'description' => \request('description'),
                'user_id' => auth()->user()->id
            ]);
            $added = !is_null($created) ? 1 : 0;
            return compact('added');
        } elseif (\request('purpose') == 'edit') {
            $updated = Playlist::whereId(\request('id'))
                ->update(['name' => \request('name'),
                    'description' => \request('description')
                ]);
            $added = !is_null($updated) ? 1 : 0;
            return compact('added');
        }
    }

    public function update_likes()
    {
        $video = Video::whereVideoId(request('v'))->first();
        return ['likes' => VideoLikesDislikes::where('video_id',$video->id)->get('likes')];

    }

    public function update_dislikes()
    {
        $video = Video::whereVideoId(request('v'))->first();
        return ['likes' => VideoLikesDislikes::where('video_id',$video->id)->get('likes')];
    }
    public function video_is_played($id)
    {
        return [VideoView::whereId($id)->update(['is_played'=>1])];
    }
}
