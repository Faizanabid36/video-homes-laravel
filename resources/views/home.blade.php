@extends('layouts.public.app')
@section('content')
    <div class="container-fluid m-0 p-0">

        <div class="row  m-0 p-0">
            <div class="col m-0 p-0 ">
                <!-- Nav       -->

                <nav class="navbar navbar-expand-lg navbar-light bg-light home-nav ">
                    <a class="navbar-brand" href="#">

                        <img src="https://www.videohomes.com/wp-content/uploads/2020/04/cropped-VideoHomes-3.png"
                             class="logo" alt="video Homes Logo"/>


                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ml-auto links-home">
                            <li class="nav-item ">
                                <a class="nav-link" href="#">DIRECTORY <span class="sr-only">(current)</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">MEDIA PROS</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">BUSSINESS</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">BLOG</a>
                            </li>


                        </ul>

                    </div>
                </nav>

                <!-- Nav-end -->


            </div>


        </div>

        <div class="row">

            <div class="col-12 m-0 p-0 ">

                <div class="header-wrapper">


                    <div class="video-frame">
                        <iframe frameborder="0"
                                src="https://www.youtube.com/embed/3iXYciBTQ0c?autoplay=1&controls=0&disablekb=1&fs=0&iv_load_policy=3&loop=1&modestbranding=1&playsinline=1&rel=0&showinfo=0&enablejsapi=1&origin=http%3A%2F%2Fwww.videohomes.com&widgetid=1">
                        </iframe>
                    </div>
                    <div class="header-separator header-separator-bottom "><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 100" preserveAspectRatio="none">
                            <path class="svg-white-bg" d="M737.9,94.7L0,0v100h1000V0L737.9,94.7z"/>
                        </svg></div>
                    <div class="header-content">

                        <h4> Connecting Small Bussiness Owners with Local Marketing Pros </h4>
                        <div class="header-button">
                            <button class="  btnCustom1"> VIDEOGRAPHERS</button>
                            <button class=" btnCustom2"> BUSSINESS OWNERS</button>
                        </div>

                    </div>


                    <div class=" iconBoxParent">
                        <div class="icons-boxes  ">

                            <div class="card" style="width: 18rem;">
                                <img class="card-img-top images"
                                     src="http://videohomes.com/wp-content/uploads/2019/07/video-image-141px.jpeg"
                                     alt="Card image cap"/>
                                <div class="card-body">
                                    <h5 class="card-title">Videographers</h5>
                                    <p class="card-text">A Platform for your business.</p>
                                    <a href="#" class="btn btn-primary">LEARN MORE</a>
                                </div>
                            </div>

                            <div class="card" style="width: 18rem;">
                                <img class="card-img-top images"
                                     src="http://videohomes.com/wp-content/uploads/2019/07/Index-Card-jpeg.jpg"
                                     alt="Card image cap"/>
                                <div class="card-body">
                                    <h5 class="card-title">Local Business Owners</h5>
                                    <p class="card-text">You have a story..let our Marketing Pros tell it!</p>
                                    <a href="#" class="btn btn-success">LEARN MORE</a>
                                </div>
                            </div>

                            <div class="card" style="width: 18rem;">
                                <img class="card-img-top images"
                                     src="http://videohomes.com/wp-content/uploads/2019/07/House-Icon-Jpeg.jpg"
                                     alt="Card image cap"/>
                                <div class="card-body">
                                    <h5 class="card-title">Real Estate Agents</h5>
                                    <p class="card-text">Finally a fully integrated solution for production and
                                        distribution that puts you in control.</p>
                                    <a href="#" class="btn btn-warning">LEARN MORE</a>
                                </div>
                            </div>

                            <div class="card" style="width: 18rem;">
                                <img class="card-img-top images"
                                     src="http://videohomes.com/wp-content/uploads/2019/07/Rss-icon-jpeg.jpg"
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

        <!-- next -->

        <div class="row  m-0 p-0 ">
            <div class="col-12 m-0 p-0 ">
                <div class="joinUs">
                    <span> <b> Join Us. </b>It will only take a minute </span> <span>  <button class="btn "> GET STARTED TODAY </button>  </span>
                </div>
            </div>
        </div>


        <div class="row sayHello m-0 p-0 ">
            <div class="col-12 m-0 p-0 ">
                <div class="form-home">

                    <h1> Say Hello ! </h1>
                    <p> Please contact us for more inforamation </p>

                    <form class="myform">
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
                            <input type="TEXT" class="form-control" id="exampleInputPassword1" placeholder="">
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

        <div class="row sayHello m-0 p-0 ">
            <div class="col-12 m-0 p-0 ">
                <div class="footer-top"></div>
                <div class="footer1"><h3> © VideoHomes.com LLC 2020 </h3></div>
            </div>
        </div>


    </div>

    @endsection;
