@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="row">


            <div class="col">
                <div class="card">
                    <div class="card-header">Videos</div>
                    <div class="card-body">
                        {{--                        <a href="{{ url('/admin/videos/create') }}" class="btn btn-success btn-sm" title="Add New Video">--}}
                        {{--                            <i class="fa fa-plus" aria-hidden="true"></i> Add New--}}
                        {{--                        </a>--}}

                        <form method="GET" action="{{ url('/admin/videos') }}" accept-charset="UTF-8"
                              class="form-inline my-2 my-lg-0 float-right" role="search">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" placeholder="Search..."
                                       value="{{ request('search') }}">
                                <span class="input-group-append">
                                    <button class="btn btn-secondary" type="submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                        </form>

                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Thumbnail</th>
                                    <th>Title</th>
                                    <th>User</th>
                                    <th>Profile Picture</th>
                                    <th>Description</th>
                                    <th>Video Type</th>
                                    <th>Duration</th>
                                    <th>Size</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($videos as $video)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td width="30px"><img class="w-100 rounded"
                                                              src="{{asset('/storage/'.$video->thumbnail)}}" alt="">
                                        </td>
                                        <td>{{$video->title}}</td>
                                        <td>{{$video->user->name}}</td>
                                        <td><img class="w-100 rounded"
                                                 src="{{$video->user->user_extra->profile_picture}}" alt=""></td>
                                        <td>{{$video->description}}</td>
                                        <td>{{$video->video_type}}</td>
                                        <td>{{gmdate("i:s", $video->duration)}}</td>
                                        <td>{{round((($video->size)/1024)/1024,2)}} MB</td>
                                        @if($video->is_video_approved==1)
                                            <td>Approved</td>
                                        @elseif($video->is_video_approved==2)
                                            <td>Rejected</td>
                                        @else
                                            <td>Pending</td>
                                        @endif
                                        <td>
                                            <a href="{{ url('/admin/videos/' . $video->id) }}" title="View Video">
                                                <button class="btn btn-info btn-sm"><i class="fa fa-eye"
                                                                                       aria-hidden="true"></i> Action
                                                </button>
                                            </a>
                                            {{--                                            <a href="{{ url('/admin/videos/' . $video->id . '/edit') }}" title="Edit Video"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>--}}

                                            <form method="POST" action="{{ url('/admin/videos' . '/' . $video->id) }}"
                                                  accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete Video"
                                                        onclick="return confirm(&quot;Confirm delete?&quot;)"><i
                                                        class="fa fa-trash-o" aria-hidden="true"></i> Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div
                                class="pagination-wrapper"> {!! $videos->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
