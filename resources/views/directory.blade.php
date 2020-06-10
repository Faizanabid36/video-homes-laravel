@extends('layouts.public.app')
@section('content')


<div class="bigContainer">
    
        <div class="row">  
           <div class="col-12 my-3 p-0"> 
               <button class="btn btn-primary"> <i class="far fa-plus icon"></i>Submit new List   </button>
           
                <button class="btn btn-primary"><i class="fas fa-star icon "></i>My bookmarks   </button>
           </div>

        </div>
        <!-- 2nd row -->
            <div class="row">
                    <div class="col-12 my-2 p-0"> 
                        <div class="Search-boxes">
                            <form>
                                            <div class="form-row ">
                                            <div class="col my-4">
                                            <input type="text" class="form-control text" placeholder="Select Cateogy or enter keyword" />
                                            <i class="fal fa-search icon search-icon"></i>
                                            
                                            <br />
                                            <p> Try to search: <b class="InsideSearchbox-link"> <a href=""> videographers </a> , <a href=""> local marketing </a> </b> </p>
                                        
                                            </div>
                                            <div class="col my-4">
                                            <input type="text" class="form-control text" placeholder="Select Location" />
                                            <i class="fal fa-map-marker icon search-icon"></i>
                                           

                                            </div>
                                        </div>
                                    

                                            <p> Search in radius 0 miles </p>
                                            <input type="range" class="custom-range" id="customRange1">
                                                <div class="col my-2">
                                           
                                            <button class="btn btn-primary float-right my-2">  Search  </button>
                                                </div>
                            </form>
                        </div>
                    </div>

            </div>

  <!-- 3rd row -->
  <div class="row Category-Boxes ">

<div class="col-6">  <span> <a href="" > Content Marketing </a>  </span>  <span class="float-right"> 1  </span> <hr />  </div>
<div class="col-6">  <span> <a href="" > Real State </a>  </span>  <span class="float-right"> 1 </span>  <hr /> </div>
<div class="col-6"> <span> <a href="" > Videgraphers </a>  </span>  <span class="float-right"> 5 </span>  </div>
<div class="col-6"> <span> <a href="" > Web Design </a>  </span>  <span class="float-right"> 1 </span>  </div>

</div>

<div class="row">
 <!--The div element for the map -->
 <div class="col-12 text-center border px-0 pt-4">
 <iframe width="100%" height="450" src="https://maps.google.com/maps?width=100%&amp;height=600&amp;hl=en&amp;q=1%20Grafton%20Street%2C%20Dublin%2C%20Ireland+(My%20Business%20Name)&amp;ie=UTF8&amp;t=&amp;z=14&amp;iwloc=B&amp;output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"><a href="https://www.maps.ie/draw-radius-circle-map/">Create radius map</a></iframe><br />
</div>
</div>


<div class="row my-2">

<div class="col-12 my-4 p-0">
<div class="float-left">
<h6> Found<span class="h-8">8</span>listings </h6>
<div class="dropdown mt-4">
  <button class="btn btn-primary" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
   Sort By
  </button>
  <div class="dropdown-menu " aria-labelledby="dropdownMenuButton">
    <a class="dropdown-item" href="#">Date</a>
    <a class="dropdown-item" href="#"> New to Old</a>
    <a class="dropdown-item" href="#">Alpahabet</a>
  </div>
</div>
 </div>
<div class="float-right" style="position: relative;top: 31px;">

<ul class="nav Custom-nav2  nav-pills mb-3" id="pills-tab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true"><i class="fas fa-list icon" ></i></a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false"><i class="fas fa-th-large icon"></i></a>
  </li>
 
</ul>

  


</div>


</div>

<div class="col-12 p-0">
<div class="tab-content Custom-Tab2" id="pills-tabContent">
<span class="tab-pane fade show active  " id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">

<div class="card mx-auto mb-5" style="max-width: 1240px;">
  <div class="row no-gutters">
    <div class="col-md-4">
      <img src="https://upload.wikimedia.org/wikipedia/commons/6/61/Rainbow_Rose_%283366550029%29.jpg" class="card-img" alt="...">
    </div>
    <div class="col-md-8">
      <div class="card-body">
      <a href="/joe"  > <h3 class="card-title font-weight-bold "  >  Joe French Realtor </a> </h3>
         <!-- <span id="rating-head">   
        <span onclick='onRating(1)' class="fa fa-star  "></span>
        <span onclick='onRating(2)'  class="fa fa-star "></span>
        <span onclick='onRating(3)' class="fa fa-star "></span>
        <span onclick='onRating(4)' class="fa fa-star"></span>
        <span onclick='onRating(5)' class="fa fa-star"></span>
        </span> -->

        <br />
        <p class="card-text">Serving Sellers and Buyers of real estate in central Maryland</p>
        <p class="card-text my-3"> <i  class="fa icon-blue fa-map-marker mr-2"></i>   Address: 6020 Meadowridge Center Drive, STE#M, Elkridge, Maryland, USA 21075</p>
        <button class=" btn-tags"> Brokers and Agents   <span  class="fa  fa-tag"></span> </button>
        <button class="  btn-tags"> Real Estate   <span  class="fa  fa-tag"></span> </button>
        
        <p class="card-text my-3">  <i  class="fa icon-blue fa-phone mr-2"></i>   Phone: 240-517-1653</p>

      </div>
    </div>
  </div>
</div>



<div class="card mx-auto mb-5" style="max-width: 1240px;">
  <div class="row no-gutters">
    <div class="col-md-4">
      <img src="https://upload.wikimedia.org/wikipedia/commons/6/61/Rainbow_Rose_%283366550029%29.jpg" class="card-img" alt="...">
    </div>
    <div class="col-md-8">
      <div class="card-body">
      <a href="/joe"  > <h3 class="card-title font-weight-bold "  >  Joe French Realtor </a> </h3>
         <!-- <span id="rating-head">   
        <span onclick='onRating(1)' class="fa fa-star  "></span>
        <span onclick='onRating(2)'  class="fa fa-star "></span>
        <span onclick='onRating(3)' class="fa fa-star "></span>
        <span onclick='onRating(4)' class="fa fa-star"></span>
        <span onclick='onRating(5)' class="fa fa-star"></span>
        </span> -->

        <br />
        <p class="card-text">Serving Sellers and Buyers of real estate in central Maryland</p>
        <p class="card-text my-3"> <i  class="fa icon-blue fa-map-marker mr-2"></i>   Address: 6020 Meadowridge Center Drive, STE#M, Elkridge, Maryland, USA 21075</p>
        <button class=" btn-tags"> Brokers and Agents   <span  class="fa  fa-tag"></span> </button>
        <button class="  btn-tags"> Real Estate   <span  class="fa  fa-tag"></span> </button>
        
        <p class="card-text my-3">  <i  class="fa icon-blue fa-phone mr-2"></i>   Phone: 240-517-1653</p>

      </div>
    </div>
  </div>
</div>

<div class="card mx-auto mb-5" style="max-width: 1240px;">
  <div class="row no-gutters">
    <div class="col-md-4">
      <img src="https://upload.wikimedia.org/wikipedia/commons/6/61/Rainbow_Rose_%283366550029%29.jpg" class="card-img" alt="...">
    </div>
    <div class="col-md-8">
      <div class="card-body">
      <a href="/joe"  > <h3 class="card-title font-weight-bold "  >  Joe French Realtor </a> </h3>
         <!-- <span id="rating-head">   
        <span onclick='onRating(1)' class="fa fa-star  "></span>
        <span onclick='onRating(2)'  class="fa fa-star "></span>
        <span onclick='onRating(3)' class="fa fa-star "></span>
        <span onclick='onRating(4)' class="fa fa-star"></span>
        <span onclick='onRating(5)' class="fa fa-star"></span>
        </span> -->

        <br />
        <p class="card-text">Serving Sellers and Buyers of real estate in central Maryland</p>
        <p class="card-text my-3"> <i  class="fa icon-blue fa-map-marker mr-2"></i>   Address: 6020 Meadowridge Center Drive, STE#M, Elkridge, Maryland, USA 21075</p>
        <button class=" btn-tags"> Brokers and Agents   <span  class="fa  fa-tag"></span> </button>
        <button class="  btn-tags"> Real Estate   <span  class="fa  fa-tag"></span> </button>
        
        <p class="card-text my-3">  <i  class="fa icon-blue fa-phone mr-2"></i>   Phone: 240-517-1653</p>

      </div>
    </div>
  </div>
</div>







</span>

  <span class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">

  <div class="card-group">
  <div class="card mr-4">
    <img class="card-img-top" src="https://upload.wikimedia.org/wikipedia/commons/6/61/Rainbow_Rose_%283366550029%29.jpg"  alt="Card image cap">
    <div class="card-body">
    <a href="/joe"  > <h3 class="card-title font-weight-bold "  >  Joe French Realtor </a> </h3>
         <!-- <span id="rating-head">   
        <span onclick='onRating(1)' class="fa fa-star  "></span>
        <span onclick='onRating(2)'  class="fa fa-star "></span>
        <span onclick='onRating(3)' class="fa fa-star "></span>
        <span onclick='onRating(4)' class="fa fa-star"></span>
        <span onclick='onRating(5)' class="fa fa-star"></span>
        </span> -->

        <br />
        <p class="card-text">Serving Sellers and Buyers of real estate in central Maryland</p>
        <p class="card-text my-3"> <i  class="fa icon-blue fa-map-marker mr-2"></i>   Address: 6020 Meadowridge Center Drive, STE#M, Elkridge, Maryland, USA 21075</p>
        <button class=" btn-tags"> Brokers and Agents   <span  class="fa  fa-tag"></span> </button>
        <button class="  btn-tags"> Real Estate   <span  class="fa  fa-tag"></span> </button>
        
        <p class="card-text my-3">  <i  class="fa icon-blue fa-phone mr-2"></i>   Phone: 240-517-1653</p>
    </div>
  </div>
  <div class="card">
    <img class="card-img-top"  src="https://upload.wikimedia.org/wikipedia/commons/4/47/Snowboarder_in_flight_%28Tannheim%2C_Austria%29.jpg"  alt="Card image cap">
    <div class="card-body">
  <a href="/joe"  > <h3 class="card-title font-weight-bold "  >  Joe French Realtor </a> </h3>
         <!-- <span id="rating-head">   
        <span onclick='onRating(1)' class="fa fa-star  "></span>
        <span onclick='onRating(2)'  class="fa fa-star "></span>
        <span onclick='onRating(3)' class="fa fa-star "></span>
        <span onclick='onRating(4)' class="fa fa-star"></span>
        <span onclick='onRating(5)' class="fa fa-star"></span>
        </span> -->

        <br />
        <p class="card-text">Serving Sellers and Buyers of real estate in central Maryland</p>
        <p class="card-text my-3"> <i  class="fa icon-blue fa-map-marker mr-2"></i>   Address: 6020 Meadowridge Center Drive, STE#M, Elkridge, Maryland, USA 21075</p>
        <button class=" btn-tags"> Brokers and Agents   <span  class="fa  fa-tag"></span> </button>
        <button class="  btn-tags"> Real Estate   <span  class="fa  fa-tag"></span> </button>
        
        <p class="card-text my-3">  <i  class="fa icon-blue fa-phone mr-2"></i>   Phone: 240-517-1653</p>
    </div>
  </div>
 
</div>


<hr />

<div class="card-group">
  <div class="card mr-4">
    <img class="card-img-top" src="https://upload.wikimedia.org/wikipedia/commons/4/47/Snowboarder_in_flight_%28Tannheim%2C_Austria%29.jpg"  alt="Card image cap">
    <div class="card-body">
  <a href="/joe"  > <h3 class="card-title font-weight-bold "  >  Joe French Realtor </a> </h3>
         <!-- <span id="rating-head">   
        <span onclick='onRating(1)' class="fa fa-star  "></span>
        <span onclick='onRating(2)'  class="fa fa-star "></span>
        <span onclick='onRating(3)' class="fa fa-star "></span>
        <span onclick='onRating(4)' class="fa fa-star"></span>
        <span onclick='onRating(5)' class="fa fa-star"></span>
        </span> -->

        <br />
        <p class="card-text">Serving Sellers and Buyers of real estate in central Maryland</p>
        <p class="card-text my-3"> <i  class="fa icon-blue fa-map-marker mr-2"></i>   Address: 6020 Meadowridge Center Drive, STE#M, Elkridge, Maryland, USA 21075</p>
        <button class=" btn-tags"> Brokers and Agents   <span  class="fa  fa-tag"></span> </button>
        <button class="  btn-tags"> Real Estate   <span  class="fa  fa-tag"></span> </button>
        
        <p class="card-text my-3">  <i  class="fa icon-blue fa-phone mr-2"></i>   Phone: 240-517-1653</p>
    </div>
  </div>
  <div class="card">
    <img class="card-img-top"  src="https://upload.wikimedia.org/wikipedia/commons/6/61/Rainbow_Rose_%283366550029%29.jpg"  alt="Card image cap">
    <div class="card-body">
  <a href="/joe"  > <h3 class="card-title font-weight-bold "  >  Joe French Realtor </a> </h3>
         <!-- <span id="rating-head">   
        <span onclick='onRating(1)' class="fa fa-star  "></span>
        <span onclick='onRating(2)'  class="fa fa-star "></span>
        <span onclick='onRating(3)' class="fa fa-star "></span>
        <span onclick='onRating(4)' class="fa fa-star"></span>
        <span onclick='onRating(5)' class="fa fa-star"></span>
        </span> -->

        <br />
        <p class="card-text">Serving Sellers and Buyers of real estate in central Maryland</p>
        <p class="card-text my-3"> <i  class="fa icon-blue fa-map-marker mr-2"></i>   Address: 6020 Meadowridge Center Drive, STE#M, Elkridge, Maryland, USA 21075</p>
        <button class=" btn-tags"> Brokers and Agents   <span  class="fa  fa-tag"></span> </button>
        <button class="  btn-tags"> Real Estate   <span  class="fa  fa-tag"></span> </button>
        
        <p class="card-text my-3">  <i  class="fa icon-blue fa-phone mr-2"></i>   Phone: 240-517-1653</p>
    </div>
  </div>
 
</div>



  </span>
  
</div>
 </div>


 </div>
    
 </div>

 <script>
     const onRating = (id) =>{
         console.log(document.documentElement.style);
         console.log(document.getElementById('rating-head').children);
         let ratingComponent = document.getElementById('rating-head').children ;
        
         for( let i=0 ; i< id ; i++){
           ratingComponent[i].style.setProperty( 'color' , 'orange' ) ; 
           }

         for( let i=id ; i<=ratingComponent.length-1  ; i++){
          
          ratingComponent[i].style.setProperty( 'color' , 'black' ) ; 
         
   }

        
     
     }

</script>


@endsection;