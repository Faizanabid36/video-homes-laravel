@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">Edit User #{{ $user->id }}</div>
                    <div class="card-body">
                        <a href="{{ url('/admin/users') }}" title="Back">
                            <button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i>
                                Back
                            </button>
                        </a>
                        <br/>
                        <br/>
                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                        <form method="POST" action="{{ route('admin.reset_password.store' , $user->id) }}" accept-charset="UTF-8"
                              class="form-horizontal" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group {{ $errors->has('password') ? 'has-error' : ''}}">
                                <label for="password" class="control-label">
                                    {{ 'Password' }}
                                </label>
                                <br>
                                <input required name="password" id="password" type="text">
                            </div>
                            <div class="form-group {{ $errors->has('confirm_password') ? 'has-error' : ''}}">
                                <label for="confirm_password" class="control-label">
                                    {{ 'Confirm Password' }}
                                </label>
                                <br>
                                <input required name="confirm_password" id="confirm_password" type="password">
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">
                                    Reset
                                </button>
                            </div>
                        </form>
                        <button class="btn btn-secondary" onclick="generate_password()">
                            Generate Password
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function generate_password() {
            let r = Math.random().toString(36).substring(2);
            document.getElementById('password').value = r;
            document.getElementById('confirm_password').value = r;
        }
    </script>
@endsection
