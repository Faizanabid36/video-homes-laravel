import React from "react";
import {Row} from "react-bootstrap";
import axios from "axios";
import GooglePlacesAutocomplete, {geocodeByAddress} from 'react-google-places-autocomplete';
// If you want to use the provided css
import 'react-google-places-autocomplete/dist/index.min.css';


export default class General extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            user: {},
            message: null,
            image: '',
            company_logo: '',
            roles: [],
            filename: '',
            company_logo_filename: '',
            role: [],
            role_cat: [],
            sub_role: 0,
            sub_role_cat: 0,
            location_latitude: '',
            location_longitude: '',
        }
        this.handleSubmit = this.handleSubmit.bind(this);
        this.handleChangeInput = this.handleChangeInput.bind(this);
        this.handleChangeRole = this.handleChangeRole.bind(this);
        this.handleChangeSubRole = this.handleChangeSubRole.bind(this)
        this.onFormSubmit = this.onFormSubmit.bind(this)
        this.onCompanyFormSubmit = this.onCompanyFormSubmit.bind(this)
        this.onChange = this.onChange.bind(this)
        this.onLogoChange = this.onLogoChange.bind(this)
    }

    handleSubmit() {
        let {user, sub_role_cat, sub_role, location_latitude, location_longitude} = this.state;
        let tab = 'general';
        axios.post('/edit_user_profile', {user, tab, sub_role_cat, sub_role, location_latitude, location_longitude})
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
    onCompanyFormSubmit(e)
    {
        e.preventDefault()
        const fd = new FormData();
        fd.append('image', this.state.company_logo);
        fd.append('filename', this.state.company_logo_filename);
        axios.post('/update_company_logo', fd)
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
      onLogoChange(e) {
        let files = e.target.files || e.dataTransfer.files;
        if (!files.length)
            return;
        this.setState({company_logo_filename: files[0].name})
        this.createLogoImage(files[0]);
        }
        createLogoImage(file) {
        let reader = new FileReader();
        reader.onload = (e) => {
            this.setState({
                company_logo: e.target.result
            })
        };
        reader.readAsDataURL(file);
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
                this.setState({user: res.data.user}, () => {
                    this.setState({
                        sub_role_cat: this.state.user.account_types.sub_role_category,
                        sub_role: this.state.user.account_types.sub_role
                    })
                })
            })
            .catch((err) => {
                console.log(err)
            })
        axios.get('account_types')
            .then((res) => {
                this.setState({roles: res.data.roles}, () => {
                    this.state.roles.map( async (item) => {
                        if (item.id == this.state.user.account_types.sub_role)
                            await this.setState({role: item.sub_roles}, async () => {
                                await this.state.role.map((i) => {
                                    if (i.children) {
                                        i.children.map(async (x) => {
                                            if (x.id == this.state.user.account_types.sub_role_category)
                                                await this.setState({role_cat: [x]})
                                        })
                                    }
                                });
                            })
                    })
                })
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

    handleChangeRole(e) {
        let {user, roles} = this.state;
        user[e.target.name] = e.target.value;
        this.setState({...user});
        roles.map(async (item) => {
            if (item.id == user.role)
                await this.setState({role: item.sub_roles, role_cat: []})
        })
        this.setState({sub_role: e.target.value})
    }

    async handleChangeSubRole(e) {
        let {role, sub_role} = this.state
        let children = [];
        await this.setState({sub_role_cat: e.target.value})
        this.state.role.map(async (item) => {
            console.log('item', item)
            if (item.id == this.state.sub_role_cat) {
                await this.setState({role_cat: item.children})
            }
        });
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
                        <label className="col-md-12" htmlFor="bio">Bio</label>
                        <div className="col-md-12">
                            <input onChange={this.handleChangeInput} id="bio" name="bio" type="text" placeholder=""
                                   className="form-control custom-vh-form-input" defaultValue={this.state.user.bio}/>
                        </div>
                    </div>
                    <div className="form-group input-form-group col-lg-6">
                        <label className="col-md-12" htmlFor="website_title">Website Title</label>
                        <div className="col-md-12">
                            <input onChange={this.handleChangeInput} id="website_title" name="website_title" type="url" placeholder=""
                                   className="form-control custom-vh-form-input" defaultValue={this.state.user.website_title}/>
                        </div>
                    </div>
                    <div className="form-group input-form-group col-lg-6">
                        <label className="col-md-12" htmlFor="website_link">Website Link</label>
                        <div className="col-md-12">
                            <input onChange={this.handleChangeInput} id="website_link" name="website_link" type="url" placeholder=""
                                   className="form-control custom-vh-form-input" defaultValue={this.state.user.website_link}/>
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
                        <label className="col-md-12" htmlFor="address">Address</label>
                        <div className="col-md-12">
                            {/*<input onChange={this.handleChangeInput} id="address" name="address" type="text"*/}
                            {/*       placeholder=""*/}
                            {/*       className="form-control custom-vh-form-input"*/}
                            {/*       defaultValue={this.state.user.address}/>*/}
                            <GooglePlacesAutocomplete
                                onSelect={({description}) => {
                                    let {user} = this.state
                                    user.address = description
                                    this.setState({user: user})
                                    geocodeByAddress(description)
                                        .then((results) => {
                                            this.setState({
                                                location_latitude: results[0].geometry.location.lat(),
                                                location_longitude: results[0].geometry.location.lng(),
                                            })
                                            console.log(results)
                                        })
                                        .catch(error => console.error(error));
                                }}
                                inputClassName="form-control custom-vh-form-input"
                            />
                        </div>
                    </div>
                    <div className="form-group input-form-group col-lg-6">
                        <label className="col-md-12" htmlFor="phone">Direct Phone</label>
                        <div className="col-md-12">
                            <input onChange={this.handleChangeInput} id="phone" name="phone" type="text" placeholder=""
                                   className="form-control custom-vh-form-input" defaultValue={this.state.user.phone}/>
                        </div>
                    </div>
                    <div className="form-group input-form-group col-lg-6">
                        <label className="col-md-12" htmlFor="phone2">Office Phone</label>
                        <div className="col-md-12">
                            <input onChange={this.handleChangeInput} id="phone2" name="phone2" type="text"
                                   placeholder=""
                                   className="form-control custom-vh-form-input" defaultValue={this.state.user.phone2}/>
                        </div>
                    </div>
                    <div className="form-group input-form-group col-lg-6">
                        <label className="col-md-12" htmlFor="liscense">License</label>
                        <div className="col-md-12">
                            <input onChange={this.handleChangeInput} id="liscense" name="liscense" type="text"
                                   placeholder=""
                                   className="form-control custom-vh-form-input" defaultValue={this.state.user.liscense}/>
                        </div>
                    </div>
                    <div className="form-group input-form-group col-lg-6">
                        <label className="col-md-12" htmlFor="gender">Role</label>
                        <div className="col-md-12">
                            <select onChange={this.handleChangeRole} id="role" name="role"
                                    className="form-control custom-vh-form-input">
                                <option value="" selected>Select An Option</option>
                                {this.state.roles.map((item, id) => {
                                    return <option
                                        key={"cat" + id}
                                        selected={this.state.user.role == item.id ? "selected" : ""}
                                        value={item.id}>{item.role}</option>
                                })}
                            </select>
                        </div>
                    </div>
                    <div className="form-group input-form-group col-lg-6">
                        <label className="col-md-12" htmlFor="gender">Role Type</label>
                        <div className="col-md-12">
                            <select onChange={this.handleChangeSubRole} id="tags" name="sub_role"
                                    className="form-control custom-vh-form-input">
                                <option value="" selected>Select An Option</option>
                                {this.state.role.length > 0 && this.state.role.map((item) => {
                                    return <option
                                        key={"role"+item}
                                        selected={this.state.user.account_types.sub_role == item.id ? "selected" : ""}
                                        value={item.id}>{item.name}</option>
                                })}
                            </select>
                        </div>
                    </div>
                    <div className="form-group input-form-group col-lg-6">
                        <label className="col-md-12" htmlFor="gender">Role Category</label>
                        <div className="col-md-12">
                            <select onChange={(e) => {
                                this.setState({sub_role_cat:e.target.value})
                            }} id="role_cat" name="role_cat"
                                    className="form-control custom-vh-form-input">
                                <option value="" selected>Select An Option</option>
                                {this.state.role_cat.map((item) => {
                                    return <option
                                        key={"sub"+item}
                                        selected={this.state.user.account_types.sub_role_category == item.id ? "selected" : ""}
                                        value={item.id}>{item.name}</option>
                                })}
                            </select>
                        </div>
                    </div>
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

                    <div className="row">

                        <div className="col-md-6">
                            <input type="file" onChange={this.onChange}/>
                        </div>

                        <div className="col-md-6">
                            <button type="submit" className="btn btn-primary">Save picture</button>
                        </div>

                    </div>
                </form>
                <br/>
                <br/>
                <hr/>
                <h3> Upload Company Logo</h3>
                <form onSubmit={this.onCompanyFormSubmit}>

                    <div className="row">

                        <div className="col-md-6">
                            <input type="file" onChange={this.onLogoChange}/>
                        </div>

                        <div className="col-md-6">
                            <button type="submit" className="btn btn-primary">Save picture</button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    }
}
