@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">Users</div>
                    <div class="card-body">
                        {{--                        <a href="{{ url('/admin/users/create') }}" class="btn btn-success btn-sm" title="Add New User">--}}
                        {{--                            <i class="fa fa-plus" aria-hidden="true"></i> Add New--}}
                        {{--                        </a>--}}

                        <form method="GET" action="{{ url('/admin/users') }}" accept-charset="UTF-8"
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
                                    <th>Name</th>
                                    <th>UserName</th>
                                    <th>Email</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td><img src="{{asset(is_null($item->avatar)?'images/blank.png':$item->avatar)}}" class="w-25 rounded-circle" alt=""></td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->username }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>
                                            <form method="POST" id="status"
                                                  action="{{ url('/admin/users/' . $item->id) }}" accept-charset="UTF-8"
                                                  class="form-horizontal d-inline" enctype="multipart/form-data">
                                                {{ method_field('PATCH') }}
                                                {{ csrf_field() }}
                                                <div class="btn-group btn-group-toggle" data-toggle="buttons">

                                                    <label
                                                        class="btn btn-sm btn-{{ (isset($item) && 1 == $item->active) ? 'info' : 'secondary' }}"><input
                                                            onchange="document.getElementById('status').submit();"
                                                            name="active" type="radio"
                                                            value="1" {{ (isset($item) && 1 == $item->active) ? 'checked' : '' }}>
                                                        Active</label>
                                                    <label
                                                        class="btn btn-sm btn-{{ (isset($item) && 0 == $item->active) ? 'info' : 'secondary' }}"><input
                                                            onchange="document.getElementById('status').submit();"
                                                            name="active" type="radio"
                                                            value="0" @if (isset($item)) {{ (0 == $item->active) ? 'checked' : '' }} @else {{ 'checked' }} @endif>
                                                        Inactive</label>
                                                </div>
                                            </form>

                                            <form method="POST" action="{{ url('/admin/users' . '/' . $item->id) }}"
                                                  accept-charset="UTF-8" class="d-inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete User"
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
                                class="pagination-wrapper"> {!! $users->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
