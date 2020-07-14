@extends('layouts.public.app')
@section('style')
    <style>
        .dropdown-submenu {
            position: relative;
        }

        .dropdown-submenu>a:after {
            content: "\f0da";
            float: right;
            border: none;
            font-family: 'FontAwesome';
        }

        .dropdown-submenu>.dropdown-menu {
            top: 0;
            left: 100%;
            margin-top: 0;
            margin-left: 0;
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
                               required>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="password" name="password_confirmation" id="cpassword"
                               placeholder="Confirm Password"
                               required>
                    </div>
                    @if (count($user_category) > 0)
                        <div class="dropdown">
                            <a id="category_instance" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn btn-primary dropdown-toggle">Dropdown</a>
                            @foreach($user_category as $u)
                                <ul aria-labelledby="category_instance" class="dropdown-menu border-0 shadow">
                                    <h3>Industry</h3>
                                    @if (empty($u['childNodes']))
                                        <li><a href="#" tabindex="-1" class="dropdown-item">{{$u['name']}}</a></li>
                                    @else
                                        @include('partial.category_partial', ['user_category'=>$u['childNodes'],"write"=>"Profession"])
                                    @endif
                                </ul>
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
    <script>
        $(document).ready(function () {
            // $('.dropdown-submenu a.test').on("click", function (e) {
            //     $(this).next('ul').toggle();
            //     e.stopPropagation();
            //     e.preventDefault();
            // });
            $("ul.dropdown-menu [data-toggle='dropdown']").on("click", function(event) {
                event.preventDefault();
                event.stopPropagation();

                $(this).siblings().toggleClass("show");


                if (!$(this).next().hasClass('show')) {
                    // $(this).parents('.dropdown-menu').first().toggleClass('show');
                    $(this).parents('.dropdown-menu').first().find('.show').removeClass("show");
                }
                $(this).parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function(e) {
                    $('.dropdown-submenu .show').removeClass("show");
                });

            });
        });
    </script>
@endsection

