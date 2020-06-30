@extends('layouts.public.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-8 pull-2 mx-auto mt-5">
                {!! $page->content !!}
            </div>
        </div>
    </div>
@endsection
