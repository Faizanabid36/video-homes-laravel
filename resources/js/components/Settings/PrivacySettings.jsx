import {Button, Carousel, Col, Row, Container, Form} from "react-bootstrap";
import React from "react";
import axios from "axios";

class PrivacySettings extends React.Component {
    constructor() {
        super();
        this.state = {
            message: '',
            whoWatches: '',
            whoComments: '',
            whoShares: '',
            tab: 'privacy-settings',
        }
        this.handleChangeInput = this.handleChangeInput.bind(this);
        this.handleSubmit = this.handleSubmit.bind(this);
    }

    handleSubmit(e) {
        let {whoWatches, whoComments, whoShares, tab} = this.state
        if (whoWatches.length == 0 && whoComments.length == 0 && whoShares.length == 0) {
            this.setState({message: 'Invalid Settings'});
            return;
        }
        axios.post('/user_settings', {whoWatches, whoComments, whoShares, tab})
            .then((res) => {
                this.setState({message: res.data.message})
            })
            .catch((err) => {
                console.log(err)
            })
    }

    async handleChangeInput(e) {
        await this.setState({[e.target.name]: e.target.value})
    }

    render() {
        return <div className="col-md-7 pt_sett_mani_page">
            <div className="form-horizontal user-setting-panel pt_forms pt_shadow" id="delete-settings">
                <div className="setting-delete-alert">
                    {
                        this.state.message ?
                            <div className='alert alert-info'>{this.state.message}</div> : ''
                    }
                </div>
                <div className="form-group">
                    <label className="col-md-12" htmlFor="whoWatches">Who Can See my Videos</label>
                    <div className="col-md-12">
                        <select onChange={this.handleChangeInput} id="whoWatches"
                                name="whoWatches"
                                className="form-control">
                            <option defaultValue=""></option>
                            <option defaultValue="everyone">Everyone</option>
                            <option defaultValue="subscribers">Subscribers</option>
                            <option defaultValue="only me">Only Me</option>
                        </select>
                    </div>
                </div>
                <div className="form-group">
                    <label className="col-md-12" htmlFor="whoComments">Who Can Post Comments</label>
                    <div className="col-md-12">
                        <select onChange={this.handleChangeInput} id="whoComments"
                                name="whoComments"
                                className="form-control">
                            <option defaultValue=""></option>
                            <option defaultValue="everyone">Everyone</option>
                            <option defaultValue="subscribers">Subscribers</option>
                            <option defaultValue="only me">Only Me</option>
                        </select>
                    </div>
                </div>
                <div className="form-group">
                    <label className="col-md-12" htmlFor="whoShares">Who Can Share Videos</label>
                    <div className="col-md-12">
                        <select onChange={this.handleChangeInput} id="whoShares"
                                name="whoShares"
                                className="form-control">
                            <option defaultValue=""></option>
                            <option defaultValue="everyone">Everyone</option>
                            <option defaultValue="subscribers">Subscribers</option>
                            <option defaultValue="only me">Only Me</option>
                        </select>
                    </div>
                </div>
                <div className="last-sett-btn modal-footer" style={{margin: '0px -30px -10px -30px'}}>
                    <Button id="submit" onClick={this.handleSubmit} className="btn btn-main setting-panel-mdbtn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                             fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round"
                             strokeLinejoin="round" className="feather feather-check-circle">
                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                            <polyline points="22 4 12 14.01 9 11.01"></polyline>
                        </svg>
                        Save Settings
                    </Button>
                </div>
            </div>
        </div>
    }
}

export default PrivacySettings;
