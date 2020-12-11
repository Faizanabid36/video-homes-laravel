<?php

namespace App\Http\Controllers;

use App\User;
use App\UserCategory;
use App\UserExtra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = UserCategory::levelCategories();
        return response(
            array(
                'user' => collect(auth()->user()->user_extra)->merge(collect(auth()->user())->except(array('avatara', 'company_logo'))->all())->except(
                    array(
                        'user_extra',
                        'user_id',
                    )
                ),
                'categories' => $data,
            )
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user_extra = auth()->user()->user_extra;
        $path = 'uploads/images';
        if (request('company_logo')) {
            $full_path = (request()->file('company_logo'))->store($path, array('disk' => 'public'));

            return response(array('status' => $user_extra->update(array('company_logo' => asset("storage/$full_path")))));
        }

        if (request('profile_picture')) {
            $image = request('profile_picture');
            $name = time() . '.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
            \Image::make($image)->save(storage_path($path . '/' . $name));
//            Image::make(\request('newFile'))
//                ->save(public_path('/images/resized_image/' . $filename));

//            $full_path = (request()->file('profile_picture'))->store($path, array('disk' => 'public'));
            return response(array('status' => $user_extra->update(array('profile_picture' => asset("storage/$path/$name")))));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param User $user
     *
     * @return string[]
     */
    public function update($id)
    {

        $user = auth()->user();
        if (request('old_password')) {

            request()->validate(
                array(
                    'old_password' => array(
                        'required',
                        'password',
                        function ($attribute, $value, $fail) {

                        },
                    ),
                    'new_password' => 'required|min:8',
                    'confirm_password' => 'required|same:new_password',
                )
            );
            $user->password = Hash::make(request('new_password'));

            $user->save();
            return ['message' => 'Password Changed'];
        }
        request()->validate(
            array(
                'username' => 'unique:users,username,' . auth()->id(),
                'name' => 'required|min:4',
                'company_name' => 'required|min:4',
                'user_category_id' => 'required',
            )
        );
        $user->update(request()->only(array('username', 'name')));

        UserExtra::updateOrCreate(
            array('user_id' => $user->id),
            request()->only(
                array(
                    'bio',
                    'facebook',
                    'instagram',
                    'youtube',
                    'location_latitude',
                    'location_longitude',
                    'direct_phone',
                    'address',
                    'office_phone',
                    'company_name',
                    'license_no',
                    'user_category_id',
                )
            )
        );
        return ['message' => 'Profile Updated'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = auth()->user();

        return response(array('success' => $user->delete()));
    }

    public function update_video_global_settings(Request $request)
    {
        UserExtra::whereUserId(auth()->user()->id)->update($request->only(
            [
                'share_buttons',
                'default_video_state',
                'display_suggested_videos',
                'distribution_type'
            ]
        ));
        $message = 'Settings Updated';
        return compact('message');
    }

}
