import React from 'react';
import ReactDOM from 'react-dom';
import { HashRouter as BrowserRouter, Route, Switch, Link } from 'react-router-dom';
import Dashboard from "./Dashboard";
import WatchVideo from "./Videos/WatchVideo";
import UploadVideos from "./Videos/UploadVideos";
import Videos from "./Videos/Videos";

class Index extends React.Component{
    render() {
        return <main>
            <Switch>
                <Route path='/' exact component={Dashboard} />
                <Route path="/upload_video" exact  component={UploadVideos} />
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
