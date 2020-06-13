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
                        Edit Category
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
    <div class="col-12 col-xl-12 m-t-25">
        <div class="row">
            <div class="col-lg-12">

                <div class="card inline_section_align media_max_1199">
                    <div class="card-header bg-white">
                        Edit Category
                    </div>
                    <div class="card-block">
                        <form action="{{action('AdminController@update_user_category')}}" method="POST">
                            @csrf
                            <fieldset>
                                <input type="hidden" value="{{$cat->id}}" name="id">
                                <!-- Name input-->
                                <div class="form-group row form_inline_inputs_bot">
                                    <div class="col-lg-1"></div>
                                    <div class="col-lg-4">
                                        <div class="input-group m-t-35">
                                            <input type="text" value="{{$cat->name}}" class="form-control"
                                                   name="name" placeholder="Category Name">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="input-group m-t-35">
                                            <input type="description" value="{{$cat->description}}"
                                                   class="form-control" name="description"
                                                   placeholder=" Category Description">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="input-group m-t-35">
                                            <select name="parent_id" class="form-control">
                                                @if(!is_null($cat->parent_id))
                                                    @foreach($categories as $category)
                                                        <option
                                                            <?php
                                                            if($category->id==$cat->parent_id){
                                                            ?>
                                                            selected
                                                            <?php
                                                            }
                                                            ?>
                                                            class="form-control" value="{{$category->id}}">
                                                            {{$category->name}}
                                                        </option>
                                                    @endforeach
                                                @else
                                                    <option value="" disabled selected>Parent Category(Leave Blank if None)</option>
                                                    @foreach($categories as $category)
                                                        <option class="form-control" value="{{$category->id}}">
                                                            {{$category->name}}
                                                        </option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 m-t-35">
                                        <button
                                            class="btn btn-primary layout_btn_prevent btn-responsive form_inline_btn_margin-top">
                                            Update
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

