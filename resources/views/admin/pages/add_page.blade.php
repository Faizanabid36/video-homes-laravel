<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="UTF-8">
    <title>Video Homes</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- global styles-->
    <link type="text/css" rel="stylesheet" href="{{asset('css/components.css')}}"/>
    <link type="text/css" rel="stylesheet" media="screen"
          href="{{asset('vendors/bootstrap3-wysihtml5-bower/css/bootstrap3-wysihtml5.min.css')}}"/>
    <link type="text/css" rel="stylesheet" href="{{asset('vendors/summernote/css/summernote.css')}}"/>
    <link type="text/css" rel="stylesheet" href="{{asset('css/custom.css')}}"/>
    <!-- end of global styles-->
    <link type="text/css" rel="stylesheet" href="{{asset('css/pages/form_elements.css')}}"/>
    <link type="text/css" rel="stylesheet" href="#" id="skin_change"/>
</head>

<body>
<div id="wrap">
@include('admin.layouts.header')
<!-- /#top -->
    <div class="wrapper">
    @include('admin.layouts.sidebar')
    <!-- /#left -->
        <div id="content" class="bg-container">
            <header class="head">
                <div class="main-bar">
                    <div class="row no-gutters">
                        <div class="col-lg-6 col-md-4 col-sm-4">
                            <h4 class="nav_top_align">
                                <i class="fa fa-pencil" aria-hidden="true"></i>
                                Add Page
                            </h4>
                        </div>
                        <div class="col-lg-6 col-md-8 col-sm-8">
                            <ol class="breadcrumb float-right nav_breadcrumb_top_align">
                                <li class="breadcrumb-item">
                                    <a href="index1.html">
                                        <i class="fa fa-home" aria-hidden="true"></i>
                                        Pages
                                    </a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="#">Forms</a>
                                </li>
                                <li class="breadcrumb-item active">Page Editor</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </header>
            <div class="outer">
                @if(Session::has('errors'))
                    <div class="alert alert-warning">{{(Session::get('errors')->first())}}</div>
                @endif
                @if(Session::has('success'))
                    <div class="alert alert-success">{{(Session::get('success'))}}</div>
                @endif
                <div class="inner bg-container">
                    <div class="row summer_note_display">
                        <div class="col-12">
                            <form action="{{action('PageController@store')}}" method="POST">
                                <div class="card-header bg-white">
                                    Page Title
                                    <br>
                                    <input type="title" name="title" class="form-control">
                                </div>
                                <div class="card-header bg-white">
                                    Seo Title
                                    <br>
                                    <input type="title" name="seo_title" class="form-control">
                                </div>
                                <div class="card-header bg-white">
                                    Seo Description
                                    <br>
                                    <input type="title" name="seo_description" class="form-control">
                                </div>
                                <div class="card-header bg-white">
                                    <input type="radio"  name="is_public" value="1">Active
                                    <br>
                                    <input type="radio"  name="is_public" value="0">Inactive
                                </div>
                                <div class="card m-t-35 tinymce_full">
                                    <div class="card-header bg-white">
                                        <i class="livicon" data-name="umbrella" data-size="16" data-loop="true"
                                           data-c="#fff"
                                           data-hc="white"></i>
                                        Page Content
                                    </div>
                                    <div>
                                        <textarea name="content" id="tinymce_full" rows="7"><h2>Edit Page Content</h2>
                                                    Lorem ipsum dolor sit amet, consectetur adipiscing
                                                    elit. Aliquam ullamcorper sapien non nisl facilisis bibendum in
                                                    quis tellus.
                                                    <h4>Editable</h4>
                                                    <ul>
                                                        <li> Lorem ipsum dolor sit amet, consectetur adipiscing</li>
                                                        <li> Aliquam ullamcorper sapien non nisl facilisis.</li>
                                                    </ul>
                                                    <h4></h4>Proin nunc justo felis mollis tincidunt, risus risus pede, posuere cubilia Curae, Nullam euismod, enim. Etiam nibh ultricies dolor
                                        </textarea>
                                    </div>
                                </div>
                                @csrf
                                <input class="btn btn-success" type="submit" value="Save">
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /.inner -->
            </div>
            <!-- /.outer -->
        </div>
        <!-- /#content -->
    </div>

</div>
<!-- /#wrap -->
<!-- global scripts-->
<script type="text/javascript" src="{{asset('js/components.js')}}"></script>
<script type="text/javascript" src="{{asset('js/custom.js')}}"></script>
<!-- end of global scripts-->
<!--Plugin scripts-->
<script type="text/javascript" src="{{asset('vendors/tinymce/js/tinymce.min.js')}}"></script>
<script type="text/javascript"
        src="{{asset('vendors/bootstrap3-wysihtml5-bower/js/bootstrap3-wysihtml5.all.min.js')}}"></script>
<script type="text/javascript" src="{{asset('vendors/summernote/js/summernote.min.js')}}"></script>
<!--End of plugin scripts-->
<!--Page level scripts-->
<script type="text/javascript" src="{{asset('js/pages/form_editors.js')}}"></script>
<!-- end page level scripts -->
</body>

</html>
