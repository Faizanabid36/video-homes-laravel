import React from "react";
import axios from "axios";

class ChangePassword extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            user: {},
            result: '',
            password: '',
            message: null,
        }
        this.handleSubmit = this.handleSubmit.bind(this);
        this.handleChangeInput = this.handleChangeInput.bind(this);
    }

    handleSubmit() {
        let {user, password} = this.state;
        let tab = 'change-password';
        axios.post('/edit_user_profile', {user, tab, password})
            .then((res) => {
                this.setState({result: res.data.result})
            })
            .catch((err) => {
                console.log(err)
            })
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
            <div className="form-horizontal user-setting-panel pt_forms pt_shadow" id="password-settings"
                 method="POST">
                <div className="setting-password-alert">
                    {
                        this.state.message ?
                            <div className='alert alert-info'>{this.state.message}</div> : ''
                    }
                </div>
                <div className="form-group">
                    <label className="col-md-12" htmlFor="current_password">Current Passowrd</label>
                    <div className="col-md-12">
                        <input id="current_password" name="current_password" type="password" placeholder=""
                               className="form-control input-md"/>
                    </div>
                </div>
                <div className="form-group">
                    <label className="col-md-12" htmlFor="new_password">New Passowrd</label>
                    <div className="col-md-12">
                        <input id="new_password" name="new_password" type="password" placeholder=""
                               className="form-control input-md"/>
                    </div>
                </div>
                <div className="form-group">
                    <label className="col-md-12" htmlFor="confirm_new_password">Confirm new password</label>
                    <div className="col-md-12">
                        <input id="confirm_new_password" name="confirm_new_password" type="password" placeholder=""
                               className="form-control input-md"/>
                    </div>
                </div>
                <div className="last-sett-btn modal-footer" style={{margin: '0px -30px -10px -30px'}}>
                    <button id="submit" name="submit" className="btn btn-main setting-panel-mdbtn">
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
