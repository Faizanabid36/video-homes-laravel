import React from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios'

class Login extends React.Component {
    constructor() {
        super();
        this.state={
            email:'',
            password:'',
            message:'',
        }
        this.handleSubmit=this.handleSubmit.bind(this);
        this.handleChangeInput=this.handleChangeInput.bind(this);
    }
    async handleChangeInput(e){
        await this.setState({[e.target.name]:e.target.value});
    }
    handleSubmit(e){
        let email=this.state;
        let password=this.state;
        if(email.length===0||password.length===0)
        {
            alert('Please fill the form')
        }
        else{
            let formData = new FormData();
            formData.append('email', email);
            formData.append('password',password);
            const config = {
                headers: { 'content-type': 'multipart/form-data' }
            }
            axios.post('login',formData,config)
                .then((res)=>{console.log(res)})
                .catch((err)=>{this.setState({message:err.response.data.message})});
        }
    }
    render() {
        return <div>

        </div>
    }
}
export default Login;

if (document.getElementById('Login')) {
    ReactDOM.render(<Login/>, document.getElementById('Login'));
}
