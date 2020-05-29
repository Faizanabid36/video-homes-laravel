@extends('layouts.oldApp')
@section('container')
    <div id="main-container" class="welcome-page main-content">
        <div id="container_content">
            <div class="container login-page">
                <form action="{{route('login')}}" method="POST">
                    @csrf
                    <div class="login-form">
                        <h4>Welcome back!</h4>
                        <form action="" method="POST">
                                @if($errors->any())
                                <div class="errors form-group">{{$errors->first()}}</div>
                                @endif
                            <div class="form-group">
                                <input type="text" name="email" id="username" placeholder="Email" required="" value="">
                            </div>
                            <div class="form-group">
                                <input type="password" name="password" id="password" placeholder="Password" required="">
                            </div>
                            <div class="new-here pull-left">
                                <a href="#">Forgot your password?</a>
                            </div>
                            <div class="pull-right login-icons">
                            </div>
                            <div class="clear"></div>
                            <div class="form-group">
                                <input type="submit" class="button" value="Log In">
                            </div>
                            <div class="new-here text-center">
                                New here? <a class="dec" href="{{route('register')}}">Sign Up!</a>
                            </div>
                        </form>
                    </div>
                </form>
            </div>
            <ul class="bg-bubbles">
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
            </ul>

        </div>
    </div>
    <style>
        .bg-bubbles {
            background: -webkit-linear-gradient(top left, #0095D8 0%, #87ddff 100%);
            background: linear-gradient(to bottom right, #0095D8 0%, #87ddff 100%);
        }
        .login-form input[type=submit] {
            color: #0095D8 !important;
        }
        ::-webkit-input-placeholder { /* WebKit, Blink, Edge */
            color:    #fff;
        }
        :-moz-placeholder { /* Mozilla Firefox 4 to 18 */
            color:    #fff;
            opacity:  1;
        }
        ::-moz-placeholder { /* Mozilla Firefox 19+ */
            color:    #fff;
            opacity:  1;
        }
        :-ms-input-placeholder { /* Internet Explorer 10-11 */
            color:    #fff;
        }
        ::-ms-input-placeholder { /* Microsoft Edge */
            color:    #fff;
        }
    </style>
@endsection
