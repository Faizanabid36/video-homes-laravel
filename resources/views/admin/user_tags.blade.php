@extends('admin.layouts.app')
@section('stylesheets')
    <link type="text/css" rel="stylesheet" href="{{asset('vendors/select2/css/select2.min.css')}}"/>
    <link type="text/css" rel="stylesheet" href="{{asset('vendors/datatables/css/scroller.bootstrap.min.css')}}"/>
    <link type="text/css" rel="stylesheet" href="{{asset('vendors/datatables/css/colReorder.bootstrap.min.css')}}"/>
    <link type="text/css" rel="stylesheet" href="{{asset('vendors/datatables/css/dataTables.bootstrap.min.css')}}"/>
    <link type="text/css" rel="stylesheet" href="{{asset('css/pages/dataTables.bootstrap.css')}}"/>
    <link type="text/css" rel="stylesheet" href="{{asset('css/pages/tables.css')}}"/>
@endsection
@section('content')
    <header class="head">
        <div class="main-bar">
            <div class="row no-gutters">
                <div class="col-lg-6 col-md-4 col-sm-4">
                    <h4 class="nav_top_align skin_txt">
                        <i class="fa fa-th"></i>
                        User Tags List
                    </h4>
                </div>
                <div class="col-sm-7 col-lg-6">
                    <ol class="breadcrumb float-right nav_breadcrumb_top_align">
                        <li class="breadcrumb-item">
                            <a href="{{route('add_tag')}}">
                                <i class="fa fa-plus" data-pack="default" data-tags=""></i> Add New Tag
                            </a>
                        </li>
                    </ol>
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
                    <div class="card">
                        <div class="card-header bg-white">
                            Tags
                        </div>
                        <div class="card-block">
                            <div class="table-responsive m-t-10">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Tag Name</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($tags as $tag)
                                        <tr>
                                            <td>{{$tag->tag_name}}</td>
                                            <td>
                                                <a href="{{action('AdminController@edit_tag',$tag->id)}}">
                                                    <button type="button" class="btn btn-labeled btn-warning">
                                                        <span class="btn-label">
                                                            <i class="fa fa-edit"></i>
                                                        </span>
                                                        Edit
                                                    </button>
                                                </a>
                                            </td>
                                            <td>
                                                <a href="{{action('AdminController@delete_tag',$tag->id)}}">
                                                    <button type="button" class="btn btn-labeled btn-danger">
                                                        <span class="btn-label">
                                                            <i class="fa fa-trash"></i>
                                                        </span>
                                                        Delete
                                                    </button>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                {{$tags->links()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

