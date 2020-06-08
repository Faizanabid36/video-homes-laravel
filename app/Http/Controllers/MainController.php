<?php

namespace App\Http\Controllers;

use App\Video;
use App\VideoView;
use App\VideoLikesDislikes;
use Illuminate\Http\Request;
use App\UserExtra;
use App\User;
use App\BlockedUser;
use App\Playlist;
use Illuminate\Support\Facades\Hash;

class MainController extends Controller {
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {
        return view( 'home' );
// return 'sss' ;
    }
    public function directory() {
        return view( 'directory' );
// return 'sss' ;
    }
}
