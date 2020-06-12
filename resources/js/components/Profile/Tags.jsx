import React from "react";
import {Row} from "react-bootstrap";
import axios from "axios";


class Tags extends React.Component {
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
            <div className="form-horizontal user-setting-panel pt_shadow display-shadow-box"
                 id="general-settings">
                <div className="setting-general-alert">
                    {
                        this.state.message ?
                            <div className='alert alert-info'>{this.state.message}</div> : ''
                    }
                </div>
                <Row className="custom-vh-form"></Row>
                <div className="last-sett-btn modal-footer"
                     style={{margin: '0px -30px -10px -30px'}}>
                    <button id="submit" onClick={this.handleSubmit}
                            className="btn btn-primary">
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

export default Tags;