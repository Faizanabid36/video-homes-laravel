@extends('layouts.app')
@section('container')

    @if(!request('new'))
        <div class="container-fluid">
            <div class="row bg-light">

                @include('layouts.header')

            </div>
        </div>
        <div id="container"></div>
    @else
        <div id="container2"></div>
    @endif

@endsection
