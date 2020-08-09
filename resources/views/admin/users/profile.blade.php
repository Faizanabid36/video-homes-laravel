@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">Edit Admin Profile</div>
                    <div class="card-body">
                        <a href="{{ url('/admin/users') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />
                        <br />
                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                        @php
                            $user = auth()->user()
                        @endphp

                        <form method="POST" action="{{ url('/admin/users/' . $user->id) }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            {{ csrf_field() }}
                            <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                                <label for="name" class="control-label">{{ 'Name' }}</label>
                                <input class="form-control" name="name" type="text" id="name" value="{{ isset($user->name) ? $user->name : ''}}" required>
                                {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                            </div>
                            <div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
                                <label for="email" class="control-label">{{ 'Email' }}</label>
                                <input class="form-control" name="email" type="text" id="email" value="{{ isset($user->email) ? $user->email : ''}}" >
                                {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
                            </div>

                            <div class="form-group {{ $errors->has('password') ? 'has-error' : ''}}">
                                <label for="password" class="control-label">{{ 'Password' }}</label>
                                <input class="form-control" name="password" type="password" id="password" placeholder="Leave empty for not change." >
                                {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
                            </div>

                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" value="Update">
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
