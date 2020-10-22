<?php

namespace App\Http\Controllers;

use App\Category;
use App\Settings;
use App\UserCategory;
use App\UserMessage;
use App\Video;
use App\VideoView;
use Illuminate\Http\Request;

class MainController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $setting = Settings::first();

        return view('home', compact('setting'));
    }


    public function directory($level1 = null, $level2 = null)
    {

        $industries = UserCategory::getCategories();
        $categories = UserCategory::getCategories($level1, $level2);
        $video_categories = Category::all();
        $users = collect(grabUsers($categories));
        $videos = [];
        if (request('category_id')) {
            $videos = Category::approvedVideos()->find(request('category_id'));
        }

        return view('directory.index', compact('users', 'categories', 'industries', 'level1', 'video_categories', 'videos'));
    }

    public function page_or_username($username, $video_id = null)
    {
        if (request()->ajax()) {
            return ["isProcessed" => Video::userVideos($username, $video_id)->first()->processed];
        }
        if (request('page')) {
            return view('page', request()->only(['page']));
        }
        $video = Video::userVideos($username, $video_id)->first();
        $views = $video ? VideoView::videoViews($video) : 0;
        $user = request('username');
        $related_videos = $views ? Video::userVideos($username, $video->id, true)->get() : [];
        $ratingsUser = UserMessage::userRating($user->id)->get();
        $total_ratings = $ratings[1] = $ratings[2] = $ratings[3] = $ratings[4] = $ratings[5] = 0;
        if (!is_null($ratingsUser)) {
            $total_ratings = $ratingsUser->count();
            $ratings = $ratingsUser->groupBy('rating');
            for ($x = 1; $x <= 5; $x++) {
                $ratings[$x] = isset($ratings[$x]) ? $ratings[$x]->count() : 0;
                $total_ratings = $total_ratings == 0 ? 1 : $total_ratings;
                $rating[$x] = ($ratings[$x] / $total_ratings) * 100;
            }
        }


        $ratings = [];
        $all_ratings = UserMessage::userRating($user->id)->get();
        if (!is_null($all_ratings))
            $ratings = collect($all_ratings)->map(function ($rate) {
                return [
                    'name' => collect($rate->user)->get('name'),
                    'video_title' => collect($rate->video)->get('title'),
                    'review' => $rate->message,
                    'rating' => $rate->rating,
                    'time' => $rate->created_at->diffForHumans(),
                    'avatar' => is_null($rate->user->user_extra->profile_picture) ? 'https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcTMgrxYAqZF6-kdFuLQesPwdAyonhn93LsxvKXax0vzbCCGd_wQ&usqp=CAU' : $rate->user->user_extra->profile_picture,
                ];
            });
//        return compact('ratings');
        return view($video && !$video->processed ? 'directory.processing' : 'directory.single', compact('ratings', 'user', 'rating', 'video', 'related_videos', 'views'));
    }

    public function embed( $video_id ) {
        $video = Video::singleVideo( $video_id )->firstOrFail();
        VideoView::videoViews( $video, [ "from_website" => 0 ] );

        return view( 'embed_video', compact( 'video' ) );
    }
    public function watch_from_admin(Request $request)
    {
        $video = Video::whereProcessed(1)->whereVideoId($request->get('v'))->firstOrFail();
        return view('embed_video', compact('video'));
    }

    public function page( $slug ) {
        return view( 'page', request()->only( [ 'page' ] ) );
    }

    public function isplay( Video $video ) {
        return [ "success" => VideoView::videoViews( $video, [ "is_played" => 1 ] ) ];
    }


//    public function directory_by_user_video( $username ) {
//        $video          = Video::whereHas( 'user', function ( $query ) use ( $username ) {
//            $query->whereUsername( $username );
//        } )->where( 'processed', 1 )->where( 'is_video_approved', 1 )->latest()->first();
//        $related_videos = [];
//        if ( ! is_null( $video ) ) {
//            $related_videos = Video::whereHas( 'user', function ( $query ) use ( $username ) {
//                $query->whereUsername( $username );
//            } )->where( 'id', '!=', $video->id )->where( 'processed', 1 )->where( 'is_video_approved', 1 )->latest()->get();
//        }
//        $user = User::whereUsername( $username )->with( 'account_types' )->firstOrFail();
//
//        return view( 'directory_videos', compact( 'user', 'video', 'related_videos' ) );
//    }
//    public function directory() {
//        $role_slug = '';
//        $directory = true;
//        $tags      = UserRole::withCount( 'account_types' )->where( 'role', '!=', 'admin' )->get();
//        $users     = User::with( 'user_role' )->where( 'role', '!=', 1 )->get();
//
//        return view( 'directory.cat_directory', compact( 'users', 'tags', 'role_slug', 'directory' ) );
//    }
//

//
//    public function account_types() {
//        $roles = UserRole::where( 'role', '!=', 'admin' )->get();
//        $roles = collect( $roles )->map( function ( $role ) {
//            return collect( $role )->merge( [ 'sub_roles' => UserCategory::whereRoleId( $role->id )->whereNull( 'parent_id' )->with( 'children' )->get() ] );
//        } );
//
//        return compact( 'roles' );
//    }
//
//    public function search_in_directory( Request $request ) {
//        $users     = User::whereRole( $request->get( 'industry' ) )
//                         ->where( 'name', 'like', $request->get( 'query' ) . "%" )
//                         ->orWhere( 'email', $request->get( 'query' ) )
//                         ->orWhere( 'username', 'like', $request->get( 'query' ) . "%" )
//                         ->orWhere( 'address', 'like', $request->get( 'query' ) . "%" )
//                         ->get();
//        $tags      = [];
//        $role_slug = '';
//
//        return view( 'directory.cat_directory', compact( 'users', 'tags', 'role_slug' ) );
//
//        return $users;
//    }
//
//    public function ex_directory_by_category( $role ) {
//        $role_slug = $role;
//        $str       = str_replace( '-', ' ', $role );
//        $role      = UserRole::whereSlug( $role_slug )->firstOrFail();
//        $id        = $role->id;
//        $tags      = UserCategory::withCount( 'sub_roles' )->whereRoleId( $id )->whereNull( 'parent_id' )->get();
//        $users     = User::with( 'account_types', 'user_role' )->where( 'role', $id )->get();
////        $users = collect($users)->map(function ($user) {
////            $type = AccountType::where('user_id', $user->id)->first();
////            $x = UserCategory::whereId($type->sub_role)->first();
////            if(!is_null($x))
////                return collect($user)->merge(['category_tag' => $x->name]);
////            else
////                return collect($user)->merge(['category_tag' => '']);
////        });
//        return view( 'directory.cat_directory', compact( 'users', 'tags', 'role_slug' ) );
//    }
//
//    public function directory_by_sub_category( $role, $sub_role ) {
//        $role_slug     = $role;
//        $sub_role_slug = $sub_role;
//        $role          = UserRole::whereSlug( $role_slug )->firstOrFail();
//        $sId           = $role->id;
//        $sub_role      = UserCategory::whereSlug( $sub_role )->firstOrFail();
//        $cId           = $sub_role->id;
//        $users         = User::whereIn( 'id', array_values( AccountType::whereRole( $sId )->whereSubRole( $cId )->pluck( 'user_id' )->toArray() ) )->get();
//        $category      = UserCategory::whereId( $sub_role->id )->with( 'children', 'sub_roles' )->firstorFail();
//        $sub           = collect( $category->sub_roles )->map( function ( $u ) {
//            $cat = UserCategory::whereId( $u->sub_role_category )->first();
//            if ( ! is_null( $cat ) ) {
//                return collect( $u )->merge( [ 'name' => $cat->name ] );
//            }
//        } )->groupBy( 'sub_role_category' )->values();
//        $tags          = [];
//        foreach ( $sub as $tag ) {
//            if ( ! is_null( $tag[0] ) ) {
//                $tags[] = [ 'name' => $tag->first()['name'], 'sub_roles_count' => count( $tag ) ];
//            }
//        }
//        $role_cat = true;
//
//        return view( 'directory.cat_directory', compact( 'users', 'tags', 'role_slug', 'sub_role_slug', 'role_cat' ) );
//    }
//
//    public function directory_by_sub_category_role( $role, $sub_role, $sub_cat ) {
//        $role_slug     = $role;
//        $sub_role_slug = $sub_role;
//        $sub_cat_slug  = $sub_cat;
//        $tags          = [];
//        $cat           = UserCategory::whereSlug( $sub_cat )->firstOrFail();
//        $cId           = $cat->id;
//        $users         = User::whereIn( 'id', array_values( AccountType::whereSubRoleCategory( $cId )->pluck( 'user_id' )->toArray() ) )->get();
//        $sub_role_cat  = true;
//        $role_cat      = true;
//
//        return view( 'directory.cat_directory', compact( 'users', 'tags', 'role_slug', 'sub_role_slug', 'role_cat', 'sub_cat_slug', 'sub_role_cat' ) );
//    }

}
