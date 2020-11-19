@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="row">


            <div class="col">
                <div class="card">
                    <div class="card-header">User Messages</div>
                    <div class="card-body">
                        {{--                        <a href="{{ url('/admin/user-message/create') }}" class="btn btn-success btn-sm" title="Add New UserCategory">--}}
                        {{--                            <i class="fa fa-plus" aria-hidden="true"></i> Add New--}}
                        {{--                        </a>--}}

                        <form method="GET" action="{{ url('/admin/user-message') }}" accept-charset="UTF-8"
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
                                    <th>Messages</th>
                                    <th>Type</th>
                                    <th>Video</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($usermessages as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->message }}</td>
                                        <td>{{ $item->type=='contact'?'Message':ucfirst($item->type) }}</td>
                                        <td>
                                            @if($item->type!='contact')
                                                <a href="{{route('directory_by_username',[$item->video->user->username,$item->video->video_id])}}">
                                                    {{ $item->video->title }}
                                                </a>
                                            @endif
                                        </td>

                                        <td>
                                            {{--                                            <a href="{{ url('/admin/user-message/' . $item->id) }}"--}}
                                            {{--                                               title="View UserCategory">--}}
                                            {{--                                                <button class="btn btn-info btn-sm"><i class="fa fa-eye"--}}
                                            {{--                                                                                       aria-hidden="true"></i> View--}}
                                            {{--                                                </button>--}}
                                            {{--                                            </a>--}}
{{--                                            <a--}}
{{--                                                href="{{route('user-message.edit',$item->id)}}"--}}
{{--                                                --}}{{--                                                href="{{ url('/admin/user-message/' . $item->id . '/edit') }}"--}}
{{--                                                title="Edit Message/Review">--}}
{{--                                                <button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o"--}}
{{--                                                                                          aria-hidden="true"></i> Edit--}}
{{--                                                </button>--}}
{{--                                            </a>--}}

                                            <form method="POST"
                                                  action="{{ url('/admin/user-message' . '/' . $item->id) }}"
                                                  accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                        title="Delete UserCategory"
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
                                class="pagination-wrapper"> {!! $usermessages->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
