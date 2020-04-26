<?php

namespace App\Http\Controllers;

use App\Playlist;
use Illuminate\Http\Request;

class PlaylistController extends Controller
{
    //
    public function index(){
        return Playlist::whereUserId(auth()->id())->get();
    }
    public function create(){}
    public function store(){
        if ( request()->validate( [
            'title' => 'required',
        ] ) ) {
            $status = Playlist::create(request(['title','description']));
            return response([ 'status'  => $status->id, 'message' => $status ? 'Playlist Updated!' : 'Error in Updating Playlist' ] );
        }
    }
    public function show(Playlist $playlist){
        return $playlist->user_id === auth()->id() ? $playlist : false;
    }
    public function edit($id){}
    public function update(Playlist $playlist){
        if ( request()->validate( [
            'title' => 'required',
        ] ) ) {
            $status = $playlist->update( request([ 'name', 'description']) );
            return response([ 'status'  => $status, 'message' => $status ? 'Playlist Updated!' : 'Error in Updating Playlist' ] );
        }
    }
    public function destroy(Playlist $playlist){
        $status =  $playlist->delete();
        return response([
            'status' => $status,
            'message' => $status ? 'Playlist Deleted !' : 'Error in Deleting Playlist'
        ]);
    }
}
