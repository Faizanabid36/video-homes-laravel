@extends('admin.layouts.app')
@section('content')
    <header class="head">
        <div class="main-bar">
            <div class="row no-gutters">
                <div class="col-lg-6 col-md-4 col-sm-4">
                    <h4 class="nav_top_align skin_txt">
                        <i class="fa fa-th"></i>
                        Videos Pending For Approval
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
                            Videos
                        </div>
                        <div class="">
                            <div class="table-responsive m-t-35">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Thumbnail</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Video Type</th>
                                        <th>Duration</th>
                                        <th>Size</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($videos as $video)
                                        <tr>
                                            <td><img width="100" height="75"
                                                     src="{{asset('/storage/'.$video->thumbnail)}}" alt=""></td>
                                            <td>{{$video->title}}</td>
                                            <td>{{$video->description}}</td>
                                            <td>{{$video->video_type}}</td>
                                            <td>{{gmdate("i:s", $video->duration)}}</td>
                                            <td>{{round((($video->size)/1024)/1024,2)}} MB</td>
                                            <td>
                                                <a href="{{action('AdminController@approve_video',$video->id)}}">
                                                    <button class="btn  btn-success">
                                                        Approve
                                                    </button>
                                                </a>
                                            </td>

                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
@endsection
