@extends('layouts.public.app')
@section('content')

    <div class="row">
        <div class="col-6">
            <div class="Search-boxes">
                <form action="{{route('directory')}}">
                    <div class="form-row">
                        <div class="col mt-2">
                            @if (count($video_categories) > 0)
                                <div class="form-group mb-2">
                                    <select name="category_id" required id="category_id" class="form-control text">
                                        <option selected disabled>Choose Category</option>
                                        @foreach($video_categories as $industry)
                                            <option value="{{$industry->id}}">{{$industry->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col my-2">
                            <button id="searchvideos" type="submit" class="btn btn-block btn-primary"><i
                                    class="fa fa-search text-white"></i> Search Videos
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-6">
            <div class="Search-boxes">
                <form action="{{route('directory')}}" method="GET" id="findapro">
                    <div class="form-row">
                        <div class="col my-2">
                            <select required id="industry" class="form-control text">
                                <option selected disabled>Choose Industry</option>
                                @foreach($industries as $industry)
                                    <option value="{{$industry->slug}}">{{$industry->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col my-2">
                            <button id="findaprobtn" type="button" class="btn btn-block btn-primary"><i
                                    class="fa fa-search text-white"></i> Find a Pro
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- 3rd row -->
    @if(!request('category_id'))
        @if(count($users)>0)
            <div class="row mt-3 px-1">
                @if(!empty($categories) )
                    @foreach(($level1 ? collect($categories)->first()['children'] : $industries) as $category)
                        <div class="col-6 my-0"><span> <a
                                    href="{{url()->current()."/".$category->slug}}"> {{ucfirst($category->name)}}</a></span>
                            <span
                                class="float-right">{{count(grabUsers($category,true))}}</span>
                            <hr/>
                        </div>
                    @endforeach
                @endif
            </div>
            <div class="row my-2">
                <div class="col-12">
                    <div id="map"></div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-12">
                    <div class="float-left">
                        <h6 class="my-3">Found<span class="h-8"> {{count($users)}} </span>listings </h6>
                        {{--                        <div class="dropdown">--}}
                        {{--                            <button class="btn btn-primary" type="button" id="dropdownMenuButton" data-toggle="dropdown"--}}
                        {{--                                    aria-haspopup="true" aria-expanded="false">--}}
                        {{--                                Sort By--}}
                        {{--                            </button>--}}
                        {{--                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">--}}
                        {{--                                <a class="dropdown-item" href="#">Date</a>--}}
                        {{--                                <a class="dropdown-item" href="#"> New to Old</a>--}}
                        {{--                                <a class="dropdown-item" href="#">Alpahabet</a>--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}
                    </div>
                    <div class="float-right">
                        <ul class="nav Custom-nav2 nav-pills mb-3" id="pills-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home"
                                   role="tab"
                                   aria-controls="pills-home" aria-selected="true"><i class="fa fa-list icon"></i></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile"
                                   role="tab"
                                   aria-controls="pills-profile" aria-selected="false"><i
                                        class="fa fa-th-large icon"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-12 my-2">
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                             aria-labelledby="pills-home-tab">
                            @foreach($users as $account_user)
                                <div class="card my-1">
                                    <div class="row">
                                        <div class="col-md-4  p-3 text-center">
                                            <img class="w-75"
                                                 src="{{$account_user['company_logo'] ?? asset('images/blank.png')}}"
                                                 alt="{{$account_user['company_name']}}">
                                            <p class="text-center">{{$account_user['company_name']}}</p>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="card-body">
                                                <h2 class="card-title ">
                                                    <a
                                                        href="{{route('directory_by_username',$account_user['username'])}}">
                                                        <img
                                                            src="{{$account_user['profile_picture'] ?? asset('images/blank.png')}}"
                                                            class="rounded-circle rounded"
                                                            style="width:50px;height:50px" alt="">
                                                        {{ucfirst($account_user['name'])}} </a>
                                                </h2>
                                                @if ($account_user['bio'] && $account_user['bio'] != '')
                                                    <p class="card-text my-2">{!! substr($account_user['bio'],0,150) !!}
                                                        @if (strlen($account_user['bio']) > 150)
                                                            ...
                                                        @endif</p>
                                                @endif
                                                @if ($account_user['address'] && $account_user['address'] != '')
                                                    <p class="card-text my-2">
                                                        <i class="fa icon-blue fa-map-marker mr-2"></i>
                                                        <b>Address: </b>{{ucfirst($account_user['address'])}}
                                                    </p>
                                                @endif
                                                @if ($account_user['direct_phone'] && $account_user['direct_phone'] != '')
                                                    <p class="card-text my-3"><i
                                                            class="fa icon-blue mr-2 fa-phone"></i>
                                                        <b>Phone:</b> <a
                                                            href="tel:{{$account_user['direct_phone']}}">{{$account_user['direct_phone']}}</a>
                                                    </p>
                                                @endif
                                                @if ($account_user['office_phone'] && $account_user['office_phone'] != '')
                                                    <p class="card-text my-3"><i
                                                            class="fa icon-blue mr-2 fa-phone"></i> <b>Phone
                                                            Office:</b> <a
                                                            href="tel:{{$account_user['office_phone']}}">{{$account_user['office_phone']}}</a>
                                                    </p>
                                                @endif

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="tab-pane fade" id="pills-profile" role="tabpanel"
                             aria-labelledby="pills-profile-tab">
                            @foreach($users as $k => $account_user)
                                @if($k % 2 === 0)
                                    <div class="row">
                                        @endif
                                        <div class="col-md-6 text-center">
                                            <div class="card">
                                                <div class="card-header">
                                                    <img class="w-100"
                                                         src="{{$account_user['company_logo'] ?? asset('images/blank.png')}}"
                                                         alt="{{$account_user['company_name']}}">
                                                    <p class="text-center">{{$account_user['company_name']}}</p>
                                                </div>
                                                <div class="card-body">
                                                    <h2 class="card-title ">
                                                        <a
                                                            href="{{route('directory_by_username',$account_user['username'])}}">
                                                            <img
                                                                src="{{$account_user['profile_picture'] ?? asset('images/blank.png')}}"
                                                                class="rounded-circle rounded"
                                                                style="width:50px;height:50px" alt="">
                                                            {{ucfirst($account_user['name'])}} </a>
                                                    </h2>
                                                    @if ($account_user['bio'] && $account_user['bio'] != '')
                                                        <p class="card-text my-2">{!! substr($account_user['bio'],0,150) !!}
                                                            @if (strlen($account_user['bio']) > 150)
                                                                ...
                                                            @endif</p>
                                                    @endif
                                                    @if ($account_user['address'] && $account_user['address'] != '')
                                                        <p class="card-text my-2">
                                                            <i class="fa icon-blue fa-map-marker mr-2"></i>
                                                            <b>Address: </b>{{ucfirst($account_user['address'])}}
                                                        </p>
                                                    @endif
                                                    @if ($account_user['direct_phone'] && $account_user['direct_phone'] != '')
                                                        <p class="card-text my-3"><i
                                                                class="fa icon-blue mr-2 fa-phone"></i>
                                                            <b>Phone:</b> <a
                                                                href="tel:{{$account_user['direct_phone']}}">{{$account_user['direct_phone']}}</a>
                                                        </p>
                                                    @endif
                                                    @if ($account_user['office_phone'] && $account_user['office_phone'] != '')
                                                        <p class="card-text my-3"><i
                                                                class="fa icon-blue mr-2 fa-phone"></i> <b>Phone
                                                                Office:</b> <a
                                                                href="tel:{{$account_user['office_phone']}}">{{$account_user['office_phone']}}</a>
                                                        </p>
                                                    @endif

                                                </div>
                                            </div>
                                        </div>
                                        @if ($k % 2 === 1)
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

        @else
            <h1>No Result Found</h1>
        @endif
    @else
        @if(count($videos->videos))
            <div class="row mt-3">
                <div class="col-12">
                    <div class="float-left">
                        <h6 class="my-3">Found<span class="h-8"> {{count($videos->videos)}} </span>videos </h6>
                        {{--                        <div class="dropdown">--}}
                        {{--                            <button class="btn btn-primary" type="button" id="dropdownMenuButton" data-toggle="dropdown"--}}
                        {{--                                    aria-haspopup="true" aria-expanded="false">--}}
                        {{--                                Sort By--}}
                        {{--                            </button>--}}
                        {{--                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">--}}
                        {{--                                <a class="dropdown-item" href="#">Date</a>--}}
                        {{--                                <a class="dropdown-item" href="#"> New to Old</a>--}}
                        {{--                                <a class="dropdown-item" href="#">Alpahabet</a>--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}
                    </div>
                    <div class="float-right">
                        <ul class="nav Custom-nav2 nav-pills mb-3" id="pills-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home"
                                   role="tab"
                                   aria-controls="pills-home" aria-selected="true"><i class="fa fa-list icon"></i></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile"
                                   role="tab"
                                   aria-controls="pills-profile" aria-selected="false"><i
                                        class="fa fa-th-large icon"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-12 my-2">
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                             aria-labelledby="pills-home-tab">
                            @foreach($videos->videos as $k => $video)
                                <div class="card my-1">
                                    <div class="row">
                                        <div class="col-md-4  p-3 text-center">
                                            <img class="w-75"
                                                 src="{{asset("storage/".$video['thumbnail'])}}"
                                                 alt="{{ucfirst($video['title'])}}">
{{--                                            <p class="text-center">{{$account_user['company_name']}}</p>--}}
                                        </div>
                                        <div class="col-md-8">
                                            <div class="card-body">
                                                <h2 class="card-title ">
                                                    <a
                                                        href="{{route('directory_by_username',[$video['user']['username'],$video['video_id']])}}">
                                                        {{--                                                            <img--}}
                                                        {{--                                                                src="{{$video['user']['user_extra']['profile_picture'] ?? asset('images/blank.png')}}"--}}
                                                        {{--                                                                class="rounded-circle rounded"--}}
                                                        {{--                                                                style="width:50px;height:50px" alt="">--}}
                                                        {{ucfirst($video['title'])}} </a>
                                                </h2>
                                                @if ($video['description'] && $video['description'] != '')
                                                    <p class="card-text my-2">{!! substr($video['description'],0,150) !!}
                                                        @if (strlen($video['description']) > 150)
                                                            ...
                                                        @endif</p>
                                                @endif
                                                @if ($video['user']['user_extra']['address'] && $video['user']['user_extra']['address'] != '')
                                                    <p class="card-text my-2">
                                                        <i class="fa icon-blue fa-map-marker mr-2"></i>
                                                        <b>Address: </b>{{ucfirst($video['user']['user_extra']['address'])}}
                                                    </p>
                                                @endif
                                                @if ($video['user']['user_extra']['direct_phoe'] && $video['user']['user_extra']['direct_phone'] != '')
                                                    <p class="card-text my-2"><i
                                                            class="fa icon-blue mr-2 fa-phone"></i>
                                                        <b>Phone:</b> <a
                                                            href="tel:{{$account_user['direct_phone']}}">{{$account_user['direct_phone']}}</a>
                                                    </p>
                                                @endif
                                                @if ($video['user']['user_extra']['office_phone'] && $video['user']['user_extra']['office_phone'] != '')
                                                    <p class="card-text my-2"><i
                                                            class="fa icon-blue mr-2 fa-phone"></i> <b>Office Phone:</b> <a
                                                            href="tel:{{$video['user']['user_extra']['office_phone']}}">{{$video['user']['user_extra']['office_phone']}}</a>
                                                    </p>
                                                @endif

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="tab-pane fade" id="pills-profile" role="tabpanel"
                             aria-labelledby="pills-profile-tab">
                            @foreach($videos->videos as $k => $video)
                                @if($k % 2 === 0)
                                    <div class="row">
                                        @endif
                                        <div class="col-md-6 text-center">
                                            <div class="card">
                                                <div class="card-header">
                                                    <img class="w-100"
                                                         src="{{asset("storage/".$video['thumbnail'])}}"
                                                         alt="{{ucfirst($video['title'])}}">
{{--                                                    <p class="text-center">{{$video['user']['user_extra']['company_name']}}</p>--}}
                                                </div>
                                                <div class="card-body">
                                                    <h2 class="card-title ">
                                                        <a
                                                            href="{{route('directory_by_username',[$video['user']['username'],$video['video_id']])}}">
{{--                                                            <img--}}
{{--                                                                src="{{$video['user']['user_extra']['profile_picture'] ?? asset('images/blank.png')}}"--}}
{{--                                                                class="rounded-circle rounded"--}}
{{--                                                                style="width:50px;height:50px" alt="">--}}
                                                            {{ucfirst($video['title'])}} </a>
                                                    </h2>
                                                    @if ($video['description'] && $video['description'] != '')
                                                        <p class="card-text my-2">{!! substr($video['description'],0,150) !!}
                                                            @if (strlen($video['description']) > 150)
                                                                ...
                                                            @endif</p>
                                                    @endif
                                                    @if ($video['user']['user_extra']['address'] && $video['user']['user_extra']['address'] != '')
                                                        <p class="card-text my-2">
                                                            <i class="fa icon-blue fa-map-marker mr-2"></i>
                                                            <b>Address: </b>{{ucfirst($video['user']['user_extra']['address'])}}
                                                        </p>
                                                    @endif
                                                    @if ($video['user']['user_extra']['direct_phoe'] && $video['user']['user_extra']['direct_phone'] != '')
                                                        <p class="card-text my-3"><i
                                                                class="fa icon-blue mr-2 fa-phone"></i>
                                                            <b>Phone:</b> <a
                                                                href="tel:{{$account_user['direct_phone']}}">{{$account_user['direct_phone']}}</a>
                                                        </p>
                                                    @endif
                                                    @if ($video['user']['user_extra']['office_phone'] && $video['user']['user_extra']['office_phone'] != '')
                                                        <p class="card-text my-3"><i
                                                                class="fa icon-blue mr-2 fa-phone"></i> <b>Office Phone:</b> <a
                                                                href="tel:{{$video['user']['user_extra']['office_phone']}}">{{$video['user']['user_extra']['office_phone']}}</a>
                                                        </p>
                                                    @endif

                                                </div>
                                            </div>
                                        </div>
                                        @if ($k % 2 === 1)
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @else
            <h1>No Result Found</h1>
        @endif
    @endif

    <script>
        // const onRating = (id) => {
        //     console.log(document.documentElement.style);
        //     console.log(document.getElementById('rating-head').children);
        //     let ratingComponent = document.getElementById('rating-head').children;
        //
        //     for (let i = 0; i < id; i++) {
        //         ratingComponent[i].style.setProperty('color', 'orange');
        //     }
        //
        //     for (let i = id; i <= ratingComponent.length - 1; i++) {
        //         ratingComponent[i].style.setProperty('color', 'black');
        //     }
        // }

        function initMap() {
                @if(!empty($users))
            let mapArea = document.getElementById('map'), i, map = new google.maps.Map(mapArea, {zoom: 11}),
                bounds = new google.maps.LatLngBounds(), infowindow = new google.maps.InfoWindow();
            mapArea.style.width = "100%";
            mapArea.style.height = "400px";
                @foreach($users as $k => $u)

            var marker = new google.maps.Marker({
                    position: new google.maps.LatLng("{{$u['location_latitude']}}", "{{$u['location_longitude']}}"),
                    map: map
                });
            bounds.extend(marker.position);
            i = {{$k}};
            google.maps.event.addListener(marker, 'click', (function (marker, i) {
                return function () {
                    infowindow.setContent("{{$u['name']}}");
                    infowindow.open(map, marker);
                }
            })(marker, i));

            @endforeach
            map.fitBounds(bounds);
            var listener = google.maps.event.addListener(map, "idle", function () {
                map.setZoom(6);
                google.maps.event.removeListener(listener);
            });
            @endif
        }
    </script>
    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAm4Wvmd2nIeaFQCdhAsxbiSXgBsibDolc&callback=initMap">
    </script>
@endsection
