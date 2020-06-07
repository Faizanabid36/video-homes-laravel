import React ,  { PureComponent} from 'react'
import {Alert ,Button , } from "react-bootstrap";



class Alerts extends PureComponent{
    constructor(props){
      super(props);

      this.state = {
        show: false,
       
      }
    }

    componentWillReceiveProps(nextprops){
      console.log('next' , nextprops)
      if(nextprops){

        this.setState( { show:nextprops.data.show  } )
      }
    }

  render(){
    
    return(
<>
      <Alert show={this.state.show} variant={this.props.data.variant} onClose={ this.props.data.setAlertShow }  dismissible>
      <Alert.Heading>{this.props.data.message}</Alert.Heading>
    </Alert>

  </> 
    )
  }
}

export default Alerts ;


// export default function Alerts(props) {
//     const [show, setShow] = useState(false);
//     const [variant, setVariant] = useState('');

//     useEffect(() => {
//        setShow(props.data.show) ;
//        setVariant(props.data.variant) ;
//        console.log(props);
//     }, [props])
//     return ( <>
//       <Alert show={show} variant={variant} onClose={() => {setShow(false)}}  dismissible>
//         <Alert.Heading>{props.data.message}</Alert.Heading>
//       </Alert>

//     </> 
        
//     )
// }