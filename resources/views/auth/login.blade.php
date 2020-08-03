@extends('layouts.public.app',["title"=>"Login"])
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
                        <input class="form-control" type="text" name="email" id="username" placeholder="Email"
                               required="required" />
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="password" name="password" id="password" placeholder="Password"
                               required="required" />
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <input type="checkbox" name="remember"
                                   id="remember_me" {{ old('remember') ? 'checked' : '' }} />
                            <label class="form-check-label" for="remember_me">
                                {{ __('Remember Me') }}
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Log In</button>
                    </div>
                    <div class="form-group">
                        <a class="btn btn-link"
                           href="{{route('password.request')}}">{{ __('Forgot Your Password?') }}</a>
                    </div>

                    <div class="new-here text-center">
                        New here? <a class="dec" href="{{route('register')}}">Sign Up!</a>
                    </div>

                </form>
            </div>
        </div>
    </div>

@endsection
