<?php

namespace App\Http\Controllers;

use App\AccountType;
use App\UserTags;
use http\Client\Curl\User;

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
        $account_types=\App\User::with('account_types')->get();
//        return $account_types;
        return view('directory', compact('account_types','tags'));
    }
    public function joe() {
        return view( 'JoeFrenchRealtor' );

    }
}
