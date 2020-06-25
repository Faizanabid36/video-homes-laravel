@extends('layouts.public.app')
@section('style')
    <style>
        /* Always set the map height explicitly to define the size of the div
         * element that contains the map. */
        #map {
            height: 100%;
        }

        /* Optional: Makes the sample page fill the window. */
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        #description {
            font-family: Roboto;
            font-size: 15px;
            font-weight: 300;
        }

        #infowindow-content .title {
            font-weight: bold;
        }

        #infowindow-content {
            display: none;
        }

        #map #infowindow-content {
            display: inline;
        }

        .pac-card {
            margin: 10px 10px 0 0;
            border-radius: 2px 0 0 2px;
            box-sizing: border-box;
            -moz-box-sizing: border-box;
            outline: none;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
            background-color: #fff;
            font-family: Roboto;
        }

        .pac-controls {
            display: inline-block;
            padding: 5px 11px;
        }

        .pac-controls label {
            font-family: Roboto;
            font-size: 13px;
            font-weight: 300;
        }

        #pac-input:focus {
            border-color: #4d90fe;
        }

        #title {
            color: #fff;
            background-color: #4d90fe;
            font-size: 25px;
            font-weight: 500;
            padding: 6px 12px;
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
                    <div class="form-row ">
                        <div class="col my-4">
                            <input type="text" class="form-control text" placeholder="Select Cateogy"/>
                            <i class="fal fa-search icon search-icon"></i>

                            <br/>
                            <p> Try to search: <b> videographers, local marketing </b></p>

                        </div>
                        <div class="col my-4">
                            <input id="pac-input" class="form-control text" type="text"
                                   placeholder="Enter a location">
                            <i class="fal fa-search icon search-icon"></i>
                        </div>
                    </div>


                    <p> Search in radius 0 miles </p>
                    <input type="range" class="custom-range" id="customRange1">
                    <div class="col my-2">

                        <button class="btn btn-primary float-right my-2"> Search</button>
                    </div>
            </div>
        </div>

    </div>

    <!-- 3rd row -->
    <div class="row Category-Boxes ">
        @foreach($tags as $tag)
            <div class="col-6"><span> <a href="{{route('ex_directory_by_category',preg_replace('/\W|\_+/m', '-', $tag->role))}}"> {{ucfirst($tag->role)}}</a></span> <span
                    class="float-right">{{$tag->account_types_count}}</span>
                <hr/>
            </div>
        @endforeach

    </div>

        <!--The div element for the map -->
        <div id="map"></div>
        <div id="infowindow-content">
            <img src="" width="16" height="16" id="place-icon">
            <span id="place-name" class="title"></span><br>
            <span id="place-address"></span>
        </div>


        <div class="row">

            <div class="col-12 my-4 p-0">
                <div class="float-left">
                    <h6 class="my-3"> Found<span class="h-8"> {{count($account_types)}} </span>listings </h6>
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
                        <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab"
                           aria-controls="pills-profile" aria-selected="false"><i class="fas fa-th-large icon"></i></a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="col-12 p-0">
            <div class="tab-content Custom-Tab2" id="pills-tabContent">
                <span class="tab-pane fade show active  " id="pills-home" role="tabpanel"
                      aria-labelledby="pills-home-tab">
                    @foreach($account_types as $account_user)
                        <div class="card mx-auto" style="max-width: 1040px;">
                              <div class="row no-gutters">
                                <div class="col-md-4">
                                    @if(!is_null($account_user->company_logo))
                                        <img
                                            src="{{$account_user->company_logo}}"
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
                                    <h2 class="card-title "> <a href="{{route('directory_by_username',$account_user->username)}}"
                                                                style="font-weight:900"> {{$account_user->name}} </a>
                                    </h2>
                                    <br/>

                                    <p class="card-text my-2">{{$account_user->bio}}</p>
                                    <p class="card-text my-2"> <i class="fa icon-blue fa-map-marker mr-2"></i>  <b> Address: </b>{{$account_user->address}}</p>
                                          @if(!is_null($account_user->user_role))
                                              <button class="btn-tags"> {{$account_user->user_role->role}}
                                              <span class="fa  fa-tag"></span> </button>
                                          @endif
                                    <p class="card-text my-3">  <i class="fa icon-blue mr-2 fa-phone"></i>   <b>Phone:</b> {{$account_user->phone}}</p>
                                  </div>
                                </div>
                              </div>
                            </div>
                    @endforeach

                </span>

                <span class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                    <div class="row  ">
                  @foreach($account_types as $account_user)
                            <div class="col-md-6 col-sm-12 mb-3 ">
                        <div class="card " style="min-height:560px ; min-width:515px ; ">
                              <div class="row no-gutters">

                              @if(!is_null($account_user->company_logo))
                                        <img
                                            src="{{$account_user->company_logo}}"
                                            class="card-img"
                                            alt="...">
                                    @else
                                        <img
                                            src="{{asset('images/blank.png')}}"
                                            class="card-img"
                                            alt="...">
                                    @endif


                                  <div class="card-body">
                                    <h2 class="card-title my-3"> <a
                                            href="{{route('directory_by_username',$account_user->username)}}"
                                            style="font-weight:900"> {{$account_user->name}} </a>
                                    </h2>
                                    <p class="card-text my-3">{{$account_user->bio}}</p>
                                    <p class="card-text my-3"> <i class="fa icon-blue fa-map-marker mr-2"></i>  <b> Address: </b>{{$account_user->address}}</p>
                                          @if(!is_null($account_user->user_role))
                                              <button class="btn-tags "> {{$account_user->user_role->role}}
                                              <span class="fa  fa-tag"></span> </button>
                                          @endif
                                    <p class="card-text my-3">  <i
                                            class="fa icon-blue mr-2 fa-phone"></i>   <b>Phone:</b> {{$account_user->phone}}</p>
                                  </div>
                                </div>

                            </div>


                          </div>
                        @endforeach

</div>



                 </span>

            </div>
        </div>


        </div>

    </div>


@endsection;
