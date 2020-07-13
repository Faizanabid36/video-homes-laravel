@extends('layouts.public.app')
@section('style')
    <style>
        .dropdown-submenu {
            position: relative;
        }

        .dropdown-submenu .dropdown-menu {
            top: 0;
            left: 100%;
            margin-top: -1px;
        }
    </style>
@endsection
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
                        <input class="form-control" type="text" name="name" id="name" placeholder="Name" required
                               value="{{old('name')}}">
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="text" name="email" id="email" placeholder="E-mail address"
                               required
                               value="{{old('email')}}">
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="password" name="password" id="password" placeholder="Password"
                               required="">
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="password" name="password_confirmation" id="cpassword"
                               placeholder="Confirm Password"
                               required="">
                    </div>
                    {{--                    <div class="form-group">--}}
                    {{--                        <select onchange="changeVisibility(this)" class="form-control" name="role" id="role"--}}
                    {{--                                required="">--}}
                    {{--                            <option selected disabled>Choose My Industry</option>--}}
                    {{--                            @foreach($roles as $role)--}}
                    {{--                                <option value="{{$role->id}}">{{$role->role}}</option>--}}
                    {{--                            @endforeach--}}
                    {{--                        </select>--}}
                    {{--                    </div>--}}
                    {{--                    <div id="tags" class="form-group">--}}

                    {{--                    </div>--}}
                    {{--                    <div id="parent" class="form-group">--}}
                    {{--                    </div>--}}

                    {{--                    <div id="child" class="form-group">--}}
                    {{--                    </div>--}}
                    @if (count($user_category) > 0)
                        <div class="dropdown">
                            <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="category_instance">Industry</button>
                            @foreach($user_category as $u)
                                <div class="dropdown-menu" aria-labelledby="category_instance">
                                    <h3>Industry</h3>
                                    @if (empty($u['childNodes']))
                                        <li><a class="btn btn-link text-capitalize" tabindex="-1" href="#">{{$u['name']}}</a></li>
                                    @else
                                        @include('partial.category_partial', ['user_category'=>$u['childNodes'],"write"=>"Profession"])
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @endif
                    <div class="terms">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" name="accept_terms" id="accept_terms"
                            >
                            By creating your account, you agree to our
                            <a style=" text-decoration: underline;" href="#">Terms of use</a> &amp; <a
                                href="#" style="text-decoration: underline;">Privacy Policy</a>
                        </label>
                    </div>

                    <div class="recaptcha"></div>
                    <button class="btn btn-primary" type="submit">Sign Up!</button>
                    <div class="new-here text-center">
                        Already have an account? <a class="dec" href="{{route('login')}}">Sign in</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


@section('script')
    {{--    <script type="text/javascript">--}}
    {{--        function changeVisibility(e) {--}}
    {{--            var select = document.createElement("select");--}}
    {{--            select.name = "sub_role";--}}
    {{--            select.id = 'parent_selector';--}}
    {{--            select.classList.add('form-control')--}}
    {{--            let selector = document.getElementById('parent')--}}
    {{--            selector.innerHTML = ''--}}
    {{--            let el = document.getElementById('child')--}}
    {{--            el.innerHTML = ''--}}
    {{--            let values = [];--}}
    {{--            let valu = [];--}}
    {{--            @foreach($roles_assoc as $key=>$val)--}}
    {{--            if (e.value == {{$key}}) {--}}
    {{--                @foreach($val as $v)--}}
    {{--                values.push('{{$v->name}}')--}}
    {{--                valu.push('{{$v->id}}')--}}
    {{--                @endforeach--}}
    {{--            }--}}
    {{--            @endforeach--}}
    {{--            if (values.length != 0) {--}}
    {{--                var option = document.createElement("option");--}}
    {{--                option.value = "";--}}
    {{--                option.text = "Choose My Expertise"--}}
    {{--                option.selected;--}}
    {{--                option.disabled--}}
    {{--                select.appendChild(option);--}}
    {{--                for (let i = 0; i < values.length; i++) {--}}
    {{--                    var option = document.createElement("option");--}}
    {{--                    option.value = valu[i];--}}
    {{--                    option.text = values[i].charAt(0).toUpperCase() + values[i].slice(1);--}}
    {{--                    select.appendChild(option);--}}
    {{--                }--}}
    {{--                document.getElementById("parent").appendChild(select);--}}
    {{--            }--}}
    {{--        }--}}
    {{--    </script>--}}
    {{--    <script type="text/javascript">--}}
    {{--        $(document).on('click', '#parent_selector', function () {--}}
    {{--            let e = document.getElementById('parent_selector')--}}
    {{--            var select = document.createElement("select");--}}
    {{--            select.name = "sub_role_category";--}}
    {{--            select.classList.add('form-control')--}}
    {{--            let selector = document.getElementById('child')--}}
    {{--            selector.innerHTML = ''--}}
    {{--            let values = [];--}}
    {{--            let valu = [];--}}
    {{--            @foreach($user_child_category as $key=>$val)--}}
    {{--            if (e.value == {{$key}}) {--}}
    {{--                @foreach($val as $v)--}}
    {{--                values.push('{{$v->name}}')--}}
    {{--                valu.push('{{$v->id}}')--}}
    {{--                @endforeach--}}
    {{--            }--}}
    {{--            @endforeach--}}
    {{--            if (values.length != 0) {--}}
    {{--                var option = document.createElement("option");--}}
    {{--                option.value = "";--}}
    {{--                option.text = "Choose My Profession"--}}
    {{--                option.selected;--}}
    {{--                option.disabled--}}
    {{--                select.appendChild(option);--}}
    {{--                for (let i = 0; i < values.length; i++) {--}}
    {{--                    var option = document.createElement("option");--}}
    {{--                    option.value = valu[i];--}}
    {{--                    option.text = values[i].charAt(0).toUpperCase() + values[i].slice(1);--}}
    {{--                    select.appendChild(option);--}}
    {{--                }--}}
    {{--                document.getElementById("child").appendChild(select);--}}
    {{--            }--}}
    {{--        });--}}
    {{--    </script>--}}
    <script>
        $(document).ready(function () {
            $('.dropdown-submenu a.test').on("click", function (e) {
                $(this).next('ul').toggle();
                e.stopPropagation();
                e.preventDefault();
            });
        });

    </script>
@endsection

