import { Button, Carousel, Col, Row, Container, Form, InputGroup, FormControl, Modal } from "react-bootstrap";
import React from "react";
import axios from "axios";
import General from "./Profile/General";
import Videos from "./Videos/Videos";
import DeleteAccount from "./Profile/DeleteAccount";
import ChangePassword from "./Profile/ChangePassword";
import Tags from "./Profile/Tags";
import GooglePlacesAutocomplete, { geocodeByAddress } from "react-google-places-autocomplete";
import Avatar from 'react-avatar-edit';

function UploadImage(props) {
    return (
        <Modal
            {...props}
            size="lg"
            aria-labelledby="contained-modal-title-vcenter"
            centered
        >
            <Modal.Header closeButton>
                <Modal.Title id="contained-modal-title-vcenter">
                    {props.title}
                </Modal.Title>
            </Modal.Header>
            <Modal.Body>
                <Avatar
                    width={390}
                    height={295}
                    src={props.src}
                />
            </Modal.Body>
        </Modal>
    );
}

class Profile extends React.Component {
    constructor(props) {
        super(...arguments);
        this.state = {
            user: {},
            tab: 'general',
            profile_preview: null,
            company_logo_preview: null,
        };
        this.handleChangeInput = this.handleChangeInput.bind(this)
        this.onCrop = this.onCrop.bind(this)
        this.onClose = this.onClose.bind(this)
    }

    onClose() {
        this.setState({preview: null})
    }

    onCrop(preview) {
        this.setState({preview})
    }

    componentDidMount() {
        axios.get('get_logged_user').then((res) => {
            this.setState({user: res.data.user})
        });
    }

    renderTemplate() {
        switch (this.state.tab) {
            case 'delete-account':
                return <DeleteAccount/>;
            case 'change-password':
                return <ChangePassword/>;

            default:
                return <General/>
        }
    }

    handleChangeInput(e) {
        let {user} = this.state;
        user[e.target.name] = e.target.value;
        this.setState({...user});
    }

    defaultValue(key) {
        return this.state.user[key];
    }

    render() {
        return <>
            {/*<Container className="main-content">*/}
            {/*    <div id="container_content">*/}
            {/*        <Row>*/}
            {/*            <div className="col-md-3">*/}
            {/*                <div className="settings-sidebar display-shadow-box">*/}
            {/*                    <ul className="list-group">*/}
            {/*                        <li className="list-group-item"*/}
            {/*                            className={this.state.tab == 'general' ? 'list-group-item active' : 'list-group-item'}>*/}
            {/*                            <a onClick={(e) => {*/}
            {/*                                e.preventDefault();*/}
            {/*                                this.setState({tab: 'general'})*/}
            {/*                            }}>*/}
            {/*                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"*/}
            {/*                                     viewBox="0 0 24 24">*/}
            {/*                                    <path fill="#4CAF50"*/}
            {/*                                          d="M12,15.5A3.5,3.5 0 0,1 8.5,12A3.5,3.5 0 0,1 12,8.5A3.5,3.5 0 0,1 15.5,12A3.5,3.5 0 0,1 12,15.5M19.43,12.97C19.47,12.65 19.5,12.33 19.5,12C19.5,11.67 19.47,11.34 19.43,11L21.54,9.37C21.73,9.22 21.78,8.95 21.66,8.73L19.66,5.27C19.54,5.05 19.27,4.96 19.05,5.05L16.56,6.05C16.04,5.66 15.5,5.32 14.87,5.07L14.5,2.42C14.46,2.18 14.25,2 14,2H10C9.75,2 9.54,2.18 9.5,2.42L9.13,5.07C8.5,5.32 7.96,5.66 7.44,6.05L4.95,5.05C4.73,4.96 4.46,5.05 4.34,5.27L2.34,8.73C2.21,8.95 2.27,9.22 2.46,9.37L4.57,11C4.53,11.34 4.5,11.67 4.5,12C4.5,12.33 4.53,12.65 4.57,12.97L2.46,14.63C2.27,14.78 2.21,15.05 2.34,15.27L4.34,18.73C4.46,18.95 4.73,19.03 4.95,18.95L7.44,17.94C7.96,18.34 8.5,18.68 9.13,18.93L9.5,21.58C9.54,21.82 9.75,22 10,22H14C14.25,22 14.46,21.82 14.5,21.58L14.87,18.93C15.5,18.67 16.04,18.34 16.56,17.94L19.05,18.95C19.27,19.03 19.54,18.95 19.66,18.73L21.66,15.27C21.78,15.05 21.73,14.78 21.54,14.63L19.43,12.97Z"></path>*/}
            {/*                                </svg>*/}
            {/*                                General</a>*/}
            {/*                        </li>*/}
            {/*                        <li className={this.state.tab == 'change-password' ? 'list-group-item active' : 'list-group-item'}>*/}
            {/*                            <a onClick={(e) => {*/}
            {/*                                e.preventDefault();*/}
            {/*                                this.setState({tab: 'change-password'})*/}
            {/*                            }}>*/}
            {/*                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"*/}
            {/*                                     viewBox="0 0 24 24">*/}
            {/*                                    <path fill="#176764"*/}
            {/*                                          d="M12.63,2C18.16,2 22.64,6.5 22.64,12C22.64,17.5 18.16,22 12.63,22C9.12,22 6.05,20.18 4.26,17.43L5.84,16.18C7.25,18.47 9.76,20 12.64,20A8,8 0 0,0 20.64,12A8,8 0 0,0 12.64,4C8.56,4 5.2,7.06 4.71,11H7.47L3.73,14.73L0,11H2.69C3.19,5.95 7.45,2 12.63,2M15.59,10.24C16.09,10.25 16.5,10.65 16.5,11.16V15.77C16.5,16.27 16.09,16.69 15.58,16.69H10.05C9.54,16.69 9.13,16.27 9.13,15.77V11.16C9.13,10.65 9.54,10.25 10.04,10.24V9.23C10.04,7.7 11.29,6.46 12.81,6.46C14.34,6.46 15.59,7.7 15.59,9.23V10.24M12.81,7.86C12.06,7.86 11.44,8.47 11.44,9.23V10.24H14.19V9.23C14.19,8.47 13.57,7.86 12.81,7.86Z"></path>*/}
            {/*                                </svg>*/}
            {/*                                Change Password</a>*/}
            {/*                        </li>*/}

            {/*                        <li className={this.state.tab === 'delete-account' ? 'list-group-item active' : 'list-group-item'}>*/}
            {/*                            <a onClick={(e) => {*/}
            {/*                                e.preventDefault();*/}
            {/*                                this.setState({tab: 'delete-account'})*/}
            {/*                            }}>*/}
            {/*                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"*/}
            {/*                                     viewBox="0 0 24 24">*/}
            {/*                                    <path fill="#f44336"*/}
            {/*                                          d="M19,4H15.5L14.5,3H9.5L8.5,4H5V6H19M6,19A2,2 0 0,0 8,21H16A2,2 0 0,0 18,19V7H6V19Z"></path>*/}
            {/*                                </svg>*/}
            {/*                                Delete account</a>*/}
            {/*                        </li>*/}
            {/*                    </ul>*/}
            {/*                </div>*/}
            {/*            </div>*/}
            {/*            <div className="col-md-9">*/}
            {/*                {this.renderTemplate()}*/}
            {/*            </div>*/}
            {/*        </Row>*/}
            {/*    </div>*/}


            {/*</Container>*/}

            <Container fluid>
                <Row>
                    <Col md={6}>
                        <Form.Group controlId="exampleForm.ControlInput1">
                            <Form.Label>Name</Form.Label>
                            <Form.Control name="name" onChange={this.handleChangeInput}
                                          defaultValue={this.defaultValue('name')} type="text" placeholder="Your Name"/>
                        </Form.Group>
                    </Col>
                    <Col md={6}>
                        <Form.Group controlId="exampleForm.ControlInput1">
                            <label htmlFor="basic-url">Personal URL</label>
                            <InputGroup className="mb-3">
                                <InputGroup.Prepend>
                                    <InputGroup.Text id="basic-addon3">
                                        {window.VIDEO_APP.base_url}/u/
                                    </InputGroup.Text>
                                </InputGroup.Prepend>
                                <FormControl name='username' onChange={this.handleChangeInput}
                                             defaultValue={this.defaultValue('username')} id="basic-url"
                                             aria-describedby="basic-addon3"/>
                            </InputGroup>
                        </Form.Group>
                    </Col>
                </Row>
                <Row>
                    <Col md={6}>
                        <Form.Group controlId="exampleForm.ControlInput1">
                            <Form.Label>Direct Phone</Form.Label>
                            <Form.Control name='direct_phone' onChange={this.handleChangeInput}
                                          defaultValue={this.defaultValue('direct_phone')} type="tel"
                                          placeholder="(888) 888-8888"/>
                        </Form.Group>
                    </Col>
                    <Col md={6}>
                        <Form.Group controlId="exampleForm.ControlInput1">
                            <Form.Label>Company Name</Form.Label>
                            <Form.Control name='company_name' onChange={this.handleChangeInput}
                                          defaultValue={this.defaultValue('company_name')} type="text"
                                          placeholder="Your Company Name"/>
                        </Form.Group>
                    </Col>

                </Row>
                <Row>
                    <Col md={6}>
                        <Form.Group controlId="exampleForm.ControlInput1">
                            <Form.Label>Address</Form.Label>
                            <GooglePlacesAutocomplete
                                onSelect={({address}) => {
                                    geocodeByAddress(address)
                                        .then((results) => {
                                            let {user} = this.state;
                                            let {address, location_latitude, location_longitude} = user;
                                            location_latitude = results[0].geometry.location.lat();
                                            location_longitude = results[0].geometry.location.lng();
                                            address = address;
                                            this.setState(user);
                                            console.log(results, address)
                                        })
                                        .catch(error => console.error(error));
                                }}
                                inputClassName="form-control custom-vh-form-input"
                            />
                        </Form.Group>
                    </Col>
                    <Col md={6}>
                        <Form.Group controlId="exampleForm.ControlInput1">
                            <Form.Label>Office Phone</Form.Label>
                            <Form.Control name='office_phone' onChange={this.handleChangeInput}
                                          defaultValue={this.defaultValue('office_phone')} type="tel"
                                          placeholder="(888) 888-8888"/>
                        </Form.Group>
                    </Col>
                </Row>
                <Row>
                    <Col md={6}>
                        <Form.Group controlId="exampleForm.ControlInput1">
                            <Form.Label>Website</Form.Label>
                            <Form.Control name='website' onChange={this.handleChangeInput}
                                          defaultValue={this.defaultValue('website')} type="text"
                                          placeholder="https://yourdomain.com"/>
                        </Form.Group>
                    </Col>
                    <Col md={6}>
                        <Form.Group controlId="exampleForm.ControlInput1">
                            <Form.Label>License</Form.Label>
                            <Form.Control name='license' onChange={this.handleChangeInput}
                                          defaultValue={this.defaultValue('license')} type="text"
                                          placeholder="#######"/>
                        </Form.Group>
                    </Col>
                </Row>
                <Row>
                    <Col md={4}>
                        <Form.Group controlId="exampleForm.ControlInput1">
                            <label htmlFor="basic-url">Facebook</label>
                            <InputGroup className="mb-3">
                                <InputGroup.Prepend>
                                    <InputGroup.Text id="basic-addon3">
                                        https://www.facebook.com/
                                    </InputGroup.Text>
                                </InputGroup.Prepend>
                                <FormControl name='facebook' onChange={this.handleChangeInput}
                                             defaultValue={this.defaultValue('facebook')} id="basic-url"
                                             aria-describedby="basic-addon3"/>
                            </InputGroup>
                        </Form.Group>
                    </Col>
                    <Col md={4}>
                        <Form.Group controlId="exampleForm.ControlInput1">
                            <label htmlFor="basic-url">Instagram</label>
                            <InputGroup className="mb-3">
                                <InputGroup.Prepend>
                                    <InputGroup.Text id="basic-addon3">
                                        https://www.instagram.com/
                                    </InputGroup.Text>
                                </InputGroup.Prepend>
                                <FormControl name='instagram' onChange={this.handleChangeInput}
                                             defaultValue={this.defaultValue('instagram')} id="basic-url"
                                             aria-describedby="basic-addon3"/>
                            </InputGroup>
                        </Form.Group>
                    </Col>
                    <Col md={4}>
                        <Form.Group controlId="exampleForm.ControlInput1">
                            <label htmlFor="basic-url">Youtube</label>
                            <InputGroup className="mb-3">
                                <InputGroup.Prepend>
                                    <InputGroup.Text id="basic-addon3">
                                        https://www.youtube.com/
                                    </InputGroup.Text>
                                </InputGroup.Prepend>
                                <FormControl name='youtube' onChange={this.handleChangeInput}
                                             defaultValue={this.defaultValue('youtube')} id="basic-url"
                                             aria-describedby="basic-addon3"/>
                            </InputGroup>
                        </Form.Group>
                    </Col>
                </Row>
                <Row><Col>
                    <Form.Group controlId="exampleForm.ControlTextarea1">
                        <Form.Label>About/Bio (Max 600 words)</Form.Label>
                        <Form.Control as="textarea" rows="3" defaultValue={this.defaultValue('bio')}
                                      onChange={this.handleChangeInput}/>
                    </Form.Group>
                </Col></Row>
                <Row>
                    <Col md={6}>
                        <h4>Profile Picture</h4>
                        <UploadImage src={this.defaultValue('profile_picture')} show={this.state.profile_preview}
                                     onHide={() => this.setState({profile_preview: !this.state.profile_preview})}/>
                         <Button onChange={()=>this.setState({profile_preview:!this.state.profile_preview})}>Upload Profile Picture</Button>
                    </Col>
                    <Col md={6}>
                        <h4>Company Logo</h4>

                    </Col>
                </Row>
            </Container>
        </>


    }
}

export default Profile;
