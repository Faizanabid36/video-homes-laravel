@extends('admin.layouts.app')
@section('content')
    <header class="head">
        <div class="main-bar">
            <div class="row no-gutters">
                <div class="col-lg-6 col-md-4 col-sm-4">
                    <h4 class="nav_top_align skin_txt">
                        <i class="fa fa-th"></i>
                        List of Reported Messages
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
                    <div class="bg-white">
                        Reported Messages
                    </div>
                    <div class="">
                        <div class="table-responsive m-t-35">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Message</th>
                                    <th>Reported User</th>
                                    <th>Receiving Time</th>
                                    <th>Mark as Resolved</th>
                                    <th>Delete Query</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($queries as $query)
                                    <tr
                                        @if($query->is_resolved!=0)
                                            style="background-color: #00cc99 !important"
                                        @else
                                            style="background-color: #ffc966 !important"
                                        @endif
                                    >
                                        <td>{{ucfirst($query->name)}}</td>
                                        <td>{{ucfirst($query->email)}}</td>
                                        <td>{{ucfirst($query->message_body)}}</td>
                                        <td>{{ucfirst($query->reported_on_user)}}</td>
                                        <td>{{$query->created_at->diffForHumans()}}</td>
                                        <td>
                                            <form action="{{route('report_query.update',$query->id)}}" method="POST">
                                                <a href="{{route('report_query.update',$query->id)}}">
                                                    @csrf
                                                    <input type="hidden" name="type" value="message">
                                                    <input type="hidden" name="_method" value="PUT">
                                                    @if($query->is_resolved!=0)
                                                        <button class="btn btn-primary" disabled>
                                                            Resolved
                                                        </button>
                                                    @else
                                                        <button class="btn  btn-primary">
                                                            Mark as Resolved
                                                        </button>
                                                    @endif
                                                </a>
                                            </form>
                                        </td>
                                        <td>
                                            <form action="{{route('report_query.destroy',$query->id)}}" method="POST">
                                                @csrf
                                                <input type="hidden" name="_method" value="DELETE">
                                                <a href="{{route('report_query.destroy',$query->id)}}">
                                                    <button class="btn btn-danger">
                                                        Delete Query
                                                    </button>
                                                </a>
                                            </form>
                                        </td>

                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{$queries->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
