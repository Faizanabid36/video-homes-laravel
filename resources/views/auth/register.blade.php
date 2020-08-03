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
                        <input class="form-control" type="text" name="name" id="name" placeholder="Name" required
                               value="{{old('name')}}" />
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="text" name="email" id="email" placeholder="E-mail address"
                               required
                               value="{{old('email')}}" />
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="password" name="password" id="password" placeholder="Password"
                               required />
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="password" name="password_confirmation" id="cpassword"
                               placeholder="Confirm Password"
                               required />
                    </div>

                    @if (count($user_category) > 0)
                        <div class="form-group">
                            <select name="category_id" class="selectpicker show-tick form-control"
                                    data-style="btn-primary bg-light text-dark"
                                    data-live-search="true"
                                    title="Choose one of the following Profession and Expertise...">
                                @foreach($user_category as $u)
                                    <optgroup label="{{$u['name']}}">
                                        @if(!empty($u['children'] ))
                                            @foreach($u['children'] as $k => $u1)
                                                @if (!empty($u1['children']))
                                                    @foreach($u1['children'] as $k => $u2)
                                                        <option value="{{$u2['id']}}" data-subtext="{{$u1['name']}}">{{$u2['name']}}</option>
                                                    @endforeach
                                                @else
                                                    <option value="{{$u1['id']}}">{{$u1['name']}}</option>
                                                @endif
                                            @endforeach
                                        @else
                                            <option value="{{$u['id']}}">{{$u['name']}}</option>
                                        @endif
                                    </optgroup>
                                @endforeach
                            </select>
                        </div>
                    @endif

                    <div class="form-group">
                        <label class="form-check-label">
                            <input required type="checkbox" class="form-check-input" name="accept_terms"
                                   id="accept_terms"
                            >
                            By creating your account, you agree to our
                            <a style=" text-decoration: underline;" href="#">Terms of use</a> &amp; <a
                                href="#" style="text-decoration: underline;">Privacy Policy</a>
                        </label>
                    </div>
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
        (function () {
            $('.selectpicker').selectpicker();
        })();
    </script>
@endsection

