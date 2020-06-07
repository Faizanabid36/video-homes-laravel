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

    let [color1 , setColor1] = useState();
    let [color2 , setColor2] = useState();
    let [color3 , setColor3] = useState();
    let [grobalColorVar , setGlbColor ] = useState('black');
    const inputS = document.querySelectorAll('input ');
    
     function handleChange(){
       
           document.documentElement.style.setProperty( `--${this.name}` , this.value  )
       
    }

    function handleFoot() {
        
        

        if(document.getElementById('BlackWhiteFooter').checked ){
            document.documentElement.style.setProperty( '--level-background' , 'white'  )
            document.documentElement.style.setProperty( '--load-video' , 'black'  )
            document.documentElement.style.setProperty( '--Control-buttons' , 'gray'  )
        }
        else if(document.getElementById('GrayRedFooter').checked ){
            document.documentElement.style.setProperty( '--level-background' , 'red'  )
            document.documentElement.style.setProperty( '--load-video' , 'rgb(46, 46, 46)'  )
            document.documentElement.style.setProperty( '--Control-buttons' , 'gray'  )

            }   
        else if(document.getElementById('RedWhiteFooter').checked ){
                document.documentElement.style.setProperty( '--level-background' , 'red'  )
                document.documentElement.style.setProperty( '--load-video' , 'white'  )
            document.documentElement.style.setProperty( '--Control-buttons' , 'gray'  )

                } 
                
         else if(document.getElementById('WhiteGrayFooter').checked){
                document.documentElement.style.setProperty( '--level-background' , 'white'  )
                document.documentElement.style.setProperty( '--load-video' , 'rgb(46, 46, 46)'  )
                document.documentElement.style.setProperty( '--Control-buttons' , 'gray'  )
                }         
        else if(document.getElementById('BlueBlackFooter').checked){
            document.documentElement.style.setProperty( '--level-background' , '#09c4fd'  )
            document.documentElement.style.setProperty( '--load-video' , 'black'  )
            document.documentElement.style.setProperty( '--Control-buttons' , '#09c4fd'  )
            
        }   
       
        else if(document.getElementById('GreenGrayFooter').checked){
            document.documentElement.style.setProperty( '--level-background' , 'rgb(147, 253, 29)'  )
            document.documentElement.style.setProperty( '--load-video' , 'rgb(46, 46, 46)'  )
            document.documentElement.style.setProperty( '--Control-buttons' , 'gray'  )
        }      
        else{
            document.documentElement.style.setProperty( '--Control-buttons' , 'gray'  )
            document.documentElement.style.setProperty( '--level-background' , 'gray'  )
            document.documentElement.style.setProperty( '--load-video' , 'black'  )

        }
    }
    function handleMinimal(){
        console.log(   document.documentElement.style.getPropertyValue('--load-video'));
        setGlbColor(document.documentElement.style.getPropertyValue('--load-video'));
        document.getElementById('level').style.setProperty( 'padding' , '10px 0px' ) ;
        document.getElementById('bottom-image-customization').style.setProperty( 'background' , 'none' ) ;
        // document.documentElement.style.setProperty( '--load-video' , 'transparent'  )

       
        

        let y = document.getElementById('bottom-image-customization').childNodes;
         console.log('asd' , y );
        for (let i = 0; i < y.length; i++) {

            y[i].style.setProperty( 'border' , 'none' ) ; 
            
          }
        
    }
    function handleStandard(){
        
        document.getElementById('bottom-image-customization').style.removeProperty( 'background'  ) ;

        document.getElementById('level').style.setProperty( 'padding' , '0' ) ;
        
        document.documentElement.style.setProperty( '--load-video' , `${grobalColorVar}`  )

         let y = document.getElementById('bottom-image-customization').childNodes;
       
        for (let i = 0; i < y.length; i++) {
            y[i].style.setProperty( 'border' , '1px solid gray' ) ; 
            
            
            
            

          }
    }


    inputS.forEach( input => input.addEventListener('change' , handleChange ) ) ;

    return (
      <Container>
  <Row >
      <Col xs={12} className="my-5">
  

       <h2> Customize your video player below. Choose from one of six themes or customize your own.  <div className="borderBottom2"> </div> </h2>
   
   </Col>
  </Row>

  <Row>
    <Col lg={5}>
    <div>
        <h3>  Choose a Style </h3>
     <div classNameName="form-check">
  <input classNameName="form-check-input" type="radio" name="exampleRadios" onChange={handleStandard} id="exampleRadios1" value="option1"  />
  <label classNameName="form-check-label" id="exampleRadios1" for="exampleRadios1">
    Standard
  </label>
    </div>
<div classNameName="form-check" >
  <input classNameName="form-check-input" type="radio" name="exampleRadios" onChange={handleMinimal} id="exampleRadios2" value="option2" />
  <label classNameName="form-check-label"  for="exampleRadios2">
    Minimal
  </label>
</div>
</div>
<div>
<h3> Choose a color   </h3>
<div className="inline-radio">
<div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="inlineRadioOptions" onChange={handleFoot} id="BlackWhiteFooter" value="option1" />
  <label class="form-check-label" for="BlackWhiteFooter"> <div className='customization-icon bg-black '> <FontAwesomeIcon icon={faPlay} color="white" /> <div id="levelFoot" className="foot white ">  </div>  </div> </label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="inlineRadioOptions" onChange={handleFoot} id="GrayRedFooter" value="option2" />
  <label class="form-check-label" for="GrayRedFooter"><div className='customization-icon bg-gray'> <FontAwesomeIcon icon={faPlay} color="white" /> <div className="foot red">  </div>  </div></label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="inlineRadioOptions" onChange={handleFoot} id="RedWhiteFooter" value="option2" />
  <label class="form-check-label" for="RedWhiteFooter"><div className='customization-icon bg-white'> <FontAwesomeIcon icon={faPlay} color="black" /> <div className="foot red">  </div>  </div></label>
</div>

</div>
<div className="inline-radio">
<div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="inlineRadioOptions" onChange={handleFoot} id="WhiteGrayFooter" value="option1" />
  <label class="form-check-label" for="WhiteGrayFooter"><div className='customization-icon bg-gray '> <FontAwesomeIcon icon={faPlay} color="white" /> <div className="foot gray">  </div>  </div></label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="inlineRadioOptions" onChange={handleFoot} id="BlueBlackFooter" value="option2" />
  <label class="form-check-label" for="BlueBlackFooter"><div className='customization-icon bg-black'> <FontAwesomeIcon icon={faPlay} color="#09c4fd" /> <div className="foot blue">  </div>  </div></label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="inlineRadioOptions" onChange={handleFoot} id="GreenGrayFooter" value="option2" />
  <label class="form-check-label" for="GreenGrayFooter"><div className='customization-icon bg-gray'> <FontAwesomeIcon icon={faPlay} color="white" /> <div className="foot green">  </div>  </div></label>
</div>

</div>

<hr />
<div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio7" onChange={handleFoot} value="option7" />
  <label class="form-check-label" for="inlineRadio7">OR customize your player:</label>
  
 

</div>
<div>
<label class="form-check-label" for="inlineRadio7" className="color-picker-parent" >  <input type="color"  className="Color-Picker" name="load-video" value={color1}  onChange={(e)=>{setColor1(e.target.value)}} ></input> <p> Control Bar </p> </label>
<label class="form-check-label" for="inlineRadio7" className="color-picker-parent" >  <input type="color"  name="level-background" value={color2} className="Color-Picker" onChange={(e)=>{setColor2(e.target.value)}}></input> <p> Highlight </p> </label>
<label class="form-check-label" for="inlineRadio7" className="color-picker-parent" >   <input type="color"  name="Control-buttons" value={color3} className="Color-Picker" onChange={(e)=>{setColor3(e.target.value)}}></input> <p> Buttons </p> </label>
</div>


</div>
    
    </Col>
    <Col lg={7}>
      <h3>  Preview Your Player: </h3>
      <div className="imageCustomize">
      
        <div className=" bottom-image-customization " id="bottom-image-customization">   
            <span> <FontAwesomeIcon icon={faPlay} className="control-buttons" /> </span>
            <span> <FontAwesomeIcon icon={faVolumeUp} className="control-buttons" />  </span>
            <span className="loadVideo" id='level'>  <div  className="level">   </div> <div className="remainingLevel">   </div> </span>
            <span><FontAwesomeIcon icon={faExpandArrowsAlt} className="control-buttons" /> </span>
            <span><FontAwesomeIcon icon={faAlignJustify} className="control-buttons" /> </span>
         </div> 

         </div>
    </Col>
   
  </Row>
  <hr />
  
   <hr />

  <Row>
    <Col xs={6}>
        <button href="" className="btn btn-danger" > Cancel </button>
        <button className="btn btn-primary"> Save Changes </button>

    </Col>
   
  </Row>
</Container>
    )
    
}
