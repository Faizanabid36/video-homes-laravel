@extends('layouts.public.app',["title"=>"Home"])
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="header-wrapper">
                    <div class="video-background">
                        <div class="video-foreground">
                            <iframe type="text/html"
                                    src="https://www.youtube.com/embed/3iXYciBTQ0c?autoplay=1&cc_load_policy=1&enablejsapi=1&loop=1&color=white&controls=0&iv_load_policy=3&modestbranding=1&playsinline=1&rel=0&showinfo=0"
                                    frameborder="0" allowfullscreen>
                            </iframe>
                        </div>
                    </div>
                    <div class="header-content">

                        <h4> Connecting Small Business Owners with Local Marketing Pros </h4>
                        <div class="header-button">
                            <button class="  btnCustom1"> VIDEOGRAPHERS</button>
                            <button class=" btnCustom2"> BUSINESS OWNERS</button>
                        </div>

                    </div>
                    <div class="row iconBoxParent position-relative">
                        <div class="card col-md-3 col-sm-6 shadow-lg">
                            <img class="card-img-top images"
                                 src="{{asset('img/video-image-141px.jpeg')}}"
                                 alt="Card image cap"/>
                            <div class="card-body">
                                <h5 class="card-title">Videographers</h5>
                                <p class="card-text">A Platform for your business.</p>
                                <a href="#" class="btn btn-primary">LEARN MORE</a>
                            </div>
                        </div>
                        <div class="card col-md-3 col-sm-6 shadow-lg">
                            <img class="card-img-top images"
                                 src="{{asset('img/Index-Card-jpeg.jpg')}}"
                                 alt="Card image cap"/>
                            <div class="card-body">
                                <h5 class="card-title">Local Business Owners</h5>
                                <p class="card-text">You have a story..let our Marketing Pros tell it!</p>
                                <a href="#" class="btn btn-success">LEARN MORE</a>
                            </div>
                        </div>
                        <div class="card col-md-3 col-sm-6 shadow-lg">
                            <img class="card-img-top images"
                                 src="{{asset('img/House-Icon-Jpeg.jpg')}}"
                                 alt="Card image cap"/>
                            <div class="card-body">
                                <h5 class="card-title">Real Estate Agents</h5>
                                <p class="card-text">Finally a fully integrated solution for production and
                                    distribution that puts you in control.</p>
                                <a href="#" class="btn btn-warning">LEARN MORE</a>
                            </div>
                        </div>
                        <div class="card col-md-3 col-sm-6 shadow-lg">
                            <img class="card-img-top images"
                                 src="{{asset('img/Rss-icon-jpeg.jpg')}}"
                                 alt="Card image cap"/>
                            <div class="card-body">
                                <h5 class="card-title">Writers and Content Producers</h5>
                                <p class="card-text">Tap into our network of video pros and see what cool things you
                                    can accomplish.</p>
                                <a href="#" class="btn btn-dark">LEARN MORE</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid m-0 p-0">
        <div class="header-separator position-relative bg-white">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 100" preserveAspectRatio="none" class="position-absolute">
                <path class="bg-white" d="M737.9,94.7L0,0v100h1000V0L737.9,94.7z"/>
            </svg>
        </div>
    </div>
    <div class="container-fluid" style="background: #2186C4;">
        <div class="container">
            <div class="row py-5">
                <div class="col ">
                    <h3 class="text-white"><strong> Join Us.</strong> It will only take a minute </h3>
                </div>
                <div class="col">
                    <button class="btn btn-warning float-right"> GET STARTED TODAY</button>
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
