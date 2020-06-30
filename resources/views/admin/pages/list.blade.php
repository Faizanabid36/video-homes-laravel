@extends('admin.layouts.app')
@section('content')
    <header class="head">
        <div class="main-bar">
            <div class="row no-gutters">
                <div class="col-lg-6 col-md-4 col-sm-4">
                    <h4 class="nav_top_align skin_txt">
                        <i class="fa fa-th"></i>
                        Public Pages
                    </h4>
                </div>
                <div class="col-sm-7 col-lg-6">
                    <ol class="breadcrumb float-right nav_breadcrumb_top_align">
                        <li class="breadcrumb-item">
                            <a href="{{route('public_pages.create')}}">
                                <i class="fa fa-plus" data-pack="default" data-tags=""></i> Add New Page
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
                    <div class="bg-white">
                        Pages
                    </div>
                    <div class="">
                        <div class="table-responsive m-t-35">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Slug</th>
                                    <th>Seo Title</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($pages as $page)
                                    <tr>
                                        <td><a href="{{action('PageController@edit',$page->id)}}">{{$page->title}}</a></td>
                                        <td>{{$page->slug}}</td>
                                        <td>{{$page->seo_title}}</td>
                                        <td>
                                            <form action="{{action('PageController@destroy',$page->id)}}" method="POST">
                                                @csrf
                                                <input type="hidden" name="_method" value="DELETE">
                                                <a href="{{action('PageController@destroy',$page->id)}}">
                                                    <input type="submit" class="btn  btn-danger" value="Delete Page">
                                                </a>
                                            </form>
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
