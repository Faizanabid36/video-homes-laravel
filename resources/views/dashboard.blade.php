@extends('layouts.app')
@section('container')

    @if(request('old'))
        <div class="container-fluid">
            <div class="row bg-light">

                @include('layouts.header')

            </div>
        </div>
        <div id="container"></div>
    @elseif(request('check'))
        <div id="container3"></div>
    @else
        <div id="container2"></div>
    @endif

   

@endsection
