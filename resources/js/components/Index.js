import React from 'react';
import ReactDOM from 'react-dom';
import { BrowserRouter, Route, Switch, Link } from 'react-router-dom';
import Dashboard from "./Dashboard";
import WatchVideo from "./Videos/WatchVideo";
import UploadVideos from "./Videos/UploadVideos";
import Videos from "./Videos/Videos";

class Index extends React.Component{
    render() {
        return <main>
            <Switch>
                <Route path='/' exact component={Dashboard} />
                <Route path="/comments" exact  component={Dashboard} />
                <Route path="/upload-video" exact  component={UploadVideos} />
                <Route path='/watch' exact  component={WatchVideo}/>
                <Route path='/watch_videos' exact  component={Videos}/>
            </Switch>
        </main>
    }
}

export default Index;

if (document.getElementById('container')) {
    ReactDOM.render(
        <BrowserRouter>
            <Index />
        </BrowserRouter>
        , document.getElementById('container'));
}
