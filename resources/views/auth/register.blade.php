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
                        <input class="form-control" type="password" name="password" id="password" placeholder="Password"
                               required="">
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="password" name="password_confirmation" id=""
                               placeholder="Confirm Password"
                               required="">
                    </div>
                    <div class="form-group">
                        <select class="form-control" name="gender" id="gender" required="">
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <select onchange="changeVisibility(this)" class="form-control" name="role" id="role"
                                required="">
                            <option selected disabled>Selected Role</option>
                            @foreach($roles as $role)
                                <option value="{{$role->id}}">{{$role->role}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div id="tags" class="form-group">

                    </div>
                    <div id="parent" class="form-group">
                    </div>

                    <div id="child" class="form-group">
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
    function changeVisibility(e) {
        var select = document.createElement("select");
        select.name = "account_type";
        select.id = 'parent_selector';
        select.classList.add('form-control')
        let selector = document.getElementById('parent')
        selector.innerHTML = ''
        let el = document.getElementById('child')
        el.innerHTML = ''
        let values = [];
        let valu = [];
        @foreach($roles_assoc as $key=>$val)
        if (e.value == {{$key}}) {
            @foreach($val as $v)
            values.push('{{$v->name}}')
            valu.push('{{$v->id}}')
            @endforeach
        }
            @endforeach
        for (let i = 0; i < values.length; i++) {
            var option = document.createElement("option");
            option.value = valu[i];
            option.text = values[i].charAt(0).toUpperCase() + values[i].slice(1);
            select.appendChild(option);
        }
        document.getElementById("parent").appendChild(select);
    }
</script>

@section('script')
    <script type="text/javascript">
        $(document).on('click', '#parent_selector', function () {
            let e = document.getElementById('parent_selector')
            var select = document.createElement("select");
            select.name = "child_category_type";
            select.classList.add('form-control')
            let selector = document.getElementById('child')
            selector.innerHTML = ''
            let values = [];
            let valu = [];
            @foreach($user_child_category as $key=>$val)
            if (e.value == {{$key}}) {
                @foreach($val as $v)
                values.push('{{$v->name}}')
                valu.push('{{$v->id}}')
                @endforeach
            }@endforeach
            for (let i = 0; i < values.length; i++) {
                var option = document.createElement("option");
                option.value = valu[i];
                option.text = values[i].charAt(0).toUpperCase() + values[i].slice(1);
                select.appendChild(option);
            }
            document.getElementById("child").appendChild(select);
        });
    </script>
@endsection

