import React from "react";
import {Row} from "react-bootstrap";
import axios from "axios";

class General extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            user: {},
            message: null,
            image: '',
            account_types: [],
            filename: '',
        }
        this.handleSubmit = this.handleSubmit.bind(this);
        this.handleChangeInput = this.handleChangeInput.bind(this);
        this.onFormSubmit = this.onFormSubmit.bind(this)
        this.onChange = this.onChange.bind(this)
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
    onFormSubmit(e) {
        e.preventDefault()
        const fd = new FormData();
        fd.append('image', this.state.image);
        fd.append('filename', this.state.filename);
        axios.post('/image-upload', fd)
            .then((res) => {
                console.log('res', res)
                window.location.reload();
            })
            .catch((err) => {
                console.log(err)
            })
    }
      onChange(e) {
        let files = e.target.files || e.dataTransfer.files;
        if (!files.length)
              return;
          this.setState({filename: files[0].name})
          this.createImage(files[0]);
      }
      createImage(file) {
        let reader = new FileReader();
        reader.onload = (e) => {
          this.setState({
            image: e.target.result
          })
        };
        reader.readAsDataURL(file);
      }

    componentDidMount() {
        axios.get('get_logged_user') 
            .then((res) => {
                this.setState({user: res.data.user})
            })
            .catch((err) => {
                console.log(err)
            })
        axios.get('account_types')
            .then((res) => {
                this.setState({account_types: res.data.account_types})
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
                <Row className="custom-vh-form">
                    <div className="form-group input-form-group col-lg-6">
                        <label className="col-md-12" htmlFor="name">Name</label>
                        <div className="col-md-12">
                            <input onChange={this.handleChangeInput} id="name" name="name" type="text" placeholder=""
                                   className="form-control custom-vh-form-input" defaultValue={this.state.user.name}/>
                        </div>
                    </div>
                    <div className="form-group input-form-group col-lg-6">
                        <label className="col-md-12" htmlFor="username">Username</label>
                        <div className="col-md-12">
                            <input onChange={this.handleChangeInput} id="username" name="username" type="text"
                                   placeholder=""
                                   className="form-control custom-vh-form-input" defaultValue={this.state.user.username}/>
                        </div>
                    </div>
                    <div className="form-group input-form-group col-lg-6">
                        <label className="col-md-12" htmlFor="email">E-mail address</label>
                        <div className="col-md-12">
                            <input onChange={this.handleChangeInput} id="email" name="email" type="text" placeholder=""
                                   className="form-control custom-vh-form-input" defaultValue={this.state.user.email}/>
                        </div>
                    </div>
                    <div className="form-group input-form-group col-lg-6">
                        <label className="col-md-12" htmlFor="gender">Gender</label>
                        <div className="col-md-12">
                            <select onChange={this.handleChangeInput} id="gender" defaultValue={this.state.user.gender}
                                    name="gender"
                                    className="form-control custom-vh-form-input">
                                <option defaultValue="male">Male</option>
                                <option defaultValue="female">Female</option>
                            </select>
                        </div>
                    </div>
                    <div className="form-group input-form-group col-lg-6">
                        <label className="col-md-12" htmlFor="gender">Role</label>
                        <div className="col-md-12">
                            <select onChange={this.handleChangeInput} id="role" name="role"
                                    defaultValue={this.state.user.role} className="form-control custom-vh-form-input">
                                <option value="2">Realtor</option>
                                <option value="3">Video Provider</option>
                            </select>
                        </div>
                    </div>
                    {this.state.user.role == 3 ? <div className="form-group input-form-group col-lg-6">
                            <label className="col-md-12" htmlFor="gender">Account Type</label>
                            <div className="col-md-12">
                                <select onChange={this.handleChangeInput} id="tags" name="tags"
                                        className="form-control custom-vh-form-input">
                                    {this.state.account_types.map((item) => {
                                        return <option value={item.id}>{item.tag_name}</option>
                                    })}

                                </select>
                            </div>
                        </div> :
                        <div></div>}
                    <div className="clear"></div>
                    <hr/>

                </Row>
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
                <hr/>
                <h3> Upload Profile Picture</h3>
                <form onSubmit={this.onFormSubmit}>

                    <div class="row">

                        <div class="col-md-6">
                            <input type="file" onChange={this.onChange}/>
                        </div>

                        <div class="col-md-6">
                            <button type="submit" class="btn btn-primary">Save picture</button>
                        </div>

                    </div>
                </form>


            </div>


        </div>
    }
}

export default General;
