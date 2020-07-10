<?php

namespace App\Http\Controllers;

use App\Http\Requests\PageValidationRequest;
use App\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PageController extends Controller
{
    public function index()
    {
        //
        $pages=Page::all();
        return view('admin.pages.list',compact('pages'));
    }

    public function create()
    {
        return view('admin.pages.add_page');
    }

    public function store(PageValidationRequest $request)
    {
        $request->merge(['slug'=>Str::slug($request->title)]);
        $page=Page::create($request->except('_token'));
        return back()->withSuccess('Page Created Successfully');

    }

    public function show(Page $page)
    {
        //
    }

    public function edit($id)
    {
        $page=Page::find($id);
        return view('admin.pages.edit_page',compact('page'));
    }

    public function update(PageValidationRequest $request,$page)
    {
        $request->merge(['slug'=>Str::slug($request->title)]);
        Page::whereId($page)->update($request->except('_token','_method'));
        return back()->withSuccess('Page Updated Successfully');
    }


    public function destroy($page)
    {
        Page::whereId($page)->delete();
        return back()->withSuccess('Page Deleted Successfully');
    }

    public function view($slug)
    {
        $page=Page::viewPage($slug)->first();
        return view('page',compact('page'));
    }
}
