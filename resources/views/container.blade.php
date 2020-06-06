@extends('layouts.app')
@if(auth()->user())
<div class="container-fluid">
    <div class="row bg-light">
        
            @include('layouts.header')
        
    </div>
</div>
@section('container')
    <div id="container"></div>
@endif   
@endsection
