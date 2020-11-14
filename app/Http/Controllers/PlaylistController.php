<?php

namespace App\Http\Controllers;

use App\Playlist;
use Illuminate\Http\Request;

class PlaylistController extends Controller
{
    //
    public function index()
    {
        return Playlist::whereUserId(auth()->id())->get();
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
        dd('here');


        if (request()->validate([
            'name' => 'required',
        ])) {
            dd(request()->all());
            dd('here');
            request()->merge(['user_id' => auth()->user()->id]);
            $status = Playlist::create(request(['name', 'description','user_id']));

            return response(['status' => $status->id,
                'message' => $status ? 'Playlist created!' : 'Error in creating Playlist'
            ]);
        }
    }

    public function show(Playlist $playlist)
    {

    }

    public function edit($id)
    {
    }

    public function update(Playlist $playlist)
    {
        if (request()->validate(['name' => 'required'])) {
            if ($playlist->user_id === auth()->id()) {
                $status = $playlist->update(request(['name', 'description']));

                return response(['status' => $status,
                    'message' => $status ? 'Playlist Updated!' : 'Error in Updating Playlist'
                ]);
            }

            return response(['status' => false, 'message' => 'Something went wrong']);
        }
    }

    public function destroy(Playlist $playlist)
    {
        if ($playlist->user_id === auth()->id()) {
            $status = $playlist->delete();

            return response([
                'status' => $status,
                'message' => $status ? 'Playlist Deleted !' : 'Error in Deleting Playlist'
            ]);
        }

        return response(['status' => false, 'message' => 'Something went wrong']);
    }
}
