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
                    {{--                    <div id="tags" class="form-group">--}}
                    {{--                        <select  name="account_type[]" id="account_type" class="  form-control custom-select selectpicker " multiple   >--}}
                    {{--                            @foreach($user_parent_category ?? '' as $user_tag)--}}
                    {{--                                <option  value="{{$user_tag->id}}">{{$user_tag->name}}</option>--}}
                    {{--                            @endforeach--}}
                    {{--                        </select>--}}
                    {{--                    </div>--}}
                    <div id="tags" class="form-group">
                        <select onchange="change_category_type(this)" name="account_type[]" id="account_type"
                                class="  form-control ">
                            <option value="" selected disabled>Select</option>
                            @foreach($user_parent_category ?? '' as $user_tag)
                                <option value="{{$user_tag->id}}">{{$user_tag->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div id="child">

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
    function change_category_type(e) {
        //
        var select = document.createElement("select");
        select.name = "child_category_type";
        select.class = 'form-control'
        let selector=document.getElementById('child')
        selector.innerHTML=''
        var values = [];
        @foreach($user_child_category as $key=>$val)
        if (e.value == {{$key}}) {
            @foreach($val as $v)
            values.push('{{$v->name}}')
            @endforeach
        }@endforeach

        for (const val of values) {
            var option = document.createElement("option");
            option.value = val;
            option.text = val.charAt(0).toUpperCase() + val.slice(1);
            select.appendChild(option);
        }
        document.getElementById("child").appendChild(select);
        console.log(e.value)
    }

    function changeVisibility() {
        let role = document.getElementById('role');
        console.log(role.value)
        if (role.value === '3') {

            console.log('display');
            document.getElementById('tags').style.removeProperty('display');
        } else {
            console.log('hide', document.getElementById('tags'))
            document.getElementById('tags').style.setProperty('display', 'none');
        }
    }

    // $('select').selectpicker();
</script>


