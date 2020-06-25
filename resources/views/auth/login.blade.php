@extends('layouts.public.app')
@section('content')
    <div class="container login-page">
        <div class="row">
            <div class="col-8 pull-2 mx-auto mt-5 text-center">
                <h4>Welcome back!</h4>
                <form action="{{route('login')}}" method="POST">
                    @csrf
                    @if($errors->any())
                        <div class="alert alert-warning" role="alert">
                            <strong>Error</strong> {{$errors->first()}}
                        </div>
                    @endif
                    <div class="form-group">
                        <input class="form-control" type="text" name="email" id="username" placeholder="Username" required="" value="">
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="password" name="password" id="password" placeholder="Password" required="">
                    </div>
                    <div class="new-here pull-left">
                        <a href="#">Forgot your password?</a>
                    </div>
                    <div class="pull-right login-icons">
                    </div>
                    <div class="clear"></div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Log In</button>
                    </div>
                    <div class="new-here text-center">
                        New here? <a class="dec" href="{{route('register')}}">Sign Up!</a>
                    </div>

                </form>
            </div>
        </div>
    </div>

@endsection
