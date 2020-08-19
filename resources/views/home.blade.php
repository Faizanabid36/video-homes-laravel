@extends('layouts.public.app',["title"=>"Home"])
@section('content')
    <div class="container-fluid">
        <div class="video-background">
            <div class="video-foreground">
                <iframe loop="1" autoplay="1" mute="1" src="{{$setting->parallax_video }}" frameborder="0"
                        allowfullscreen>

                </iframe>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="header-wrapper">
                    <div class="header-content">

                        <h4> {{$setting->display_title}}</h4>
                        <div class="header-button">
                            <a href="{{$setting->button_1_link}}"
                               class="btnCustom1 text-white"> {{$setting->button_1}}</a>

                            <a href="{{$setting->button_2_link}}"
                               class="btnCustom2 text-white"> {{$setting->button_2}}</a>
                        </div>

                    </div>
                    <div class="row position-relative iconBoxParent text-center">
                        <div class="card col-md-3 col-sm-12 shadow-lg p-1">
                            <img class="w-50 pt-4 px-2 mx-auto"
                                 src="{{asset('img/video-image-141px.jpeg')}}"
                                 alt="Card image cap"/>
                            <div class="card-body px-1">
                                <h5 class="card-title">{{$setting->box_1['title']}}</h5>
                                <p class="card-text">{{$setting->box_1['description']}}</p>
                                <button href="{{$setting->box_1['btn_link']}}"
                                        class="btn btn-primary">{{$setting->box_1['btn']}}</button>
                            </div>
                        </div>
                        <div class="card col-md-3 col-sm-12 shadow-lg p-1">
                            <img class="w-50 pt-4 px-2 mx-auto"
                                 src="{{asset('img/Index-Card-jpeg.jpg')}}"
                                 alt="Card image cap"/>
                            <div class="card-body px-1">
                                <h5 class="card-title">{{$setting->box_2['title']}}</h5>
                                <p class="card-text">{{$setting->box_2['description']}}</p>
                                <button href="{{$setting->box_2['btn_link']}}"
                                        class="btn btn-primary">{{$setting->box_2['btn']}}</button>
                            </div>
                        </div>
                        <div class="card col-md-3 col-sm-12 shadow-lg p-1">
                            <img class="w-50 pt-4 px-2 mx-auto"
                                 src="{{asset('img/House-Icon-Jpeg.jpg')}}"
                                 alt="Card image cap"/>
                            <div class="card-body px-1">
                                <h5 class="card-title">{{$setting->box_3['title']}}</h5>
                                <p class="card-text">{{$setting->box_3['description']}}</p>
                                <button href="{{$setting->box_3['btn_link']}}"
                                        class="btn btn-primary">{{$setting->box_3['btn']}}</button>
                            </div>
                        </div>
                        <div class="card col-md-3 col-sm-12 shadow-lg p-1">
                            <img class="w-50 pt-4 px-2 mx-auto"
                                 src="{{asset('img/Rss-icon-jpeg.jpg')}}"
                                 alt="Card image cap"/>
                            <div class="card-body px-1">
                                <h5 class="card-title">{{$setting->box_4['title']}}</h5>
                                <p class="card-text">{{$setting->box_4['description']}}</p>
                                <button href="{{$setting->box_4['btn_link']}}"
                                        class="btn btn-primary">{{$setting->box_4['btn']}}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid p-0" style="margin-top:-100px;">
        <div class="header-separator position-relative bg-white">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 100" preserveAspectRatio="none"
                 class="position-absolute">
                <path class="bg-white" d="M737.9,94.7L0,0v100h1000V0L737.9,94.7z"/>
            </svg>
        </div>
    </div>
    <div class="container-fluid" style="background: #2186C4;">
        <div class="container">
            <div class="row py-5">
                <div class="col-md-6 text-sm-center text-md-left">
                    <h3 class="text-white">{{$setting->call_to_action_title}}</h3>
                </div>
                <div class="col-md-6 text-sm-center text-md-right">
                    <a href="{{$setting->call_to_action_link}}"
                       class="btn btn-warning"> {{$setting->call_to_action}}</a>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid" style="background: #7e7a7a;">
        <div class="container">
            <div class="row">
                <div class="offset-md-2 col-md-8 py-5">
                    <div class="text-center text-white">
                        <h1>Say Hello!</h1>
                        <p> Please contact us for more information.</p>
                        <form class="form bg-white text-dark p-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1">YOUR NAME(REQUIRED)</label>
                                <input type="text" class="form-control" id="name" aria-describedby="name">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">YOUR EMAIL (REQUIRED)</label>
                                <input type="email" class="form-control" id="exampleInputEmail1"
                                       aria-describedby="emailHelp">

                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">SUBJECT</label>
                                <input type="text" class="form-control" id="exampleInputPassword1" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">YOUR MESSAGE</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary">SEND</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
