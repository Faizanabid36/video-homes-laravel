import React , {useState , useEffect} from 'react'
import {Alert ,Button , } from "react-bootstrap";

export default function Alerts(props) {
    const [show, setShow] = useState(false);
    const [variant, setVariant] = useState('');

    useEffect(() => {
       setShow(props.data.show) ;
       setVariant(props.data.variant) ;
       console.log(props);
    }, [props])
    return ( <>
      <Alert show={show} variant={variant} onClose={() => {setShow(false)}}  dismissible>
        <Alert.Heading>{props.data.message}</Alert.Heading>
      </Alert>

    </>
        
    )
}
