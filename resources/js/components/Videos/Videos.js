import React from 'react';
import axios from 'axios';
import HeadAllVideos from '../HeadAllVideos'
// import VideoThumbnail from 'react-video-thumbnail';
import {BrowserRouter, Route, Link} from "react-router-dom";
import {FontAwesomeIcon} from "@fortawesome/react-fontawesome";
import {Card, Col, Row, Container, DropdownButton, Button, Dropdown} from "react-bootstrap";
import {
    faTimes,
    faHeart,
    faPlayCircle,
    faCommentDots,
    faShareAlt,
    faEyeSlash
} from "@fortawesome/free-solid-svg-icons";


class Videos extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            videos: [],
            approvedVideos:[],
            pendingVideos:[],
        }
        this.changeFilter=this.changeFilter.bind(this);
    };
    changeFilter(filter)
    {
        axios.get('/all_videos/'+filter)
            .then((res) => {
                this.setState({...res.data})
            })
            .catch((err) => {
                console.log(err)
            })
    }
    componentDidMount() {
        axios.get('/all_videos')
            .then((res) => {
                this.setState({...res.data})
            })
            .catch((err) => {
                console.log(err)
            })
    }

    render() {
        return <Container>
            <Row>
                <Col>
                    <Row className="head ">
                        <Col>
                            <p className="h4 activate">My Videos</p>
                        </Col>
                        <Col className="  d-flex  justify-content-end">
                            <DropdownButton
                                className="dropdownbtn"
                                id="dropdown-basic-button"
                                title="Filter"
                            >
                                <div className="dropItems">
                                    <div>
                                        {" "}
                                        <Button className="cross btn ">
                                            {" "}
                                            <FontAwesomeIcon icon={faTimes}/>{" "}
                                        </Button>{" "}
                                    </div>

                                    <Dropdown.Item onClick={(e)=>{e.preventDefault();this.changeFilter('newest')}}>
                                        {" "}
                                        <p className="items"> New to Oldest </p>{" "}
                                    </Dropdown.Item>
                                    <Dropdown.Item onClick={(e)=>{e.preventDefault();this.changeFilter('oldest')}}>
                                        <p className="items"> Oldest to Newest </p>{" "}
                                    </Dropdown.Item>
                                    <Dropdown.Item onClick={(e)=>{e.preventDefault();this.changeFilter('popular')}}>
                                        {" "}
                                        <p className="items"> Most Popular </p>{" "}
                                    </Dropdown.Item>
                                    <Dropdown.Item onClick={(e)=>{e.preventDefault();this.changeFilter('alphabetical')}}>
                                        {" "}
                                        <p className="items"> Alphabetical </p>{" "}
                                    </Dropdown.Item>
                                </div>
                            </DropdownButton>
                        </Col>
                    </Row>
                </Col>
            </Row>
            <Row className=" Cards-container">
                {this.state.approvedVideos.map((item, index) => {
                    let link = window.VIDEO_APP.base_url + '/' + item.user.username + '/watch_video?v=' + item.video_id;
                    return <Col key={index} sm={12} md={6} lg={4}>
                        <Card className="">
                            <div className="overlay"
                                 style={{backgroundImage: `url(${window.VIDEO_APP.base_url}/storage/${item.thumbnail})`}}>
                            <span className="one">
                                <FontAwesomeIcon
                                    icon={faPlayCircle}
                                    className="playicon"
                                    color="white"
                                />{" "}
                            </span>
                                <span className="two">
                              <span>
                                In: {item.category.name}
                              </span>{" "}
                            </span>
                                <span className="three">
                              <span> {item.views} Views </span>
                            </span>
                                <span
                                    className="four"> {Math.floor(item.duration / 60)}:{item.duration - Math.floor(item.duration / 60) * 60} </span>
                            </div>


                            <Card.Body className="card-body">
                                <a href={link}>
                                    <Card.Title>
                                        {" "}
                                        <h5 className="cardtitle"> {item.title} </h5>
                                    </Card.Title>
                                </a>
                                {/* <Card.Text>
                                    {" "}
                                    <p className="cardtitle2">
                                        {item.description}{" "}
                                    </p>
                                </Card.Text> */}
                                <div className="footer">
                                        Upload By: {item.user.username}
                                    <span className="ml-5">
                                <FontAwesomeIcon icon={faCommentDots} className="icon2"/> {item.comments.length}
                              </span>
                                </div>
                            </Card.Body>

                        </Card>
                    </Col>
                })}
            </Row>
            <Row>
                <Col>
                    <Row className="head ">
                        <Col>
                            <p className="h4 activate">Pending for Approval</p>
                        </Col>
                        {/* <Col className="  d-flex  justify-content-end">
                            <DropdownButton
                                className="dropdownbtn"
                                id="dropdown-basic-button"
                                title="filter"
                            >
                                <div className="dropItems">
                                    <div>
                                        {" "}
                                        <Button className="cross btn ">
                                            {" "}
                                            <FontAwesomeIcon icon={faTimes}/>{" "}
                                        </Button>{" "}
                                    </div>

                                    <Dropdown.Item onClick={(e)=>{e.preventDefault();this.changeFilter('newest')}}>
                                        {" "}
                                        <p className="items"> New to Oldest </p>{" "}
                                    </Dropdown.Item>
                                    <Dropdown.Item onClick={(e)=>{e.preventDefault();this.changeFilter('oldest')}}>
                                        <p className="items"> Oldest to Newest </p>{" "}
                                    </Dropdown.Item>
                                    <Dropdown.Item onClick={(e)=>{e.preventDefault();this.changeFilter('popular')}}>
                                        {" "}
                                        <p className="items"> Most Popular </p>{" "}
                                    </Dropdown.Item>
                                    <Dropdown.Item onClick={(e)=>{e.preventDefault();this.changeFilter('alphabetical')}}>
                                        {" "}
                                        <p className="items"> Alphabetical </p>{" "}
                                    </Dropdown.Item>
                                </div>
                            </DropdownButton>
                        </Col> */}
                    </Row>
                </Col>
            </Row>
            <Row className=" Cards-container">
                {this.state.pendingVideos.map((item, index) => {
                    let link = window.VIDEO_APP.base_url + '/' + item.user.username + '/watch_video?v=' + item.video_id;
                    return <Col key={index} sm={12} md={6} lg={4}>
                        <Card className="">
                            <div className="overlay"
                                 style={{backgroundImage: `url(${window.VIDEO_APP.base_url}/storage/${item.thumbnail})`}}>
                            <span className="one">
                                <FontAwesomeIcon
                                    icon={faPlayCircle}
                                    className="playicon"
                                    color="white"
                                />{" "}
                            </span>
                                <span className="two">
                              <span>
                                In: {item.category.name}
                              </span>{" "}
                            </span>
                                <span className="three">
                              <span> {item.views} Views </span>
                            </span>
                                <span
                                    className="four"> {Math.floor(item.duration / 60)}:{item.duration - Math.floor(item.duration / 60) * 60} </span>
                            </div>


                            <Card.Body className="card-body">
                                <a href={link}>
                                    <Card.Title>
                                        {" "}
                                        <h5 className="cardtitle"> {item.title} </h5>
                                    </Card.Title>
                                </a>
                                <div className="footer">
                                        Upload By: {item.user.username}
                                    <span className="ml-5">
                                <FontAwesomeIcon icon={faCommentDots} className="icon2"/> {item.comments.length}
                              </span>
                                </div>
                            </Card.Body>

                        </Card>
                    </Col>
                })}
            </Row>
        </Container>;
    }
}

export default Videos;
