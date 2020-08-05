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
                        Create User Category
                    </h4>
                </div>
            </div>
        </div>
    </header>
    @if(Session::has('errors'))
        <div class="alert alert-warning">{{(Session::get('errors')->first())}}</div>
    @endif()
    @if(Session::has('success'))
        <div class="alert alert-success">{{(Session::get('success'))}}</div>
    @endif()
    <div class="col-12 col-xl-12 m-t-25">
        <div class="row">
            <div class="col-lg-12">

                <div class="card inline_section_align media_max_1199">
                    <div class="card-header bg-white">
                        Create User Category
                    </div>
                    <div class="card-block">
                        <form action="{{action('AdminController@add_user_category')}}" method="POST">
                            @csrf
                            <fieldset>
                                <!-- Name input-->
                                <div class="form-group row form_inline_inputs_bot">
                                    <div class="col-lg-1"></div>
                                    <div class="col-lg-4">
                                        <div class="input-group m-t-35">
                                            <select class="form-control" name="parent_role">
                                                <option selected disabled>Select Role</option>
                                                @foreach($roles as $role)
                                                    <option value="{{$role->id}}">{{$role->role}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="input-group m-t-35">
                                            <input required type="text" class="form-control" name="name"
                                                   placeholder="Category Name">
                                        </div>
                                        <div class="input-group m-t-35">
                                            <input required type="text" class="form-control" name="description"
                                                   placeholder="Category Description">
                                        </div>
                                        <div class="input-group m-t-35">
                                            @if(count($user_categories)>0)
                                                <select name="parent_id" class="form-control">
                                                    <option value="" disabled selected>Parent Category(Leave Blank if None)</option>
                                                    @foreach($user_categories as $user_category)
                                                        <option class="form-control" value="{{$user_category->id}}">
                                                            {{$user_category->name}}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-3 m-t-35">
                                        <button
                                            class="btn btn-primary layout_btn_prevent btn-responsive form_inline_btn_margin-top">
                                            Save Category
                                        </button>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

`
