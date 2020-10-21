@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="row">


            <div class="col">
                <div class="card">
                    <div class="card-header">Videos</div>
                    <div class="card-body">
                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Thumbnail</th>
                                    <th>Title</th>
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
                                        <td width="30px"><img class="w-100"
                                                              src="{{asset('/storage/'.$video->thumbnail)}}" alt="">
                                        </td>
                                        <td>{{$video->title}}</td>
                                        <td>{{$video->description}}</td>
                                        <td>{{$video->video_type}}</td>
                                        <td>{{gmdate("i:s", $video->duration)}}</td>
                                        <td>{{round((($video->size)/1024)/1024,2)}} MB</td>
                                        <td>{{$video->is_video_approved ? "Approved" : "Rejected"}} </td>
                                        <td>
                                            <a data-toggle="modal" class="modal-button-toggle"
                                               data-target="#embedCodeModal" title="View Video">
                                                <button id="{{route('admin_uploads.watch','v='.$video->video_id)}}"
                                                        class="btn btn-info btn-sm">
                                                    <i class="fa fa-eye" aria-hidden="true"></i> View Embed Code
                                                </button>
                                            </a>
                                            <a href="{{route('admin.my_video.edit',$video->id)}}">
                                                <button class="btn btn-info btn-sm">
                                                    <i class="fa fa-edit" aria-hidden="true"></i> Edit
                                                </button>
                                            </a>
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
                            <div class="modal fade" id="embedCodeModal" tabindex="-1" role="dialog"
                                 aria-labelledby="embedCodeModal" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Embed Code</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <input class="form-control" type="text" value="" id="value_embed_code">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="pagination-wrapper"> {!! $videos->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function () {
            $('.modal-button-toggle').on('click', function (event) {
                const id = event.target.id
                $('#value_embed_code').val(`${id}`);
            })
        });
    </script>
@endsection
