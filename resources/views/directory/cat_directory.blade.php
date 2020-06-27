@extends('layouts.public.app')
@section('style')
    <style>
        /* Set the size of the div element that contains the map */
        #map {
            height: 400px; /* The height is 400 pixels */
            width: 100%; /* The width is the width of the web page */
        }
    </style>
@endsection
@section('content')

    <div class="bigContainer">

        <div class="row ">

        </div>
        <!-- 2nd row -->
        <div class="row">
            <div class="col-12 my-2 p-0 ">
                <div class="Search-boxes">
                    <form action="{{route('search_in_directory')}}" method="POST">
                        @csrf
                        <div class="form-row">
                            <div class="col my-2">
                                <input required name="query" type="text" class="form-control"
                                       placeholder="Search With Username, Email, Address or Phone"/>
                                {{--                                <i class="fal fa-search icon search-icon"></i>--}}
                                <br/>
                                <p> Try to search: <b> videographers, local marketing </b></p>
                            </div>
                            <div class="col my-2">
                                <select name="industry" class="form-control text" id="">
                                    <option value="" selected disabled>Choose Industry</option>
                                    @foreach($industries as $industry)
                                        <option value="{{$industry->id}}">{{$industry->role}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <input type="submit" value="Search" class="btn btn-primary float-right"/>
                        </div>
                    </form>
                </div>
            </div>

        </div>

        <!-- 3rd row -->
        @if(isset($count_users)&&$count_users>0)
        <div class="row Category-Boxes ">
            @if(isset($directory) && $directory)
                @foreach($tags as $tag)
                    <div class="col-6"><span> <a
                                href="{{route('ex_directory_by_category',preg_replace('/\W|\_+/m', '-', $tag->role))}}"> {{ucfirst($tag->role)}}</a></span>
                        <span
                            class="float-right">{{$tag->account_types_count}}</span>
                        <hr/>
                    </div>
                @endforeach
            @else
                @foreach($tags as $tag)
                    @if(!isset($role_cat))
                        <div class="col-6">
                        <span>
                            <a href="{{route('directory_by_sub_category',[$role_slug,preg_replace('/\W|\_+/m', '-', $tag->name)])}}"> {{ucfirst($tag->name)}}
                            </a>
                        </span>
                            <span
                                class="float-right">{{$tag->sub_roles_count}}</span>
                            <hr/>
                        </div>
                    @else
                        <div class="col-6">
                        <span>
                            @if(!isset($role_cat))
                                <a href="{{route('directory_by_sub_category',[$role_slug,preg_replace('/\W|\_+/m', '-', $tag['name'])])}}"> {{ucfirst($tag['name'])}}
                                </a>
                            @else
                                <a href="{{route('directory_by_sub_category_role',[$role_slug,$sub_role_slug,preg_replace('/\W|\_+/m', '-', $tag['name'])])}}"> {{ucfirst($tag['name'])}}
                                </a>
                            @endif
                        </span>
                            <span
                                class="float-right">{{$tag['sub_roles_count']}}</span>
                            <hr/>
                        </div>
                    @endif
                @endforeach
            @endif
        </div>
        <div id="map">
        </div>

        <div class="row">
            <!--The div element for the map -->
            {{--            <div class="col-12 text-center border p-0 pt-3 ">--}}
            {{--                <iframe width="100%" height="450"--}}
            {{--                        src="https://maps.google.com/maps?width=100%&amp;height=600&amp;hl=en&amp;q=1%20Grafton%20Street%2C%20Dublin%2C%20Ireland+(My%20Business%20Name)&amp;ie=UTF8&amp;t=&amp;z=14&amp;iwloc=B&amp;output=embed"--}}
            {{--                        frameborder="0" scrolling="no" marginheight="0" marginwidth="0"><a--}}
            {{--                        href="https://www.maps.ie/draw-radius-circle-map/">Create radius map</a></iframe>--}}
            {{--                <br/>--}}
            {{--            </div>--}}
        </div>

        <div class="row">
            <div class="col-12 my-4 p-0">
                <div class="float-left">
                    <h6 class="my-3"> Found<span class="h-8"> {{count($users)}} </span>listings </h6>
                    <div class="dropdown">
                        <button class="btn btn-primary" type="button" id="dropdownMenuButton" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                            Sort By
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="#">Date</a>
                            <a class="dropdown-item" href="#"> New to Old</a>
                            <a class="dropdown-item" href="#">Alpahabet</a>
                        </div>
                    </div>
                </div>
                <div class="float-right" style="position: relative;top: 38px;">

                    <ul class="nav Custom-nav2 nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home"
                               role="tab"
                               aria-controls="pills-home" aria-selected="true"><i class="fas fa-list icon"></i></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile"
                               role="tab"
                               aria-controls="pills-profile" aria-selected="false"><i class="fas fa-th-large icon"></i></a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="col-12 p-0">
                <div class="tab-content Custom-Tab2" id="pills-tabContent">
                <span class="tab-pane fade show active  " id="pills-home" role="tabpanel"
                      aria-labelledby="pills-home-tab">
                    @foreach($users as $account_user)
                        <div class="card mx-auto" style="max-width: 1040px;">
                              <div class="row no-gutters">
                                <div class="col-md-4">
                                    @if(!is_null($account_user['company_logo']))
                                        <img
                                            src="{{$account_user['company_logo']}}"
                                            class="card-img"
                                            alt="...">
                                    @else
                                        <img
                                            src="{{asset('images/blank.png')}}"
                                            class="card-img"
                                            alt="...">
                                    @endif
                                </div>
                                <div class="col-md-8">
                                  <div class="card-body">
                                    <h2 class="card-title "> <a
                                            href="{{route('directory_by_username',$account_user['username'])}}"
                                            style="font-weight:900"> {{ucfirst($account_user['name'])}} </a>
                                    </h2>
                                    <br/>
                                    <p class="card-text my-2">{{ucfirst($account_user['bio'])}}</p>
                                    <p class="card-text my-2">
                                        <i class="fa icon-blue fa-map-marker mr-2"></i>
                                        <b> Address: </b>{{ucfirst($account_user['address'])}}
                                    </p>
                                      @if(isset($account_user['user_role']) && !is_null($account_user['user_role']))
                                          <button class="btn-tags"> {{ucfirst($account_user['user_role']['role'])}}
                                                  <span class="fa  fa-tag"></span>
                                          </button>
                                          {{--                                          @if()--}}
                                          {{--                                          @else--}}
                                          {{--                                          <button class="btn-tags"> {{ucfirst(str_replace('-',' ',$role_slug))}}--}}
                                          {{--                                                  <span class="fa  fa-tag"></span>--}}
                                          {{--                                          </button>--}}
                                          {{--                                          @endif--}}
                                          {{--                                          @if(isset($role_cat))--}}
                                          {{--                                              <button class="btn-tags"> {{ucfirst(str_replace('-',' ',$sub_role_slug))}}--}}
                                          {{--                                                  <span class="fa  fa-tag"></span>--}}
                                          {{--                                              </button>--}}
                                          {{--                                          @endif--}}
                                          {{--                                          @if(isset($sub_role_cat)&&isset($role_cat))--}}
                                          {{--                                              <button class="btn-tags"> {{ucfirst(str_replace('-',' ',$sub_cat_slug))}}--}}
                                          {{--                                                  <span class="fa  fa-tag"></span>--}}
                                          {{--                                              </button>--}}
                                          {{--                                          @endif--}}
                                      @endif
                                    <p class="card-text my-3">  <i
                                            class="fa icon-blue mr-2 fa-phone"></i>   <b>Phone:</b> {{$account_user['phone']}}</p>
                                  </div>
                                </div>
                              </div>
                            </div>
                    @endforeach

                </span>
                </div>
            </div>


        </div>
        @else
            <h1>No Result Found</h1>
        @endif

    </div>

    <script>
        const onRating = (id) => {
            console.log(document.documentElement.style);
            console.log(document.getElementById('rating-head').children);
            let ratingComponent = document.getElementById('rating-head').children;

            for (let i = 0; i < id; i++) {
                ratingComponent[i].style.setProperty('color', 'orange');
            }

            for (let i = id; i <= ratingComponent.length - 1; i++) {
                ratingComponent[i].style.setProperty('color', 'black');
            }
        }
    </script>
    <script>
        function initMap() {
            @foreach($users as $u)
            @if(!is_null($u->user_extra->location_latitude)||!is_null($u->user_extra->location_longitude))
                var uluru = {
                        lat: {{$u->user_extra->location_latitude}},
                        lng: {{$u->user_extra->location_longitude}}
                };
                @endif
                @endforeach
            var map = new google.maps.Map(
                document.getElementById('map'), {zoom: 11, center: uluru});
                @foreach($users as $u)

                @if(!is_null($u->user_extra->location_latitude)||!is_null($u->user_extra->location_longitude))
            var uluru = {
                    lat: {{$u->user_extra->location_latitude}},
                    lng: {{$u->user_extra->location_longitude}}
                };
            new google.maps.Marker({position: uluru, map: map});
            @endif
            @endforeach
        }
    </script>
    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAm4Wvmd2nIeaFQCdhAsxbiSXgBsibDolc&callback=initMap">
    </script>


@endsection;
