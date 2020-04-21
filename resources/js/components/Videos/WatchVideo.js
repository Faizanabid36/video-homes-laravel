import React from 'react';
import axios from 'axios';
import videojs from 'video.js'

require('!style-loader!css-loader!video.js/dist/video-js.min.css')

class WatchVideo extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            videoUrl: '',
            title: '',
        }
    }

    componentWillUnmount() {
        if (this.player) {
            this.player.dispose()
        }
    }

    componentDidMount() {
        const urlParams = new URLSearchParams(window.location.search);
        const video_id = urlParams.get('v');
        axios.post('/watch_video', {video_id})
            .then((res) => {
                this.setState({...res.data}, function () {
                    this.player = videojs(this.videoPlayer, {
                        width: '700px', height: '425px'
                    }, () => {
                        this.videoPlayer.src = this.state.videoUrl
                    });
                })
            })
            .catch((err) => {
                console.log(err)
            })
    }

    render() {
        return <div className="container watch-container    main-content" id="main-container">
            <div id="container_content">
                <div className="top-video video-player-page">
                    <div className="row">
                        <div className="col-md-8 player-video" style={{marginTop: '0 !important'}}>
                            <div className="video-player pt_video_player ">
                                <video id="my-video_html5"
                                       ref={(c) => {
                                           this.videoPlayer = c;
                                       }} className="video-js" controls>
                                    <source type="video/mp4" src={this.state.videoUrl}/>
                                </video>
                                <h1>{this.state.title}</h1>
                            </div>
                            <div className="clear"></div>
                        </div>
                        <div className="col-md-4 no-padding-left pull-right desktop">
                            <div className="content pt_shadow">
                                <div className="ads-placment"></div>
                                <div className="next-video">
                                    <div className="next-text pull-left pt_mn_wtch_nxttxt">
                                        <h4>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                 viewBox="0 0 24 24">
                                                <path fill="currentColor"
                                                      d="M16,18H18V6H16M6,18L14.5,12L6,6V18Z"></path>
                                            </svg>
                                            Up next
                                        </h4>
                                    </div>
                                    <div className="pt_mn_wtch_switch pull-right">
                                        <input id="autoplay" type="checkbox" className="tgl autoplay-video"/>
                                        <label className="tgl-btn" htmlFor="autoplay">Autoplay</label>
                                    </div>
                                    <div className="clear"></div>
                                </div>
                                <div className="videos-list pt_mn_wtch_rlts_prnt pt_mn_wtch_upnxt_prnt" id="next-video">

                                </div>
                                <hr/>
                                <div className="videos-list related-videos pt_mn_wtch_rlts_prnt">

                                </div>
                                <div className="load-related-videos">
                                    <button className="btn btn-default" id="load-related-videos">
                                        <span>Load more</span><i className="fa fa-circle-o-notch spin hidden"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    }
}

export default WatchVideo;
