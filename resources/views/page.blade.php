@extends('layouts.public.app',$page)
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 mx-auto mt-5">
                {!! $page->content !!}
            </div>
        </div>
    </div>
@endsection
@section('meta')

@endsection
