<?php

namespace App\Http\Controllers;

use App\AccountType;
use App\User;
use App\UserCategory;
use App\UserRole;
use App\UserTags;
use App\Video;

class MainController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
// return 'sss' ;
    }

    public function directory()
    {
        $tags = UserRole::withCount('account_types')->where('role', '!=', 'admin')->get();
        $account_types = User::with('user_role')->get();
        return view('directory.directory', compact('account_types', 'tags'));
    }

    public function directory_by_category($id)
    {
        $tags=UserCategory::withCount('sub_roles')->whereRoleId($id)->whereNull('parent_id')->get();
        $users = User::with('account_types','user_role')->where('role', $id)->get();
        $users = collect($users)->map(function ($user){
            $type=AccountType::where('user_id',$user->id)->first();
            $x=UserCategory::whereId($type->sub_role)->first();
            return collect($user)->merge(['category_tag'=>$x->name]);
        });
//        return $users;
//        $account_types = \App\User::whereHas('account_types', function ($query) use ($id) {
//            return $query->where('account_type', $id);
//        })->with('account_types')->get();
        return view('directory.cat_directory', compact('users', 'tags'));
    }
    public function ex_directory_by_category($role)
    {
        $str=str_replace('-',' ',$role);
        $role=UserRole::whereRole($str)->first();
        $id=$role->id;
        $tags=UserCategory::withCount('sub_roles')->whereRoleId($id)->whereNull('parent_id')->get();
        $users = User::with('account_types','user_role')->where('role', $id)->get();
        $users = collect($users)->map(function ($user){
            $type=AccountType::where('user_id',$user->id)->first();
            $x=UserCategory::whereId($type->sub_role)->first();
            return collect($user)->merge(['category_tag'=>$x->name]);
        });
        return view('directory.cat_directory', compact('users', 'tags'));
    }

    public function directory_by_sub_category($id)
    {
        $tags=UserCategory::withCount('sub_roles_category')->whereRoleId($id)->whereNull('parent_id')->get();
        return $tags;
    }
    public function directory_by_username($username)
    {
        $video = Video::whereHas('user', function ($query) use ($username) {
            $query->whereUsername($username);
        })->latest()->first();
        $related_videos = [];
        if (!is_null($video)) {
            $related_videos = Video::whereHas('user', function ($query) use ($username) {
                $query->whereUsername($username);
            })->where('id', '!=', $video->id)->latest()->get();
        }
        $user = User::whereUsername($username)->with('account_types')->first();
        return view('directory_videos', compact('user', 'video', 'related_videos'));
        // @for($i=0;$i<count($user->account_types);$i++)
//         @if(isset($user->account_types[$i]->user_tag))
//         <button class="btn-tags"> {{$user->account_types[$i]->user_tag->tag_name}} <i
//                 class='fas icon fa-tag'></i></button>
//     @endif
// @endfor
    }

    public function joe()
    {
        return view('JoeFrenchRealtor');
    }

    public function directory_by_user_video($username, $video_id)
    {
        $user = User::whereUsername($username)->with('account_types')->first();
        $video = Video::whereHas('user', function ($query) use ($username) {
            $query->whereUsername($username);
        })->where('video_id', $video_id)->first();
        if(!is_null($video))
        {
            $related_videos = Video::whereHas('user', function ($query) use ($username) {
                $query->whereUsername($username);
            })->where('id', '!=', $video->id)->latest()->get();
        }
        return view('directory_videos', compact('user', 'video', 'related_videos'));
    }
    public function account_types()
    {
        return ['account_types'=>UserTags::all()];
    }
}
