<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\UserCategory;
use Illuminate\Http\Request;

class UserCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $usercategories = UserCategory::where('name', 'LIKE', "%$keyword%")
                ->orWhere('description', 'LIKE', "%$keyword%")
                ->orWhere('parent_id', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $usercategories = UserCategory::latest()->paginate($perPage);
        }

        return view('admin.user-categories.index', compact('usercategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $user_categories = UserCategory::whereNull( 'parent_id' )->get();
        return view('admin.user-categories.create'.compact('user_categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->validate($request, [
			'name' => 'required|max:4'
		]);
        $requestData = $request->all();

        UserCategory::create($requestData);

        return redirect('admin/user-categories')->with('flash_message', 'UserCategory added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $usercategory = UserCategory::findOrFail($id);
        $user_categories = UserCategory::whereNull( 'parent_id' )->get();
        return view('admin.user-categories.show', compact('usercategory','user_categories'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $usercategory = UserCategory::findOrFail($id);
        $user_categories = UserCategory::whereNull( 'parent_id' )->get();
        return view('admin.user-categories.edit', compact('usercategory','user_categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
			'name' => 'required|max:4'
		]);
        $requestData = $request->all();

        $usercategory = UserCategory::findOrFail($id);
        $usercategory->update($requestData);

        return redirect('admin/user-categories')->with('flash_message', 'UserCategory updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        UserCategory::destroy($id);

        return redirect('admin/user-categories')->with('flash_message', 'UserCategory deleted!');
    }
}
