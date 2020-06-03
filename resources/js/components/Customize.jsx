import { Button, Carousel, Col,Row, Container,Form } from "react-bootstrap";
import React, { useCallback, useState,useEffect } from "react";
import {FontAwesomeIcon} from "@fortawesome/react-fontawesome";
import {
    faPlay,
    faVolumeUp ,
    faExpandArrowsAlt ,
    faAlignCenter,
    faAlignJustify
    
} from "@fortawesome/free-solid-svg-icons";

export default function Customize(props){
    return (
      <Container>
  <Row >
      <Col lg={12}>
   <div className="Customization-head"> 

       <p> Customize your video player below. Choose from one of six themes or customize your own.  </p>
   </div>
   </Col>
  </Row>

  <Row>
    <Col lg={5}>
    <div>
        <h3>  Choose a Style </h3>
     <div classNameName="form-check">
  <input classNameName="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked />
  <label classNameName="form-check-label" for="exampleRadios1">
    Standard
  </label>
    </div>
<div classNameName="form-check">
  <input classNameName="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="option2" />
  <label classNameName="form-check-label" for="exampleRadios2">
    Minimal
  </label>
</div>
</div>
<div>
<h3> Choose a color   </h3>
<div className="inline-radio">
<div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1" />
  <label class="form-check-label" for="inlineRadio1"> <div className='customization-icon '> <FontAwesomeIcon icon={faPlay} color="white" /> <div className="foot white">  </div>  </div> </label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2" />
  <label class="form-check-label" for="inlineRadio2"><div className='customization-icon'> <FontAwesomeIcon icon={faPlay} color="white" /> <div className="foot red">  </div>  </div></label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2" />
  <label class="form-check-label" for="inlineRadio2"><div className='customization-icon'> <FontAwesomeIcon icon={faPlay} color="white" /> <div className="foot red">  </div>  </div></label>
</div>

</div>
<div className="inline-radio">
<div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1" />
  <label class="form-check-label" for="inlineRadio1"><div className='customization-icon'> <FontAwesomeIcon icon={faPlay} color="white" /> <div className="foot gray">  </div>  </div></label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2" />
  <label class="form-check-label" for="inlineRadio2"><div className='customization-icon'> <FontAwesomeIcon icon={faPlay} color="lightBlue" /> <div className="foot blue">  </div>  </div></label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2" />
  <label class="form-check-label" for="inlineRadio2"><div className='customization-icon'> <FontAwesomeIcon icon={faPlay} color="white" /> <div className="foot green">  </div>  </div></label>
</div>

</div>

<hr />
<div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2" />
  <label class="form-check-label" for="inlineRadio2">OR customize your player:</label>
</div>
<div>
<input type="color" id="favcolor" name="favcolor" value="#ff0000"></input>
<input type="color" id="favcolor" name="favcolor" value="#ff0000"></input>
<input type="color" id="favcolor" name="favcolor" value="#ff0000"></input>
</div>


</div>
    
    </Col>
    <Col lg={7}>
      <h3>  Preview Your Player: </h3>
      <div className="imageCustomize">
      
        <div className=" bottom-image-customization ">   
            <span> <FontAwesomeIcon icon={faPlay} color="gray" /> </span>
            <span> <FontAwesomeIcon icon={faVolumeUp} color="gray" />  </span>
            <span className="loadVideo"> <div className="level">  </div></span>
            <span><FontAwesomeIcon icon={faExpandArrowsAlt} color="gray" /> </span>
            <span><FontAwesomeIcon icon={faAlignJustify} color="gray" /> </span>
         </div> 

         </div>
    </Col>
   
  </Row>
  <hr />
  <br />
   <hr />

  <Row>
    <Col xs={6}>
        <a href="" > Cancel </a>
        <button className=""> Save Changes </button>

    </Col>
   
  </Row>
</Container>
    )
    
}
