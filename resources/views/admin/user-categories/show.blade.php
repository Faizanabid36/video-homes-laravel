@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="row">


            <div class="col">
                <div class="card">
                    <div class="card-header">UserCategory {{ $usercategory->id }}</div>

                    <div class="card-body">

                        <a href="{{ url('/admin/user-categories') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/admin/user-categories/' . $usercategory->id . '/edit') }}" title="Edit UserCategory"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('admin/usercategories' . '/' . $usercategory->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete UserCategory" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $usercategory->id }}</td>
                                    </tr>
                                    <tr><th> Name </th><td> {{ $usercategory->name }} </td></tr><tr><th> Description </th><td> {{ $usercategory->description }} </td></tr><tr><th> Parent Id </th><td> {{ $usercategory->parent->name??'' }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
