@extends('admin.layouts.app')
@section('content')
    <header class="head">
        <div class="main-bar">
            <div class="row no-gutters">
                <div class="col-lg-6 col-md-4 col-sm-4">
                    <h4 class="nav_top_align skin_txt">
                        <i class="fa fa-th"></i>
                        List of Reported Videos
                    </h4>
                </div>
            </div>
        </div>
    </header>
    @if(Session::has('error'))
        <div class="alert alert-warning">{{(Session::get('error'))}}</div>
    @endif()
    @if(Session::has('success'))
        <div class="alert alert-success">{{(Session::get('success'))}}</div>
    @endif()
    <div class="outer">
        <div class="inner bg-light lter bg-container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="">
                        <div class="table-responsive m-t-35">
                            <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Message</th>
                                            <th>Reported Videos</th>
                                            <th>Receiving Time</th>
                                            <th>Mark as Resolved</th>
                                            <th>Delete Query</th>
                                        </tr>
                                    </thead>
                                <tbody>


                                @foreach ($reported_queries as $query)
                                    <tr
                                        @if($query->is_resolved==0)
                                        style="background-color: #ffc966 !important"
                                        @else
                                        style="background-color: #00cc99 !important"
                                        @endif
                                    >
                                        <td>{{ucfirst($query->user->name)}}</td>
                                        <td>{{ucfirst($query->user->email)}}</td>
                                        <td>{{ucfirst($query->message)}}</td>
                                        <td>{{ucfirst($query->video_id)}}</td>
                                        <td>{{$query->created_at->diffForHumans()}}</td>
                                        <td>
                                            <form action="{{route('user_messages.update',$query->id)}}"
                                                  method="POST">
                                                @csrf
                                                @method('put')
                                                @if($query->is_resolved!=0)
                                                    <button class="btn btn-primary" disabled>
                                                        Resolved
                                                    </button>
                                                @else
                                                    <input type="hidden" name="is_resolved" value="1">
                                                    <button type="submit" class="btn  btn-primary">
                                                        Mark as Resolved
                                                    </button>
                                                @endif
                                            </form>
                                        </td>
                                        <td>
                                            <form action="{{route('user_messages.destroy',$query->id)}}" method="POST">
                                                @csrf
                                                @method('delete')
                                                <input type="hidden" name="id" value="{{$query->id}}">
                                                <button type="submit" class="btn btn-danger">
                                                    Delete
                                                </button>

                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{$reported_queries->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
