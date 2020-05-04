import React from "react";
import {Row} from "react-bootstrap";
import axios from "axios";

class General extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            user: {},
            message: null,
        }
        this.handleSubmit = this.handleSubmit.bind(this);
        this.handleChangeInput = this.handleChangeInput.bind(this);
    }

    handleSubmit() {
        let {user} = this.state;
        let tab = 'general';
        axios.post('/edit_user_profile', {user, tab})
            .then((res) => {
                this.setState({message: res.data.message})
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

    handleChangeInput(e) {
        let {user} = this.state;
        user[e.target.name] = e.target.value;
        this.setState({...user});
    }

    render() {
        return <div className="col-md-7 pt_sett_mani_page">
            <div className="form-horizontal user-setting-panel pt_forms pt_shadow"
                 id="general-settings" method="POST">
                <div className="setting-general-alert">
                    {
                        this.state.message ?
                            <div className='alert alert-info'>{this.state.message}</div> : ''
                    }
                </div>
                <Row>
                    <div className="form-group col-lg-6">
                        <label className="col-md-12" htmlFor="name">Name</label>
                        <div className="col-md-12">
                            <input onChange={this.handleChangeInput} id="name" name="name" type="text" placeholder=""
                                   className="form-control input-md" defaultValue={this.state.user.name}/>
                        </div>
                    </div>
                    <div className="form-group col-lg-6">
                        <label className="col-md-12" htmlFor="username">Username</label>
                        <div className="col-md-12">
                            <input onChange={this.handleChangeInput} id="username" name="username" type="text"
                                   placeholder=""
                                   className="form-control input-md" defaultValue={this.state.user.username}/>
                        </div>
                    </div>
                    <div className="form-group col-lg-6">
                        <label className="col-md-12" htmlFor="email">E-mail address</label>
                        <div className="col-md-12">
                            <input onChange={this.handleChangeInput} id="email" name="email" type="text" placeholder=""
                                   className="form-control input-md" defaultValue={this.state.user.email}/>
                        </div>
                    </div>
                    <div className="form-group col-lg-6">
                        <label className="col-md-12" htmlFor="gender">Gender</label>
                        <div className="col-md-12">
                            <select onChange={this.handleChangeInput} id="gender" defaultValue={this.state.user.gender}
                                    name="gender"
                                    className="form-control">
                                <option defaultValue="male">Male</option>
                                <option defaultValue="female">Female</option>
                            </select>
                        </div>
                    </div>
                    <div className="form-group col-lg-6">
                        <label className="col-md-12" htmlFor="gender">Role</label>
                        <div className="col-md-12">
                            <select onChange={this.handleChangeInput} id="role" name="role"
                                    defaultValue={this.state.user.role} className="form-control">
                                <option defaultValue="2">Realtor</option>
                                <option defaultValue="3">Video Provider</option>
                            </select>
                        </div>
                    </div>
                    <div className="clear"></div>
                    <hr/>
                </Row>
                <div className="last-sett-btn modal-footer"
                     style={{margin: '0px -30px -10px -30px'}}>
                    <button id="submit" onClick={this.handleSubmit}
                            className="btn btn-main setting-panel-mdbtn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                             viewBox="0 0 24 24" fill="none" stroke="currentColor"
                             strokeWidth="2" strokeLinecap="round" strokeLinejoin="round"
                             className="feather feather-check-circle">
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

export default General;
