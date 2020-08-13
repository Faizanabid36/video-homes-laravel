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
    public function edit()
    {
        //
        $settings = Settings::first();
        return view( 'admin.settings.edit' );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param Settings $settings
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Settings $settings)
    {
        //
        $this->validate(request()->all(),[
            "title"=>"required|min:6|string",
            "description"=>"min:6|string",
            "display_title"=>"required|min:6|string",
            "parallax_video"=>"parallax_video|min:6",
        ]);
        $settings->update(request()->all());
        return redirect( 'admin/setting' )->with( 'flash_message', 'Settings updated!' );
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
