@extends('layouts.public.app')
@section('content')


<div class="bigContainer">
<div class="row">

<div class="col-md-7 col-sm-12">
<h2>
Joe French Realtor


</h2>
<h3>
<span id="rating-head">   
        <span onclick='onRating(1)' class="fa fa-star  "></span>
        <span onclick='onRating(2)'  class="fa fa-star "></span>
        <span onclick='onRating(3)' class="fa fa-star "></span>
        <span onclick='onRating(4)' class="fa fa-star"></span>
        <span onclick='onRating(5)' class="fa fa-star"></span>
        </span>

       <span class="rating-circle"> 0.0 </span> 
</h3>



</div>
<div class="col-md-5 col-sm-12 ">
<div class="text-right custom-tooltip">
<button type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="submit new listing">
<i class='fas icon fa-plus'></i>
</button>
<button type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="My bookmarks">
<i class="far icon fa-star"></i>
</button>
<button type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Print listing">
<i class='fas  icon fa-print'></i>
</button>
<button type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Add/Remove Bookmarks">
<i class='fas icon fa-heart'></i>
</button>
<button type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="save listing PDF">
<i class='fas icon fa-download'></i>
</button>
</div>
</div>


<div class="row">
    <div class="col-3">
    <h2 style="text-align:center">Slideshow Gallery</h2>

            <div class="container">
            <div class="mySlides">
                <div class="numbertext">1 / 2</div>
                <img src="https://upload.wikimedia.org/wikipedia/commons/6/61/Rainbow_Rose_%283366550029%29.jpg" style="width:100%">
            </div>

        <div class="mySlides">
            <div class="numbertext">2 / 2</div>
            <img src="https://onlinejpgtools.com/images/examples-onlinejpgtools/cloud-ice-cream.jpg" style="width:100%">
        </div>

 
    
  <a class="prev" onclick="plusSlides(-1)">❮</a>
  <a class="next" onclick="plusSlides(1)">❯</a>

        <div class="caption-container">
            <p id="caption"></p>
        </div>

  
    </div>    
    </div>

    <div class="col-9">
            <div class="row">
                            <div id="background" class="hidden"></div>
                            <div class="col-md-8 player-video" style="margin-top: 0 !important">
                                <div class="video-player pt_video_player " id="pt_video_player">
                                    <span class="mejs__offscreen">Video Player</span>
                                    <video id="my-video_html5"
                                        style="width: 100%;border:1px solid red ; height: 451.872px; position: relative;"
                                        
                                        preload="none"
                                        
                                    >
                                    <!-- F:\VideoHomesPlus\video-homes-laravel\storage\app\public\uploads\3pzSThx5aQpZe0CM.mp4 -->
                                    <source
                                    src=""
                                                    type="video/mp4"
                                                    data-quality="480p" title="480p" label="480p" res="480">
                                    </video>
                                    <div class="icons hidden">
                                        <span class="expend-player"><i class="fa fa-expand fa-fw"></i></span>
                                    </div>
                                </div>
                                <div class="clear"></div>
                            </div>
                            <div class="col-md-4 no-padding-left pull-right desktop">
                                <div class="content pt_shadow">
                                    <div class="ads-placment"></div>
                                    <div class="next-video">
                                        <div class="next-text pull-left pt_mn_wtch_nxttxt">
                                            <h4>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24">
                                                    <path fill="currentColor" d="M16,18H18V6H16M6,18L14.5,12L6,6V18Z"></path>
                                                </svg>
                                                Up next
                                            </h4>
                                        </div>
                                        <div class="pt_mn_wtch_switch pull-right">
                                            <input id="autoplay" type="checkbox" class="tgl autoplay-video">
                                            <label class="tgl-btn" for="autoplay">Autoplay</label>
                                        </div>
                                        <div class="clear"></div>
                                        <div class="video-thumb">
                                                    <a href="">
                                                        <img width="200px" height="200px"
                                                            src="https://onlinejpgtools.com/images/examples-onlinejpgtools/cloud-ice-cream.jpg"
                                                            alt="Products">
                                                        <div class="play_hover_btn" onmouseenter="show_gif(this,'')"
                                                            onmouseleave="hide_gif(this)">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                                class="feather feather-play-circle">
                                                                <circle cx="12" cy="12" r="10"></circle>
                                                                <polygon points="10 8 16 12 10 16 10 8"></polygon>
                                                            </svg>
                                                        </div>
                                                        <div
                                                            class="video-duration"></div>
                                                    </a>
                                            </div>
                

            <div>

    </div>


</div>
</div>
</div>
</div>
</div>
</div>
</div>








<!-- 2nd row -->

<div class="row">
<div class="col-5">
<button class="btn btn-primary"> Brokers and agents  <i class='fas icon fa-tag'></i> </button>
<button class="btn btn-primary"> Real Estate <i class='fas icon fa-tag'></i> </button>
<button class="btn btn-primary"> Realtor <i class='fas icon fa-tag'></i> </button>

</div>
<div class="col-7">
<p> 

Joe French
</p>

<p> Broker Associate </p>

<p> 240-517-1653 cell | 410-705-6296 o </p>

<p>Exit Results Realty
</p>

</div>
</div>


<!-- 3rd row -->

<div class="row">
    <div class="col-12">
    <h3 class="font-weight-bold">  CONTACT INFORMATION <div class="borderBottomBold my-3" > </div> </h3 class="font-weight-bold">
    
    </div>
    <div class="col-12 contactWidgets my-2 ">
    <div class="d-flex">  <div> <i class='fas icon fa-phone'></i>  Phone  </div>  <div>  00000  </div>       </div>
    <hr />
    <div class="d-flex">  <div> <i class='fas icon fa-globe'></i>  Website  </div>  <div> <a href=""> view our site </a> </div>       </div>
    <hr />
    <div class="d-flex">  <div> <i class='fas icon fa-envelope'></i>  Email  </div>  <div>  <a href="mailto: joe.french@exitresults.com" >  joe.french@exitresults.com  </a>  </div>       </div>
    <hr />
    </div>
   
</div>

<div class="row">
<div class="col-12" >

<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item" role="presentation">
    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Map</a>
  </li>
  <li class="nav-item" role="presentation">
    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Reviews (0)</a>
  </li>
  <li class="nav-item" role="presentation">
    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Contact</a>
  </li>
  <li class="nav-item" role="Report">
    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#report" role="tab" aria-controls="report" aria-selected="false">Report</a>
  </li>
</ul>
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

  <iframe width="100%" height="450" src="https://maps.google.com/maps?width=100%&amp;height=600&amp;hl=en&amp;q=1%20Grafton%20Street%2C%20Dublin%2C%20Ireland+(My%20Business%20Name)&amp;ie=UTF8&amp;t=&amp;z=14&amp;iwloc=B&amp;output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"><a href="https://www.maps.ie/draw-radius-circle-map/">Create radius map</a></iframe><br />

    <h4 class="my-3">  Get directions from: </h4>
    <div class="input-group mb-3">
  <input type="text" class="form-control" placeholder="Enter address or zip code" aria-label="Recipient's username" aria-describedby="button-addon2">
  <div class="input-group-append">
    <button class="btn btn-outline-secondary" type="button" id="button-addon2"> <i style="color:gray ; font-size:14px" class='fas icon fa-map-marker'></i> </button>
  </div>
   </div>
   <p> <a href=""> <i style="color:lightBlue ; font-size:14px" class='fas icon fa-circle'></i>  6020 Meadowridge Center Drive, STE#M, Elkridge, Maryland, USA 21075 </a>  </p>
    <button class="btn btn-primary">  GET DIRECTION  </button>
  </div>
  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
    <button class="btn btn-primary my-3"> Add Review  </button>
    <div class="row">
<div class="col-4 rating-star-field">
   <div class="d-flex align-items-center my-2"> 
        <span> 5 Stars  </span> 
        <span> 
        <div class="progress custom-progress">
            <div class="progress-bar custom-progress-bar" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
            </div>  
        </span> 
        <span> -0 0%   </span>  
    </div>

    <div class="d-flex align-items-center my-2"> 
        <span> 4 Stars  </span> 
        <span> 
        <div class="progress custom-progress">
            <div class="progress-bar custom-progress-bar" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
            </div>  
        </span> 
        <span> -0 0%   </span>  
    </div>


    <div class="d-flex align-items-center my-2"> 
        <span> 3 Stars  </span> 
        <span> 
        <div class="progress custom-progress">
            <div class="progress-bar custom-progress-bar" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
            </div>  
        </span> 
        <span> -0 0%   </span>  
    </div>

    <div class="d-flex align-items-center my-2"> 
        <span> 2 Stars  </span> 
        <span> 
        <div class="progress custom-progress">
            <div class="progress-bar custom-progress-bar" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
            </div>   
        </span> 
        <span> -0 0%   </span>  
    </div>
  </div>
  <div class="col-8">
    <div id="circleProgress1" class="progressbar-js-circle  rounded p-3"><svg viewBox="0 0 100 100" style="display: block; width: 100%;">
                                        <path d="M 50,50 m 0,-48 a 48,48 0 1 1 0,96 a 48,48 0 1 1 0,-96" stroke="#eee" stroke-width="4" fill-opacity="0"></path>
                                        <path d="M 50,50 m 0,-48 a 48,48 0 1 1 0,96 a 48,48 0 1 1 0,-96" stroke="rgb(159,162,179)" stroke-width="4" fill-opacity="0" style="stroke-dasharray: 301.635, 301.635; stroke-dashoffset: 199.079;"></path>
                                    </svg>
                                    <div class="progressbar-text" style="position: absolute; left: 11%; top: 38%; padding: 0px; margin: 0px; transform: translate(-50%, -50%); color: lightblue; font-size: 2rem;">34</div>
                                </div>

  </div>
  </div>
  </div> 
  <!-- reviews end -->
  <!-- Contact -->
  <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
    <h1 class="my-3 font-weight-bold"> Send message to listing owner  </h1>
  <form>
  <div class="form-group">
    <label for="exampleFormControlInput1">Contact Name</label>
    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="">
  </div>
  <div class="form-group">
    <label for="exampleFormControlInput1">Contact Email</label>
    <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="">
  </div>
 

  <div class="form-group">
    <label for="exampleFormControlTextarea1">Example textarea</label>
    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
  </div>
  <button class="btn btn-primary"> Send Message </button>
</form>
  </div>
  <div class="tab-pane fade" id="report" role="tabpanel" aria-labelledby="report-tab">
      <!-- .report. -->

      <h1 class="my-3 font-weight-bold"> Send message to moderator  </h1>
  <form>
  <div class="form-group">
    <label for="exampleFormControlInput1">Contact Name</label>
    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="">
  </div>
  <div class="form-group">
    <label for="exampleFormControlInput1">Contact Email</label>
    <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="">
  </div>
 

  <div class="form-group">
    <label for="exampleFormControlTextarea1">Example textarea</label>
    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
  </div>
  <button class="btn btn-primary"> Send Message </button>
</form>




  </div>
</div>

</div>


</div>


 </div>  <!--parentContainer -->


<script>
var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("demo");
  var captionText = document.getElementById("caption");
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " active";
  captionText.innerHTML = dots[slideIndex-1].alt;
}
</script>
@endsection;