@extends('layouts.public.app')

@section('content')
    <div class="container login-page">
        <div class="row">
            <div class="col-8 pull-2 mx-auto mt-5 text-center">
                <h4>Let's get started!</h4>
                <form action="{{route('register')}}" method="POST">
                    @csrf
                    @if($errors->any())
                        <div class="alert alert-warning" role="alert">
                            <strong>Error</strong> {{$errors->first()}}
                        </div>
                    @endif
                    <div class="errors success form-group"></div>
                    <div class="form-group">
                        <input class="form-control" type="text" name="name" id="name" placeholder="Name" required value="{{old('name')}}">
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="text" name="username" id="username" placeholder="Username" required
                               value="{{old('username')}}">
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="text" name="email" id="email" placeholder="E-mail address" required
                               value="{{old('email')}}">
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="password" name="password" id="password" placeholder="Password" required="">
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="password" name="password_confirmation" id="" placeholder="Confirm Password"
                               required="">
                    </div>
                    <div class="form-group">
                        <select class="form-control" name="gender" id="gender" required="">
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                    </div>
                    <div onchange="changeVisibility()" class="form-group">
                        <select class="form-control" name="role" id="role" required="">
                            <option value="3">Video Provider</option>
                            <option value="2">Realtor</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="account_type"> Select Tags  </label>
                        <select  name="account_type[]" id="account_type" class="  form-control custom-select selectpicker " multiple   >
                            @foreach($user_tags ?? '' as $user_tag)
                                <option  value="{{$user_tag->id}}">{{$user_tag->tag_name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="terms">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" name="accept_terms" id=""
                            >
                            By creating your account, you agree to our
                            <a style=" text-decoration: underline;" href="#">Terms of use</a> &amp; <a
                                href="#" style="text-decoration: underline;">Privacy Policy</a>
                        </label>
                    </div>

                    <div class="recaptcha"></div>
                    <div class="form-group">
                        <button class="btn btn-primary btn-block"  type="submit">Sign Up!</button>
                    </div>
                    <div class="new-here text-center">
                        Already have an account? <a class="dec" href="{{route('login')}}">Log In</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

    <script type="text/javascript">
        function changeVisibility() {
            let role = document.getElementById('role');
            if(role.value!=3)
            console.log('hide')
                document.getElementById('account_type').classList.add('hide');
            else
                document.getElementById('account_type').style.visibility='visible';
        }

        // $('select').selectpicker();
    </script>


