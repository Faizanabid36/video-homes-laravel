import React from "react";
import {Modal, Button, Col, Row, Container, Alert} from "react-bootstrap";
import axios from "axios";
import Alerts from './Alerts';
export default class Playlist extends React.Component {


    constructor(props) {
        super(props);
        this.state = {
            playlists: [{}],
            message: null,
            deleted: 0,
            mainPage: true,
            addPlaylist: false,
            editPlaylist: false,
            description: '',
            name: '',
            id: -1,
            added: 0,
            purpose: '',
            showAlert : false ,
            AlertMessage:'',
            Alertvariant: '' ,
        }
        this.handleSubmit = this.handleSubmit.bind(this);
        this.handleChangeInput = this.handleChangeInput.bind(this);
        this.handleDelete = this.handleDelete.bind(this);
        this.getPlaylist = this.getPlaylist.bind(this);
    }

    getPlaylist() {
        axios.get('all_playlists')
            .then((res) => {
                this.setState({playlists: res.data.playlists})
            })
            .catch((err) => {
                console.log(err)
            })
    }

    handleDelete(id, e) {
        let {playlists} = this.state;
        if (playlists.length <= 1) {
            // alert('You should have atleast one playlist');
            this.setState({showAlert:true , variant:'warning' , AlertMessage:'You should have atleast one playlist'}) ;

            
            return;
        } else {
            axios.post('/delete_playlist', {id})
                .then((res) => {
                    this.setState({deleted: res.data.deleted})
                    this.getPlaylist()
                    if (this.state.deleted)
                        // alert()
                        this.setState({showAlert:true , variant:'danger', AlertMessage:'Playlist Deleted'}) ;
                })
                .catch((err) => {
                    console.log(err)
                })
        }
    }

    handleSubmit(e) {
        let {name, description, purpose, id} = this.state;
        if (name.length <= 0) {
            // alert('Name Cannot Be Null');
            this.setState({showAlert:true, variant:'warning' , AlertMessage:'Name Cannot Be Null'}) ;

            return;
        }
        axios.post('update_playlist', {name, description, purpose, id})
            .then((res) => {
                this.setState({added: res.data.added, mainPage: true, addPlaylist: false, editPlaylist: false,})
                this.getPlaylist()
                if (this.state.added){

                    this.setState({showAlert:true, variant:'primary' , AlertMessage:'Setting Saved'}) ;
                 
                }
                else
                    // alert('Some Error Occured')
                    this.setState({showAlert:true , variant:'danger', AlertMessage:'Some Error Occured'}) ;

            })
            .catch((err) => {
                console.log(err)
            })
    }

    handleChangeInput() {

    }

    componentDidMount() {
        this.getPlaylist()
    }

    render() {
        return <div className='container-fluid m-0 p-0  playlistContainer   main-content' id='main-container'>
            <div className="user-setting-panel pt_shadow">
                <div className="">
                    <div className="upload-head">
                        <h4 className="pt_mn_page_hd">
                            {/* <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24">
                                <path fill="currentColor" className="svg1"
                                      d="M19,9H2V11H19V9M19,5H2V7H19V5M2,15H15V13H2V15M17,13V19L22,16L17,13Z"></path>
                            </svg> */}
                           <h1 className="">  PLAYLIST </h1>
                        </h4>
                       
                       <Alerts data={{ show: this.state.showAlert , variant : this.state.variant , message: this.state.AlertMessage   }} />
                       
                        <div className="clear"></div>
                        <hr/>
                    </div>

                    <div className="upload-head">
                        <h2>Manage My Playlist <div className="borderBottom"  /> </h2>
                        <hr/>
                        <div className="clear"></div>
                    </div>
                    {this.state.mainPage && this.state.playlists.map((item, id) => {
                        return <div key={id} id={`playlist${id}`} className="subscriptions-list">
                            <div className="author-list">
                                <div className="video-wrapper" data-id="6" id="video-6">
                                    <div className="video-actions vid_stud_acts">
                                        <a onClick={(e) => {
                                            e.preventDefault();
                                            this.setState({
                                                mainPage: false,
                                                addPlaylist: true,
                                                purpose: 'add',
                                                editPlaylist: false
                                            })
                                        }} title="Add playlist">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36"  className="addplaylistIcon"
                                                 viewBox="0 0 24 24">
                                                <path fill="currentColor"
                                                      d="M19,9H2V11H19V9M19,5H2V7H19V5M2,15H15V13H2V15M17,13V19L22,16L17,13Z"></path>
                                            </svg>
                                        </a>
                                        <a onClick={(e) => {
                                            e.preventDefault();
                                            this.setState({
                                                mainPage: false,
                                                addPlaylist: false,
                                                purpose: 'edit',
                                                editPlaylist: true,
                                                name: item.name,
                                                description: item.description,
                                                id: item.id,
                                            })
                                        }}
                                           title="Edit playlist">
                                            <svg className="feather-Edit" xmlns="http://www.w3.org/2000/svg" width="36"
                                                 height="36"
                                                 viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2"
                                                 strokeLinecap="round" strokeLinejoin="round" aria-hidden="true">
                                                <polygon points="14 2 18 6 7 17 3 17 3 13 14 2"></polygon>
                                                <line x1="3" y1="22" x2="21" y2="22"></line>
                                            </svg>
                                        </a>
                                        <a onClick={(e) => {
                                            e.preventDefault();
                                            this.handleDelete(item.id, e)
                                        }} title="Delete video">
                                            <svg className="feather-Delete" xmlns="http://www.w3.org/2000/svg" width="36"
                                                 height="36"
                                                 viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2"
                                                 strokeLinecap="round" strokeLinejoin="round" aria-hidden="true">
                                                <polyline points="3 6 5 6 21 6"></polyline>
                                                <path
                                                    d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                                <line x1="10" y1="11" x2="10" y2="17"></line>
                                                <line x1="14" y1="11" x2="14" y2="17"></line>
                                            </svg>
                                        </a>
                                    </div>
                                    <Row>
                                        <div className="video-thumb col-md-3">
                                            <h3>{item.name}</h3>
                                        </div>
                                        <div className="video-info col-md-5 no-padding-left">
                                            <div className="video-desc"></div>
                                        </div>
                                    </Row>
                                    <div className="clear"></div>
                                </div>
                            </div>
                        </div>
                    })}
                    {this.state.addPlaylist ? <div>
                        <div className='author-list'>
                            <div className="video-wrapper" data-id="6" id="video-6">
                                <div className="video-actions vid_stud_acts">
                                    <a onClick={this.handleSubmit} title="Add ">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36"
                                        className="addplaylistIcon"
                                             viewBox="0 0 24 24">
                                            <path fill="currentColor"
                                                  d="M2,16H10V14H2M18,14V10H16V14H12V16H16V20H18V16H22V14M14,6H2V8H14M14,10H2V12H14V10Z"></path>
                                        </svg>
                                    </a>
                                    <a onClick={(e) => {
                                        e.preventDefault();
                                        this.setState({mainPage: true, addPlaylist: false, purpose: ''})
                                    }} title='Cancel'>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36"
                                             viewBox="0 0 24 24">
                                            <path fill="#e91e63"
                                                  d="M13,9H11V7H13M13,17H11V11H13M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2Z"></path>
                                        </svg>
                                    </a>
                                </div>
                                <Row>
                                    <div className="video-thumb col-md-3">
                                        <h3>Add New <br/>Playlist</h3>
                                    </div>
                                    <div className="video-info col-md-5 no-padding-left">
                                        <div className='video-title'>
                                            <div className="col-md-4">
                                                <input onChange={(e) => {
                                                    this.setState({name: e.target.value})
                                                    this.setState({ showAlert: false })
                                                }} name="name" type="text" placeholder="Enter Name"
                                                       defaultValue={this.state.name}
                                                       className="form-control input-md"/>
                                            </div>
                                            <div className="col-md-8">
                                                <input onChange={(e) => {
                                                    this.setState({description: e.target.value})
                                                }} name="description" type="text" placeholder="Description"
                                                       defaultValue={this.state.description}
                                                       className="form-control input-md"/>
                                            </div>
                                        </div>
                                    </div>
                                </Row>
                            </div>
                        </div>
                    </div> : <div></div>}
                    {this.state.editPlaylist ? <div>
                        <div className='author-list'>
                            <div className="video-wrapper" data-id="6" id="video-6">
                                <div className="video-actions vid_stud_acts">
                                    <a onClick={this.handleSubmit} title="Update">
                                        <svg xmlns="http://www.w3.org/2000/svg" 
                                        className="addplaylistIcon"
                                             viewBox="0 0 24 24">
                                            <path fill="currentColor"
                                                  d="M2,16H10V14H2M18,14V10H16V14H12V16H16V20H18V16H22V14M14,6H2V8H14M14,10H2V12H14V10Z"></path>
                                        </svg>
                                    </a>
                                    <a onClick={(e) => {
                                        e.preventDefault();
                                        this.setState({
                                            mainPage: true,
                                            addPlaylist: false,
                                            purpose: '',
                                            editPlaylist: false,
                                            id: -1
                                        })
                                    }} title='Cancel'>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36"
                                             viewBox="0 0 24 24">
                                            <path fill="#e91e63"
                                                  d="M13,9H11V7H13M13,17H11V11H13M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2Z"></path>
                                        </svg>
                                    </a>
                                </div>
                                <Row>
                                    <div className="video-thumb col-md-3">
                                        <h3>Edit<br/>Playlist</h3>
                                    </div>
                                    <div className="video-info col-md-5 no-padding-left">
                                        <div className='video-title'>
                                            <div className="col-md-4">
                                                <input onChange={(e) => {
                                                    this.setState({name: e.target.value})
                                                    this.setState({ showAlert: false })
                                                }} name="name" type="text" placeholder="Enter Name"
                                                       defaultValue={this.state.name}
                                                       className="form-control input-md"/>
                                            </div>
                                            <div className="col-md-8">
                                                <input onChange={(e) => {
                                                    this.setState({description: e.target.value})
                                                    this.setState({ showAlert: false })
                                                }} name="description" type="text" placeholder="Description"
                                                       defaultValue={this.state.description}
                                                       className="form-control input-md"/>
                                            </div>
                                        </div>
                                    </div>
                                </Row>
                            </div>
                        </div>
                    </div> : <div></div>}
                    <div className="clear"></div>
                </div>
                <div className="clear"></div>
            </div>
        </div>
    }

}
