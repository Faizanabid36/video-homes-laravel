<?php

namespace App\Http\Controllers;

use App\UserTags;

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
        $tags = UserTags::withCount('account_types')->get();
        $account_types = [];
//        foreach ($tags as $tag) {
//            $account_types[] = AccountType::where('account_type', $tag->id)->with('user')->get();
//        }
        $account_types = \App\User::with('account_types')->get();
//        return $account_types;
        return view('directory', compact('account_types', 'tags'));
    }

    public function directory_by_category($id)
    {
        $tags = [];
        $account_types = \App\User::whereHas('account_types', function ($query) use ($id) {
            return $query->where('account_type', $id);
        })->with('account_types')->get();
//        $tag=UserTags::whereId($id)->with('account_types')->first();
//        return $tag;
//        $account_types = \App\User::with('account_types')->get();
//        return $account_types;
        return view('directory', compact('account_types', 'tags'));
    }

    public function joe()
    {
        return view('JoeFrenchRealtor');

    }
}
