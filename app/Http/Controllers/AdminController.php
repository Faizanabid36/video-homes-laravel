<?php

namespace App\Http\Controllers;

use App\Category;
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
        $this->validate($request,[
            'name'=>'required',
        ]);
        $c=Category::whereId($request->input('id'))->update(['name'=>$request->input('name'),'description'=>$request->input('description')]);
        if ($c) {
            return back()->with('success', 'New Category Create');
        } else {
            return back()->with('error', 'Could Not Add Category');
        }
    }
    public function store_category(Request $request)
    {
        $this->validate($request,[
            'name'=>'required',
        ]);
        $c=Category::create($request->only('name','description'));
        if (!is_null($c)) {
            return back()->with('success', 'Category Updated');
        } else {
            return back()->with('error', 'Could Not Update Category');
        }
    }
}
