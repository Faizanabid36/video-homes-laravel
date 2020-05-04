import {Button} from "react-bootstrap";
import React from "react";
import axios from "axios";
import {Dropdown} from "semantic-ui-react";
import 'semantic-ui-css/semantic.min.css'

class BlockUser extends React.Component {
    constructor() {
        super();
        this.state = {
            message: '',
            searchField: '',
            selectedValue: '',
            userOptions: [],
            tab: 'block-user'
        }
        this.handleSearchUser = this.handleSearchUser.bind(this);
        this.handleSubmit = this.handleSubmit.bind(this);
        this.handleChangeInput = this.handleChangeInput.bind(this);
    }

    handleSubmit(e) {
        let {selectedValue, tab} = this.state
        axios.post('user_settings', {selectedValue, tab})
            .then((res) => {
                this.setState({message: res.data.message})
            })
            .catch((err) => {
                console.log(err)
            })
    }

    async handleChangeInput(e) {
        e.preventDefault();
        let text = await e.target.innerText;
        await this.setState({selectedValue: text})
    }

    async handleSearchUser(value, e) {
        await this.setState({searchField: value})
        let {searchField} = await this.state;
        await axios.post('search_to_block_user', {searchField})
            .then((res) => {
                this.setState({userOptions: res.data.userOptions})
            })
            .catch((err) => {
                console.log(err)
            })
    }

    componentDidMount() {

    }

    render() {
        let {userOptions} = this.state;
        return <div className="col-md-7 pt_sett_mani_page">
            <div className="form-horizontal user-setting-panel pt_forms pt_shadow" id="delete-settings">
                <div className="setting-delete-alert">
                    {
                        this.state.message ?
                            <div className='alert alert-info'>{this.state.message}</div> : ''
                    }
                </div>
                <div className="form-group">
                    <label className="col-md-12" htmlFor="searchField">Search Username</label>
                    <div className="col-md-12">
                        <Dropdown
                            placeholder="Search User"
                            search
                            selection
                            name='selectedValue'
                            onSearchChange={(e) => {
                                e.preventDefault();
                                this.handleSearchUser(e.target.value)
                            }}
                            onChange={this.handleChangeInput}
                            value={this.state.selectedValue}
                            options={userOptions}
                        />
                    </div>
                </div>
                <div className="last-sett-btn modal-footer" style={{margin: '0px -30px -10px -30px'}}>
                    <Button id="submit" onClick={this.handleSubmit} className="btn btn-danger setting-panel-mdbtn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                             fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round"
                             strokeLinejoin="round" className="feather feather-check-circle">
                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                            <polyline points="22 4 12 14.01 9 11.01"></polyline>
                        </svg>
                        Block
                    </Button>
                </div>
            </div>
        </div>
    }
}

export default BlockUser;
