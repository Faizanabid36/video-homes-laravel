<?php

namespace App\Http\Controllers\Admin;

use App\Settings;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Http\Controllers\Controller;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param Settings $settings
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Settings $settings)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Settings  $setting
     *
     * @return Factory|View
     */
    public function edit($id)
    {
        $settings = Settings::findOrFail($id);
        return view( 'admin.settings.edit',compact('settings') );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param Settings $settings
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, Settings $settings)
    {
        //
        request()->validate([ "display_title"=>"required|min:6|string","box_1"=>"array","box_2"=>"array","box_3"=>"array","box_4"=>"array"]);
        $requestData = $request->all();
        if ($request->hasFile('box_1.file')) {
            $requestData['box_1']['file'] = $request->file('box_1.file')->store('uploads', 'public');
        }
        if ($request->hasFile('box_2.file')) {
            $requestData['box_2']['file'] = $request->file('box_2.file')->store('uploads', 'public');
        }
        if ($request->hasFile('box_3.file')) {
            $requestData['box_3']['file'] = $request->file('box_3.file')->store('uploads', 'public');
        }
        if ($request->hasFile('box_4.file')) {
            $requestData['box_4']['file'] = $request->file('box_4.file')->store('uploads', 'public');
        }

        $d =$settings->update(["display_title"=>$requestData['display_title']]);
        dd($d);
        return back()->with( 'flash_message', 'Settings updated!' );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Settings  $settings
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Settings $settings)
    {
        //
    }
}
