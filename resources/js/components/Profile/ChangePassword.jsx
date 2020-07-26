import React from "react";
import axios from "axios";

class ChangePassword extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            user: {},
            password: '',
            new_password: '',
            confirm_new_password: '',
            message: null,
        }
        this.handleSubmit = this.handleSubmit.bind(this);
        this.handleChangeInput = this.handleChangeInput.bind(this);
    }
    handleSubmit() {
        let {user, password, new_password, confirm_new_password} = this.state;
        let tab = 'change-password';
        if (new_password == confirm_new_password) {
            axios.post('/edit_user_profile', {user, tab, password, new_password, confirm_new_password})
                .then((res) => {
                    this.setState({message: res.data.message})
                })
                .catch((err) => {
                    console.log(err)
                })
        } else {
            this.setState({message: 'Passwords Does Not Match'})
        }
    }

    componentDidMount() {
        axios.get('get_logged_user')
            .then((res) => {
                this.setState({user: res.data.user})
            })
            .catch((err) => {
                console.log(err)
            })
    }

    async handleChangeInput(e) {
        await this.setState({[e.target.name]: e.target.value});
    }

    render() {

        return <div className="col-md-7 pt_sett_mani_page">
            <div className="custom-vh-form form-horizontal user-setting-panel pt_shadow display-shadow-box"
                 id="password-settings">
                <div className="setting-password-alert">
                    {
                        this.state.message ?
                            <div className='alert alert-info'>{this.state.message}</div> : ''
                    }
                </div>
                <div className="form-group">
                    <label className="col-md-12" htmlFor="password">Current Passowrd</label>
                    <div className="col-md-12">
                        <input required id="password" onChange={this.handleChangeInput} name="password" type="password"
                               placeholder=""
                               className="form-control custom-vh-form-input input-md"/>
                    </div>
                </div>
                <div className="form-group">
                    <label className="col-md-12" htmlFor="new_password">New Password</label>
                    <div className="col-md-12">
                        <input id="new_password" onChange={this.handleChangeInput} name="new_password" type="password"
                               placeholder=""
                               className="form-control custom-vh-form-input input-md"/>
                    </div>
                </div>
                <div className="form-group">
                    <label className="col-md-12" htmlFor="confirm_new_password">Confirm Password</label>
                    <div className="col-md-12">
                        <input id="confirm_new_password" onChange={this.handleChangeInput} name="confirm_new_password"
                               type="password" placeholder=""
                               className="form-control custom-vh-form-input input-md"/>
                    </div>
                </div>
                <div className="last-sett-btn modal-footer" style={{margin: '0px -30px -10px -30px'}}>
                    <button id="submit" onClick={this.handleSubmit} className="btn btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                             fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round"
                             strokeLinejoin="round" className="feather feather-check-circle">
                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                            <polyline points="22 4 12 14.01 9 11.01"></polyline>
                        </svg>
                        Save
                    </button>
                </div>
            </div>
        </div>
    }
}

export default ChangePassword;
