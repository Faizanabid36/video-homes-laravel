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

    public function ex_directory_by_category($role)
    {
        $role_slug = $role;
        $str = str_replace('-', ' ', $role);
        $role = UserRole::whereRole($str)->first();
        $id = $role->id;
        $tags = UserCategory::withCount('sub_roles')->whereRoleId($id)->whereNull('parent_id')->get();
        $users = User::with('account_types', 'user_role')->where('role', $id)->get();
        $users = collect($users)->map(function ($user) {
            $type = AccountType::where('user_id', $user->id)->first();
            $x = UserCategory::whereId($type->sub_role)->first();
            if(!is_null($x))
                return collect($user)->merge(['category_tag' => $x->name]);
        });
        return view('directory.cat_directory', compact('users', 'tags', 'role_slug'));
    }

    public function directory_by_sub_category($role, $sub_role)
    {
        $role_slug = $role;
        $sub_role_slug = $sub_role;
        $role = UserRole::whereRole(str_replace('-', ' ', $role))->first();
        $sId = $role->id;
        $sub_role = UserCategory::whereName(str_replace('-', ' ', $sub_role))->first();
        $cId = $sub_role->id;
        $users = User::whereIn('id', array_values(AccountType::whereRole($sId)->whereSubRole($cId)->pluck('user_id')->toArray()))->get();
        $category = UserCategory::whereId($sub_role->id)->with('children', 'sub_roles')->firstorFail();
        $sub = collect($category->sub_roles)->map(function ($u) {
            $cat = UserCategory::whereId($u->sub_role_category)->first();
            if(!is_null($cat))
                return collect($u)->merge(['name' => $cat->name]);
        })->groupBy('sub_role_category')->values();
        $tags = [];
        foreach ($sub as $tag)
        {
            if(!is_null($tag[0]))
                $tags[] = ['name' => $tag->first()['name'], 'sub_roles_count' => count($tag)];
        }
        $role_cat=true;
        return view('directory.cat_directory', compact('users', 'tags', 'role_slug', 'sub_role_slug','role_cat'));
    }
    public function directory_by_sub_category_role($role, $sub_role,$sub_cat)
    {
        $role_slug = $role;
        $sub_role_slug = $sub_role;
        $sub_cat_slug=$sub_cat;
        $tags=[];
        $cat=UserCategory::whereName(str_replace('-', ' ', $sub_cat))->first();
        $cId = $cat->id;
        $users = User::whereIn('id', array_values(AccountType::whereSubRoleCategory($cId)->pluck('user_id')->toArray()))->get();
        $sub_role_cat=true;
        $role_cat=true;
        return view('directory.cat_directory', compact('users', 'tags', 'role_slug', 'sub_role_slug','role_cat','sub_cat_slug','sub_role_cat'));
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
        $user = User::whereUsername($username)->with('account_types')->firstOrFail();
        return view('directory_videos', compact('user', 'video', 'related_videos'));
    }

    public function joe()
    {
        return view('JoeFrenchRealtor');
    }
    public function account_types()
    {
        return ['account_types'=>UserTags::all()];
    }
}
