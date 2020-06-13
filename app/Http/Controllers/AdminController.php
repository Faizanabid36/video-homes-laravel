<?php

namespace App\Http\Controllers;

use App\Category;
use App\User;
use App\UserCategory;
use App\UserTags;
use App\Video;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('admin.home');
    }

    public function videos_for_approval()
    {
        $videos = Video::where('is_video_approved', 0)->get();
        return view('admin.videos_for_approval', compact('videos'));
    }

    public function approve_video($id)
    {
        $v = Video::whereId($id)->update(['is_video_approved' => 1]);
        if ($v) {
            return back()->with('success', 'Video Approved');
        } else {
            return back()->with('error', 'Could Not Approve Video');
        }
    }

    public function category()
    {
        $categories = Category::paginate(5);
        return view('admin.categories', compact('categories'));
    }

    public function delete_category($id)
    {
        $d = Category::whereId($id)->delete();
        if ($d) {
            return back()->with('success', 'Category Deleted');
        } else {
            return back()->with('error', 'Could Not Delete Category');
        }
    }

    public function edit_category($id)
    {
        $category = Category::whereId($id)->first();
        return view('admin.edit_category', compact('category'));
    }

    public function update_category(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);
        $c = Category::whereId($request->input('id'))->update(['name' => $request->input('name'), 'description' => $request->input('description')]);
        if ($c) {
            return back()->with('success', 'Category Updated');
        } else {
            return back()->with('error', 'Could Not Update Category');
        }
    }

    public function store_category(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);
        $c = Category::create($request->only('name', 'description'));
        if (!is_null($c)) {
            return back()->with('success', 'Add New Category');
        } else {
            return back()->with('error', 'Could Not Add Category');
        }
    }

    public function list_user_tags()
    {
        $tags = UserTags::paginate(5);
        return view('admin.user_tags',compact('tags'));
    }
    public function edit_tag($id)
    {
        $tag=UserTags::whereId($id)->first();
        return view('admin.edit_tag',compact('tag'));
    }
    public function delete_tag($id)
    {
//        dd($id);
        UserTags::whereId($id)->delete();
        return back()->with('success','Tag Deleted');
    }
    public function store_tag(Request $request)
    {
        $this->validate($request,[
            'tag_name'=>'required',
        ]);
        $ut=new UserTags();
        $ut->tag_name=$request->get('tag_name');
        $ut->save();
        return back()->with('success', 'Tag Added Successfully');
    }

    public function update_tag(Request $request, $id)
    {
        $this->validate($request, [
            'tag_name' => 'required',
        ]);
        UserTags::whereId($id)->update(['tag_name' => $request->get('tag_name')]);
        return back()->with('success', 'Tag Updated Successfully');
    }

    public function create_user_categories()
    {
        $user_cactegories = UserCategory::all();
        return view('admin.create_user_category', compact('user_cactegories'));
    }

    public function add_user_category(Request $reqeust)
    {
        $this->validate($reqeust, [
            'name' => 'required',
            'description' => 'required',
        ]);
        UserCategory::create(\request()->except('_token'));
        return back()->with('success', 'Category Created Successfully');
    }

    public function all_user_categories()
    {
        $categories = UserCategory::with('children')->with('parent')->get();
        return view('admin.view_user_categories', compact('categories'));

    }

    public function delete_user_category($id)
    {
        $x = UserCategory::find($id);
        $x->delete();
        return back()->with('success', 'Category Deleted');

    }

    public function update_user_category()
    {
        UserCategory::whereId(\request('id'))->update(\request()->except('_token', 'id'));
        return back()->with('success', 'Updated Successfully');
    }

    public function edit_user_category($id)
    {
        $cat = UserCategory::whereId($id)->with('children')->with('parent')->first();
        $categories = UserCategory::where('id', '!=', $id)->with('children')->with('parent')->get();
        return view('admin.edit_user_category', compact('cat', 'categories'));
    }

    public function users_list()
    {
        $users = User::where('id', '!=', auth()->user()->id)->paginate(10);
        return view('admin.users_list', compact('users'));
    }
}
