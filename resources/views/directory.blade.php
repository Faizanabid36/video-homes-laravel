@extends('layouts.public.app')
@section('content')


<div class="bigContainer">
    
        <div class="row">  
           <div class="col-12 my-3"> 
               <button class="btn btn-primary"> Submittin new List   </button>
           
                <button class="btn btn-primary"> My bookmarks   </button>
           </div>

        </div>
        <!-- 2nd row -->
            <div class="row">
                    <div class="col-12 my-2 "> 
                        <div class="Search-boxes">
                            <form>
                                            <div class="form-row ">
                                            <div class="col my-4">
                                            <input type="text" class="form-control" placeholder="Select Cateogy">
                                            <br />
                                            <p> Try to search: <b> videographers, local marketing </b> </p>
                                        
                                            </div>
                                            <div class="col my-4">
                                            <input type="text" class="form-control" placeholder="Select Location">
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
 <div class="col-12 text-center">
 <iframe width="100%" height="450" src="https://maps.google.com/maps?width=100%&amp;height=600&amp;hl=en&amp;q=1%20Grafton%20Street%2C%20Dublin%2C%20Ireland+(My%20Business%20Name)&amp;ie=UTF8&amp;t=&amp;z=14&amp;iwloc=B&amp;output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"><a href="https://www.maps.ie/draw-radius-circle-map/">Create radius map</a></iframe><br />
</div>
</div>


<div class="row">

<div class="col-12 my-2">
<div class="float-left">
<p> Found 8 listing </p>
<div class="dropdown">
  <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
   Sort By:
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    <a class="dropdown-item" href="#">date</a>
    <a class="dropdown-item" href="#"> New to Old</a>
    <a class="dropdown-item" href="#">Alpahabet</a>
  </div>
</div>
 </div>
<div class="float-right">

<ul class="nav Custom-nav2 nav-pills mb-3" id="pills-tab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true"><i class="fas fa-list icon" ></i></a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false"><i class="fas fa-th-large icon"></i></a>
  </li>
 
</ul>

  


</div>


</div>

<div class="col-12">
<div class="tab-content Custom-Tab2" id="pills-tabContent">
<span class="tab-pane fade show active  " id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">

<div class="card mx-auto" style="max-width: 1240px;">
  <div class="row no-gutters">
    <div class="col-md-4">
      <img src="https://upload.wikimedia.org/wikipedia/commons/6/61/Rainbow_Rose_%283366550029%29.jpg" class="card-img" alt="...">
    </div>
    <div class="col-md-8">
      <div class="card-body">
        <h2 class="card-title">Joe French Realtor</h2>
        <br />
        <br />
        <p class="card-text">Serving Sellers and Buyers of real estate in central Maryland</p>
        <p class="card-text my-2">Address: 6020 Meadowridge Center Drive, STE#M, Elkridge, Maryland, USA 21075</p>
        <button class="btn-primary"> Brokers and Agents </button>
        <button class="btn-primary"> Real Estate </button>
        
        <p class="card-text m-3"> Phone: 240-517-1653</p>

      </div>
    </div>
  </div>
</div>

<div class="card mx-auto" style="max-width: 1240px;">
  <div class="row no-gutters">
    <div class="col-md-4">
      <img  src="https://onlinejpgtools.com/images/examples-onlinejpgtools/cloud-ice-cream.jpg" class="card-img" alt="...">
    </div>
    <div class="col-md-8">
      <div class="card-body">
      <h2 class="card-title">Joe French Realtor</h2>
        <br />
        <br />
        <p class="card-text">Serving Sellers and Buyers of real estate in central Maryland</p>
        <p class="card-text">Address: 6020 Meadowridge Center Drive, STE#M, Elkridge, Maryland, USA 21075</p>
        <button class="btn-primary"> Brokers and Agents </button>
        <button class="btn-primary"> Real Estate </button>
        
        <p class="card-text my-3"> Phone: 240-517-1653</p>
      </div>
    </div>
  </div>
</div>


<div class="card mx-auto" style="max-width: 1240px;">
  <div class="row no-gutters">
    <div class="col-md-4">
      <img  src="https://upload.wikimedia.org/wikipedia/commons/4/47/Snowboarder_in_flight_%28Tannheim%2C_Austria%29.jpg" class="card-img" alt="...">
    </div>
    <div class="col-md-8">
      <div class="card-body">
      <h2 class="card-title">Joe French Realtor</h2>
        <br />
        <br />
        <p class="card-text">Serving Sellers and Buyers of real estate in central Maryland</p>
        <p class="card-text">Address: 6020 Meadowridge Center Drive, STE#M, Elkridge, Maryland, USA 21075</p>
        <button class="btn-primary"> Brokers and Agents </button>
        <button class="btn-primary"> Real Estate </button>
        
        <p class="card-text my-3"> Phone: 240-517-1653</p>
      </div>
    </div>
  </div>
</div>






</span>
  <span class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">

  <div class="card-group">
  <div class="card">
    <img class="card-img-top" src="https://upload.wikimedia.org/wikipedia/commons/6/61/Rainbow_Rose_%283366550029%29.jpg"  alt="Card image cap">
    <div class="card-body">
    <h2 class="card-title">Joe French Realtor</h2>
        <br />
      
        <p class="card-text">Serving Sellers and Buyers of real estate in central Maryland</p>
        <p class="card-text my-2">Address: 6020 Meadowridge Center Drive, STE#M, Elkridge, Maryland, USA 21075</p>
        <button class="btn-primary"> Brokers and Agents </button>
        <button class="btn-primary"> Real Estate </button>
        
        <p class="card-text m-1"> Phone: 240-517-1653</p>
    </div>
  </div>
  <div class="card">
    <img class="card-img-top"  src="https://upload.wikimedia.org/wikipedia/commons/4/47/Snowboarder_in_flight_%28Tannheim%2C_Austria%29.jpg"  alt="Card image cap">
    <div class="card-body">
    <h2 class="card-title">Joe French Realtor</h2>
        <br />
      
        <p class="card-text">Serving Sellers and Buyers of real estate in central Maryland</p>
        <p class="card-text my-2">Address: 6020 Meadowridge Center Drive, STE#M, Elkridge, Maryland, USA 21075</p>
        <button class="btn-primary"> Brokers and Agents </button>
        <button class="btn-primary"> Real Estate </button>
        
        <p class="card-text m-1"> Phone: 240-517-1653</p>
    </div>
  </div>
 
</div>


<hr />

<div class="card-group">
  <div class="card">
    <img class="card-img-top" src="https://upload.wikimedia.org/wikipedia/commons/4/47/Snowboarder_in_flight_%28Tannheim%2C_Austria%29.jpg"  alt="Card image cap">
    <div class="card-body">
    <h2 class="card-title">Joe French Realtor</h2>
        <br />
      
        <p class="card-text">Serving Sellers and Buyers of real estate in central Maryland</p>
        <p class="card-text my-2">Address: 6020 Meadowridge Center Drive, STE#M, Elkridge, Maryland, USA 21075</p>
        <button class="btn-primary"> Brokers and Agents </button>
        <button class="btn-primary"> Real Estate </button>
        
        <p class="card-text m-1"> Phone: 240-517-1653</p>
    </div>
  </div>
  <div class="card">
    <img class="card-img-top"  src="https://upload.wikimedia.org/wikipedia/commons/6/61/Rainbow_Rose_%283366550029%29.jpg"  alt="Card image cap">
    <div class="card-body">
    <h2 class="card-title">Joe French Realtor</h2>
        <br />
      
        <p class="card-text">Serving Sellers and Buyers of real estate in central Maryland</p>
        <p class="card-text my-2">Address: 6020 Meadowridge Center Drive, STE#M, Elkridge, Maryland, USA 21075</p>
        <button class="btn-primary"> Brokers and Agents </button>
        <button class="btn-primary"> Real Estate </button>
        
        <p class="card-text m-1"> Phone: 240-517-1653</p>
    </div>
  </div>
 
</div>



  </span>
  
</div>
 </div>


 </div>
    
 </div>



@endsection;