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
        }
    }

    componentDidMount() {
        axios.get('/all_videos')
            .then((res) => {
                this.setState({...res.data})
                console.log(this.state.videos)
            })
            .catch((err) => {
                console.log(err)
            })
    }

    render() {
        return <Container>
           
           <Row>
                  <Col>
                         <HeadAllVideos state={'All Videos'} />
                 </Col>
            </Row>    
                           

                       

                       
           
            <Row className=" Cards-container">
                {this.state.videos.map((item, index) => {
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
                                {/*<FontAwesomeIcon*/}
                                {/*    icon={faEyeSlash}*/}
                                {/*    className=" pl-1 "*/}
                                {/*    color="white"*/}
                                {/*/>*/}
                              </span>{" "}
                            </span>
                                <span className="three">
                              <span> {item.views} Views </span>
                                    {/*<span>*/}
                                    {/*  <FontAwesomeIcon icon={faHeart} className="" color="red"/>{" "}*/}
                                    {/*</span>*/}
                                    {/*<span> 2,568 </span>*/}
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
                                <Card.Text>
                                    {" "}
                                    <p className="cardtitle2">
                                        {item.description}{" "}
                                    </p>
                                </Card.Text>
                                <div className="footer">
                                    <span>
                                        Upload By: {item.user.username}
                                    </span>
                                    <span className="ml-5">
                                <FontAwesomeIcon icon={faCommentDots} className="icon2"/> {item.comments.length}
                              </span>
                                </div>
                            </Card.Body>

                        </Card>
                        {/*<Card className="overlay">*/}
                        {/*    <div className="video-thumb">*/}
                        {/*        <a href={link}>*/}
                        {/*            <img src={`storage/${item.thumbnail}`} alt=""/>*/}
                        {/*            <div className="play_hover_btn" onMouseEnter="show_gif(this,'')"*/}
                        {/*                 onMouseLeave="hide_gif(this)">*/}
                        {/*                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"*/}
                        {/*                     viewBox="0 0 24 24" fill="none" stroke="currentColor"*/}
                        {/*                     strokeWidth="2" strokeLinecap="round"*/}
                        {/*                     strokeLinejoin="round"*/}
                        {/*                     className="feather feather-play-circle">*/}
                        {/*                    <circle cx="12" cy="12" r="10"/>*/}
                        {/*                    <polygon points="10 8 16 12 10 16 10 8"/>*/}
                        {/*                </svg>*/}
                        {/*            </div>*/}
                        {/*        </a>*/}
                        {/*        <div className="video-duration">*/}
                        {/*            {Math.floor(item.duration / 60)}:{item.duration - Math.floor(item.duration / 60) * 60}*/}
                        {/*            /!*xx:xx*!/*/}
                        {/*        </div>*/}
                        {/*    </div>*/}
                        {/*    <div className="video-title">*/}
                        {/*        <Link><h4*/}
                        {/*            title={item.title}>{item.title}</h4></Link>*/}
                        {/*    </div>*/}
                        {/*    <div className="video-info">*/}
                        {/*        <div>*/}
                        {/*            <Link>{item.user.username}</Link><br/>*/}
                        {/*            <span>{item.views} Views</span> <span className="bold">~</span>*/}
                        {/*            <span>{item.daysAgo}</span>*/}
                        {/*        </div>*/}
                        {/*    </div>*/}
                        {/*</Card>*/}
                    </Col>
                })}
            </Row>
        </Container>;
    }
}

export default Videos;
