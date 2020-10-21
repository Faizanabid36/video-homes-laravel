@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">Edit Video #{{ $video->id }}</div>
                    @if(Session::has('success'))
                        <span class="alert-success p-1 m-2">
                                {{Session::get('success')}}
                            </span>
                    @endif
                    <div class="card-body">
                        <a href="{{ url('/admin/videos') }}" title="Back">
                            <button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i>
                                Back
                            </button>
                        </a>
                        <br>
                        <br/>
                        <br/>
                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                        <form method="POST" action="{{ route('admin.update_my_video', $video->id) }}"
                              accept-charset="UTF-8"
                              class="form-horizontal" enctype="multipart/form-data">
                            {{--                            {{ method_field('POST') }}--}}
                            {{ csrf_field() }}
                            <div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
                                <label for="title" class="control-label">{{ 'Title' }}</label>
                                <input class="form-control" name="title" type="text" id="title"
                                       value="{{ isset($video->title) ? $video->title : ''}}" required>
                                {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
                            </div>
                            <div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
                                <label for="description" class="control-label">{{ 'Description' }}</label>
                                <textarea class="form-control" rows="5" name="description" type="textarea"
                                          id="description"
                                          required>{{ isset($video->description) ? $video->description : ''}}</textarea>
                                {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
                            </div>
                            <div class="form-group">
                                <input class="btn btn-primary" type="submit">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
