@extends('admin.layouts.app')
@section('content')
    <header class="head">
        <div class="main-bar">
            <div class="row no-gutters">
                <div class="col-lg-6 col-md-4 col-sm-4">
                    <h4 class="nav_top_align skin_txt">
                        <i class="fa fa-th"></i>
                        All Users
                    </h4>
                </div>
            </div>
        </div>
    </header>
    @if(Session::has('error'))
        <div class="alert alert-warning">{{(Session::get('error'))}}</div>
    @endif()
    @if(Session::has('success'))
        <div class="alert alert-success">{{(Session::get('success'))}}</div>
    @endif()
    <div class="outer">
        <div class="inner bg-light lter bg-container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="bg-white">
                        Users
                    </div>
                    <div class="">
                        <div class="table-responsive m-t-35">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Picture</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Contact</th>
                                    <th>Address</th>
                                    <th>Delete</th>
                                    <th>Activate/Deactivate</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td><img width="100" height="75"
                                                 src="{{asset(is_null($user->avatar)?'images/blank.png':$user->avatar)}}" alt=""></td>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>{{$user->phone}}</td>
                                        <td>{{$user->address}}</td>
                                        <td>
                                            <a href="{{action('AdminController@delete_user',$user->id)}}">
                                                <button class="btn btn-danger">
                                                    Delete User
                                                </button>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{action('AdminController@deactivate_user',$user->id)}}">
                                                <button class="btn {{$user->active==0?'btn-success':'btn-warning'}}">
                                                    {{$user->active==0?'Activate':'Deactivate'}}
                                                </button>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{$users->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
