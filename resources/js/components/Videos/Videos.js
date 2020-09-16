import React from 'react';
import axios from 'axios';
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import { Card, Col, Row, Container, DropdownButton, Button, Dropdown } from "react-bootstrap";
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
            approvedVideos: [],
            pendingVideos: [],
        }
        this.changeFilter = this.changeFilter.bind(this);
    };

    changeFilter(filter) {
        axios.get('/all_videos/' + filter)
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


                <Col xs={12} className=" my-4 ">
                    <h3 className="float-left heading">My Videos <div className="borderBottom2"></div></h3>
                    <DropdownButton
                        className="dropdownbtn float-right"
                        id="dropdown-basic-button"
                        title="Filter"
                    >
                        <div className="dropItems">
                            <div>
                                <a className="cross2">
                                    <FontAwesomeIcon icon={faTimes}/>
                                </a>
                            </div>

                            <Dropdown.Item onClick={(e) => {
                                e.preventDefault();
                                this.changeFilter('newest')
                            }}>
                                <p className="items"> New to Oldest </p>
                            </Dropdown.Item>
                            <Dropdown.Item onClick={(e) => {
                                e.preventDefault();
                                this.changeFilter('oldest')
                            }}>
                                <p className="items"> Oldest to Newest </p>
                            </Dropdown.Item>
                            <Dropdown.Item onClick={(e) => {
                                e.preventDefault();
                                this.changeFilter('popular')
                            }}>

                                <p className="items"> Most Popular </p>
                            </Dropdown.Item>
                            <Dropdown.Item onClick={(e) => {
                                e.preventDefault();
                                this.changeFilter('alphabetical')
                            }}>

                                <p className="items"> Alphabetical </p>
                            </Dropdown.Item>
                        </div>
                    </DropdownButton>
                </Col>


                {this.state.approvedVideos.length ? this.state.approvedVideos.map((item, index) => {
                    let link = window.VIDEO_APP.base_url + '/' + item.user.username + '/' + item.video_id;
                    return <Col key={index} xs={12} sm={6} md={4} lg={3}>
                        <a href={link}>
                            <Card className="card2">
                                <div className="overlay"
                                     style={{backgroundImage: `linear-gradient(rgba(0, 0, 0, 0.5),rgba(0, 0, 0, 0.5) ) , url(${window.VIDEO_APP.base_url}/storage/${item.thumbnail})`}}>

                            <span className="one">
                                <FontAwesomeIcon
                                    icon={faPlayCircle}
                                    className="playicon"
                                    color="white"
                                />
                            </span>
                                    <span className="two">
                              <span>
                                In: {item.category.name}
                              </span>
                            </span>
                                    <span className="three">
                                  <span> {item.views} Views </span>
                            </span>

                                    <span
                                        className="four"> {Math.floor(item.duration / 60)}:{item.duration - Math.floor(item.duration / 60) * 60} </span>

                                </div>

                                <Card.Body className="card-body">

                                    <Card.Title>

                                        <h5 className="cardtitle"> {item.title} </h5>
                                    </Card.Title>

                                    <Card.Text>

                                        <p className="cardtitle2">
                                            {item.description}{" "}
                                            Upload By: {item.user.username}
                                        </p>
                                    </Card.Text>
                                    <div className="footer">


                                <span className="">
                                <FontAwesomeIcon icon={faCommentDots} className="icon2"/> {item.comments.length}
                                </span>
                                    </div>
                                </Card.Body>

                            </Card></a>
                    </Col>
                }) : <h2 className="Novideos"> No Videos Found </h2>}

            </Row>


            <Row>


                <Col xs={12} className=" my-4 ">
                    <h3 className="float-left heading">Pending for Approval <div className="borderBottom2"></div></h3>
                </Col>
                {this.state.pendingVideos.length ? this.state.pendingVideos.map((item, index) => {
                    let link = window.VIDEO_APP.base_url + '/' + item.user.username + '/' + item.video_id;
                    return <Col key={index} xs={12} sm={6} md={4} lg={3} className="">
                        <Card className="card2">
                            <div className="overlay"
                                 style={{backgroundImage: `linear-gradient(rgba(0, 0, 0, 0.5),rgba(0, 0, 0, 0.5) ) , url(${window.VIDEO_APP.base_url}/storage/${item.thumbnail})`}}>
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
                                        <p className="cardtitle"> {item.title} </p>
                                    </Card.Title>
                                </a>
                                <Card.Text>
                                    {" "}
                                    <p className="cardtitle2">
                                        {item.description}{" "}
                                        Upload By: {item.user.username}
                                    </p>
                                </Card.Text>
                                <div className="footer">

                                    <span className="">
                                <FontAwesomeIcon icon={faCommentDots} className="icon2"/> {item.comments.length}
                              </span>
                                </div>
                            </Card.Body>

                        </Card>
                    </Col>
                }) : <h2 className="Novideos"> No Videos Found </h2>}
            </Row>
        </Container>;
    }
}

export default Videos;
