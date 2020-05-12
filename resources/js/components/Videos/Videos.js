import React from 'react';
import axios from 'axios';
// import VideoThumbnail from 'react-video-thumbnail';
import {BrowserRouter, Route, Link} from "react-router-dom";

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
            })
            .catch((err) => {
                console.log(err)
            })
    }

    render() {

        return <><h1 className="text-center">Uploaded videos</h1>
            <div className="videos-latest-list row">

                {this.state.videos.map((item, index) => {
                    let link = window.VIDEO_APP.base_url + '/' + item.user.username + '/watch_video?v=' + item.video_id;
                    return <div key={index}
                                className="col-md-3 col-sm-6 no-padding-right-at-all no-padding-mobile-left">
                        <div className="video-latest-list video-wrapper">
                            <div className="video-thumb">
                                <a href={link}>
                                    <img src={`storage/${item.thumbnail}`} alt=""/>
                                    <div className="play_hover_btn" onMouseEnter="show_gif(this,'')"
                                         onMouseLeave="hide_gif(this)">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                             viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                             strokeWidth="2" strokeLinecap="round"
                                             strokeLinejoin="round"
                                             className="feather feather-play-circle">
                                            <circle cx="12" cy="12" r="10"/>
                                            <polygon points="10 8 16 12 10 16 10 8"/>
                                        </svg>
                                    </div>
                                </a>
                                <div className="video-duration">
                                    {Math.floor(item.duration / 60)}:{item.duration - Math.floor(item.duration / 60) * 60}
                                    {/*xx:xx*/}
                                </div>
                            </div>
                            <div className="video-title">
                                <Link><h4
                                    title={item.title}>{item.title}</h4></Link>
                            </div>
                            <div className="video-info">
                                <div>
                                    <Link>{item.user.username}</Link><br/>
                                    <span>{item.views} Views</span> <span className="bold">~</span>
                                    <span>{item.daysAgo}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                })}
            </div>
        </>;
    }
}

export default Videos;
