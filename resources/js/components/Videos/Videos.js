import React from 'react';
import axios from 'axios';
import VideoThumbnail from 'react-video-thumbnail';
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
        return <div id="main-container" className="main-content  container" data-logged="true">
            <div className="container_content">
                <div className="wo_about_wrapper_parent">
                    <div className="wo_about_wrapper">
                        <div className="hero hero-overlay">
                            <div className="container">
                                <h1 className="text-center">Latest videos</h1>
                            </div>
                        </div>
                        <svg className="wave" width="100%" height="50px" preserveAspectRatio="none"
                             xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1920 75">
                            <defs>
                                <clipPath id="a">
                                    <rect className="a" style={{fill: 'none'}} width="1920" height="75"></rect>
                                </clipPath>
                            </defs>
                            <title>Latest videos | </title>
                            <g className="b" style={{clipPath: 'url(#a)'}}>
                                <path className="c" style={{fill: '#04abf2'}}
                                      d="M1963,327H-105V65A2647.49,2647.49,0,0,1,431,19c217.7,3.5,239.6,30.8,470,36,297.3,6.7,367.5-36.2,642-28a2511.41,2511.41,0,0,1,420,48"></path>
                            </g>
                            <g className="b" style={{clipPath: 'url(#a)'}}>
                                <path className="d" style={{fill: '#04abf2', opacity: '0.5', isolation: 'isolate'}}
                                      d="M-127,404H1963V44c-140.1-28-343.3-46.7-566,22-75.5,23.3-118.5,45.9-162,64-48.6,20.2-404.7,128-784,0C355.2,97.7,341.6,78.3,235,50,86.6,10.6-41.8,6.9-127,10"></path>
                            </g>
                            <g className="b" style={{clipPath: 'url(#a)'}}>
                                <path className="d" style={{fill: '#04abf2', opacity: '0.5', isolation: 'isolate'}}
                                      d="M1979,462-155,446V106C251.8,20.2,576.6,15.9,805,30c167.4,10.3,322.3,32.9,680,56,207,13.4,378,20.3,494,24"></path>
                            </g>
                            <g className="b" style={{clipPath: 'url(#a)'}}>
                                <path className="d" style={{fill: '#04abf2', opacity: '0.5', isolation: 'isolate'}}
                                      d="M1998,484H-243V100c445.8,26.8,794.2-4.1,1035-39,141-20.4,231.1-40.1,378-45,349.6-11.6,636.7,73.8,828,150"></path>
                            </g>
                        </svg>
                    </div>
                </div>
                <div className="content pt_shadow pt_page_margin pt_vid_lst_page">
                    <div className="col-md-12">
                        <div className="videos-latest-list row">

                            {this.state.videos.map((item, index) => {
                                let link = '/watch?v=' + item.video_id;
                                console.log(link);
                                return <div key={index}
                                            className="col-md-3 col-sm-6 no-padding-right-at-all no-padding-mobile-left">
                                    <div className="video-latest-list video-wrapper">
                                        <div className="video-thumb">
                                            <Link to={link}>
                                                <VideoThumbnail
                                                    videoUrl={item.video_path}
                                                />
                                                <div className="play_hover_btn" onMouseEnter="show_gif(this,'')"
                                                     onMouseLeave="hide_gif(this)">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         strokeWidth="2" strokeLinecap="round"
                                                         strokeLinejoin="round"
                                                         className="feather feather-play-circle">
                                                        <circle cx="12" cy="12" r="10"></circle>
                                                        <polygon points="10 8 16 12 10 16 10 8"></polygon>
                                                    </svg>
                                                </div>
                                            </Link>
                                            <div className="video-duration">
                                                {/*{Math.floor(item.duration / 60)}:{item.duration - Math.floor(item.duration / 60) * 60}*/}
                                                xx:xx
                                            </div>
                                        </div>
                                        <div className="video-title">
                                            <Link to={link}><h4
                                                title={item.title}>{item.title}</h4></Link>
                                        </div>
                                        <div className="video-info">
                                            <div>
                                                <Link to={link}>User</Link><br/>
                                                <span>x Views</span> <span className="bold">·</span>
                                                <span>xx hours ago</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            })}
                        </div>
                        <div className="clear"></div>
                    </div>
                    <div className="clear"></div>
                </div>
            </div>
        </div>;
    }
}

export default Videos;
