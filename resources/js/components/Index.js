import React from 'react';
import ReactDOM from 'react-dom';
import { HashRouter as BrowserRouter, Route, Switch, Link } from 'react-router-dom';
import Dashboard from "./Dashboard";
// import WatchVideo from "./Videos/WatchVideo";
// import Videos from "./Videos/Videos";
import UploadVideos from "./Videos/UploadVideos";
import EditVideo from "./Videos/EditVideo.jsx";
import PlayList from "./Playlist.jsx";
import Profile from "./Profile.jsx";
import Settings from "./Settings.jsx";
import Customize from "./Customize.jsx";


export default class Index extends React.Component{
    render() {
        return <BrowserRouter><main>
            <Switch>
                <Route path='/' exact component={Dashboard} />
                <Route path="/upload_video" exact  component={UploadVideos} />
                <Route path="/edit_video" exact  component={EditVideo} />
                <Route path="/customize_player" exact  component={Customize} />
                <Route path="/playlist" exact  component={PlayList} />
                <Route path="/profile" exact  component={Profile} />
                <Route path="/settings" exact  component={Settings} />
            </Switch>
        </main></BrowserRouter>
    }
}

if (document.getElementById('container')) {
    ReactDOM.render(<Index />, document.getElementById('container'));
}
