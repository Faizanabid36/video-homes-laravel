<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{env('APP_NAME')}}</title>

    <link href="{{asset('css/public.css')}}" rel="stylesheet">
    @yield('style')
    <script>
        window.VIDEO_APP = {
            base_url: '{{url('/')}}',
        }
    </script>
</head>
<body>
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
    @yield('content')
    <div class="row sayHello m-0 p-0 ">
        <div class="col-12 m-0 p-0 ">
            <div class="footer-top"></div>
            <div class="footer1"><h3> © VideoHomes.com LLC 2020 </h3></div>
        </div>
    </div>


</div>
@yield('script')
{{--<script src="{{ asset('js/app.js') }}"></script>--}}
</body>
</html>
