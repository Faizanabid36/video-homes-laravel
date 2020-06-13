@extends('layouts.public.app')
@section('content')

<div class="bigContainer">

    <div class="row ">
        <div class="col-12 my-3 p-0 ">
            <button class="btn btn-primary"><i class="far fa-plus icon"></i> Submit new List</button>

            <button class="btn btn-primary"><i class="fas fa-star icon "></i> My bookmarks</button>
        </div>

    </div>
    <!-- 2nd row -->
    <div class="row">
        <div class="col-12 my-2 p-0 ">
            <div class="Search-boxes">
                <form>
                    <div class="form-row ">
                        <div class="col my-4">
                            <input type="text" class="form-control text" placeholder="Select Cateogy"/>
                            <i class="fal fa-search icon search-icon"></i>

                            <br/>
                            <p> Try to search: <b> videographers, local marketing </b></p>

                        </div>
                        <div class="col my-4">
                            <input type="text" class="form-control text" placeholder="Select Location"/>
                            <i class="fal fa-map-marker icon search-icon"></i>


                        </div>
                    </div>


                    <p> Search in radius 0 miles </p>
                    <input type="range" class="custom-range" id="customRange1">
                    <div class="col my-2">

                        <button class="btn btn-primary float-right my-2"> Search</button>
                    </div>
                </form>
            </div>
        </div>

    </div>

    <!-- 3rd row -->
    <div class="row Category-Boxes ">
        @foreach($tags as $tag)
            <div class="col-6"><span> <a href="{{route('directory_by_category',$tag->id)}}"> {{$tag->tag_name}}</a></span> <span
                    class="float-right">{{$tag->account_types_count}}</span>
                <hr/>
            </div>
        @endforeach

    </div>

    <div class="row">
        <!--The div element for the map -->
        <div class="col-12 text-center border p-0 pt-3 ">
            <iframe width="100%" height="450"
                    src="https://maps.google.com/maps?width=100%&amp;height=600&amp;hl=en&amp;q=1%20Grafton%20Street%2C%20Dublin%2C%20Ireland+(My%20Business%20Name)&amp;ie=UTF8&amp;t=&amp;z=14&amp;iwloc=B&amp;output=embed"
                    frameborder="0" scrolling="no" marginheight="0" marginwidth="0"><a
                    href="https://www.maps.ie/draw-radius-circle-map/">Create radius map</a></iframe>
            <br/>
        </div>
    </div>


    <div class="row">

        <div class="col-12 my-4 p-0">
            <div class="float-left">
                <h6 class="my-3"> Found<span class="h-8"> 8 </span>listings </h6>
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
                        <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab"
                           aria-controls="pills-home" aria-selected="true"><i class="fas fa-list icon"></i></a>
                    </li>
                    <li class="nav-item" >
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
                                    @if(!is_null($account_user->avatar))
                                        <img
                                            src="{{$account_user->avatar}}"
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
                                    @foreach($account_user->account_types as $account_type)
                                          @if(!is_null($account_type->user_tag))
                                              <button class="btn-tags"> {{$account_type->user_tag->tag_name}}
                                              <span class="fa  fa-tag"></span> </button>
                                          @endif
                                      @endforeach
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

                              @if(!is_null($account_user->avatar))
                                        <img
                                            src="{{$account_user->avatar}}"
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
                                    @foreach($account_user->account_types as $account_type)
                                          @if(!is_null($account_type->user_tag))
                                              <button class="btn-tags "> {{$account_type->user_tag->tag_name}}
                                              <span class="fa  fa-tag"></span> </button>
                                          @endif
                                      @endforeach
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


@endsection;
