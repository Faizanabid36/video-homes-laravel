<?php

namespace App\Http\Controllers;

use App\User;
use App\UserCategory;
use App\UserExtra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //
        $data = UserCategory::levelCategories();

        return response([
            'user' => collect(auth()->user()->user_extra)->merge(collect(auth()->user())->except(['avatara', 'company_logo'])->all())->except([
                'user_extra',
                'user_id'
            ]),
            'categories' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store( Request $request ) {
        //
        $user_extra = auth()->user()->user_extra;
        $path = "uploads/images";
        if ( request( 'company_logo' ) ) {
            $full_path = ( request()->file( 'company_logo' ) )->store( $path, [ 'disk' => 'public' ] );

            return response( [ "status" => $user_extra->update( [ 'company_logo' => asset( "storage/$full_path" ) ] ) ] );
        }
        if ( request( 'profile_picture' ) ) {
            $full_path = ( request()->file( 'profile_picture' ) )->store( $path, [ 'disk' => 'public' ] );
            return response( [ "status" => $user_extra->update( [ 'profile_picture' => asset( "storage/$full_path" ) ] ) ] );
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show( $id ) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit( $id ) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param User $user
     *
     * @return \Illuminate\Http\Response
     */
    public function update( $id ) {
        //

        $user = auth()->user();
        if ( request( 'currentPassword' ) ) {

            request()->validate( [
                'currentPassword' => 'required|password',
                'newPassword'     => 'required|min:8',
                'confirmPassword' => 'required|same:newPassword',
            ] );
            $user->password = Hash::make( request( 'newPassword' ) );

            return response( [ "success" => $user->save() ] );
        }


        $user->update( request()->only( [ 'username', 'name' ] ) );

        return response( UserExtra::updateOrCreate( [ "user_id" => $user->id ], request()->except( [
            'username',
            'name',
            'email',
            'id',
            'active',
            'role',
            'updated_at',
            'created_at',
            'email_verified_at',
            'remember_token',
            'password',
            "user_id",
            "stripe_id",
            "card_brand",
            "card_last_four",
            "trial_ends_at",
        ] ) ) );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id ) {
        //
        $user = auth()->user();

        return response( [ "success" => $user->delete() ] );
    }

}
