import React from 'react';
import axios from 'axios';
import VideoThumbnail from 'react-video-thumbnail';

class WatchVideo extends React.Component{
    constructor() {
        super();
        this.state={
            videoUrl:'',
        }
    }
    componentDidMount() {
        axios.get('/watch_video')
            .then((res)=>{this.setState({videoUrl:res.data.path})})
            .catch((err)=>{console.log(err)})
    }

    render() {
        return <div>
            {/*<VideoThumbnail*/}
            {/*    videoUrl={this.state.videoUrl}*/}
            {/*    width={200}*/}
            {/*    height={100}*/}
            {/*/>*/}
        </div>
    }
}
export default WatchVideo;
