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
    <div class="outer">
        <div class="inner bg-light lter bg-container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header bg-white">
                            Videos
                        </div>
                        <div class="card-block">
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
                                            <td><img width="100" height="75" src="{{asset('/storage/'.$video->thumbnail)}}" alt=""></td>
                                            <td>{{$video->title}}</td>
                                            <td>{{$video->description}}</td>
                                            <td>{{$video->video_type}}</td>
                                            <td>{{$video->duration}}</td>
                                            <td>{{$video->size}}</td>
                                            <td>
                                                <button onclick='approve({{$video->id}})' class="btn  btn-primary">
                                                    Approve
                                                </button>
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
    </div>
@endsection
