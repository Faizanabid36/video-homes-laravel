@extends('layouts.app')

@section('container')
    <div id="container_content">
        l
        <div class="container login-page">
            <div class="login-form">
                <h4>Let's get started!</h4>
                <form action="{{route('register')}}" method="POST">
                    @csrf
                    @if($errors->any())
                        <div class="errors form-group">{{$errors->first()}}</div>
                    @endif
                    <div class="errors success form-group"></div>
                    <div class="form-group">
                        <input type="text" name="name" id="name" placeholder="Name" required value="{{old('name')}}">
                    </div>
                    <div class="form-group">
                        <input type="text" name="username" id="username" placeholder="Username" required
                               value="{{old('username')}}">
                    </div>
                    <div class="form-group">
                        <input type="text" name="email" id="email" placeholder="E-mail address" required
                               value="{{old('email')}}">
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" id="password" placeholder="Password" required="">
                    </div>
                    <div class="form-group">
                        <input type="password" name="password_confirmation" id="" placeholder="Confirm Password"
                               required="">
                    </div>
                    <div class="form-group">
                        <select name="gender" id="gender" required="">
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                    </div>
                    <div onchange="changeVisibility()" class="form-group">
                        <select name="role" id="role" required="">
                            <option value="3">Video Provider</option>
                            <option value="2">Realtor</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <select name="account_type" id="account_type" required="">
                            <option value="designer">Designer</option>
                            <option value="photographer">Photographer</option>
                            <option value="instructor">Instructor</option>
                            <option value="trainer">Trainer</option>
                        </select>
                    </div>

                    <div class="terms" style="color: #fff">
                        <label for="accept_terms" style="font-size: 12px; cursor: pointer;"><input type="checkbox"
                                                                                                   style="float: left; width: auto; display: inline-block; margin-right: 5px; margin-top: 2px;"
                                                                                                   name="accept_terms"
                                                                                                   id="accept_terms">
                            By creating your account, you agree to our
                            <a style="color: #fff; text-decoration: underline;" href="#">Terms of use</a> &amp; <a
                                href="#" style="color: #fff; text-decoration: underline;">Privacy Policy</a>
                        </label>
                        <div class="clear"></div>
                    </div>

                    <div class="recaptcha"></div>
                    <div class="form-group">
                        <input type="submit" class="button" value="Sign Up!">
                    </div>
                    <div class="new-here text-center">
                        Already have an account? <a class="dec" href="{{route('login')}}">Log In</a>
                    </div>
                </form>
            </div>
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
        <script>
            $(function () {
                $('.button').on('click', function () {
                    if ($('#username').val() && $('#password').val() && $('#email').val() && $('#gender').val() && $('#c_password').val()) {
                        $(this).val("Please wait..");
                    }
                });
            });
        </script>
        <style>
            .bg-bubbles {
                background: -webkit-linear-gradient(top left, #2ec0bc 0%, #8ef9f6 100%);
                background: linear-gradient(to bottom right, #2ec0bc 0%, #8ef9f6 100%);
            }

            .login-page {
                margin-top: 150px;
            }

            .login-form input[type=submit] {
                color: #2ec0bc !important;
            }

            ::-webkit-input-placeholder { /* WebKit, Blink, Edge */
                color: #fff;
            }

            :-moz-placeholder { /* Mozilla Firefox 4 to 18 */
                color: #fff;
                opacity: 1;
            }

            ::-moz-placeholder { /* Mozilla Firefox 19+ */
                color: #fff;
                opacity: 1;
            }

            :-ms-input-placeholder { /* Internet Explorer 10-11 */
                color: #fff;
            }

            ::-ms-input-placeholder { /* Microsoft Edge */
                color: #fff;
            }
        </style>
    </div>
@endsection

@section('footer_script')
    <script type="text/javascript">
        function changeVisibility() {
            let role = document.getElementById('role');
            if(role.value!=3)
                document.getElementById('account_type').style.visibility='hidden';
            else
                document.getElementById('account_type').style.visibility='visible';
        }
    </script>
@endsection

