@extends('layouts.app')
@section('container')
    @if(auth()->user())
{{--        <div class="container-fluid">--}}
{{--            <div class="row bg-light">--}}

{{--                @include('layouts.header')--}}

{{--            </div>--}}
{{--        </div>--}}
        <div id="container"></div>
    @endif
@endsection
