import React from 'react';
import ReactDOM from 'react-dom';
import {Route} from "react-router-dom";
import AppLayout from './layout/index';
import Dashboard from './pages/Dashboard';
import Video from './pages/Video';
import Playlist from './pages/Playlist';
import Analytics from './pages/Dashboard';
import Profile from './pages/Profile';
import UploadPage from './pages/Upload';
function App() {
    return <AppLayout>
        <Route path="/" exact component={Dashboard}/>
        <Route path="/video" exact component={Video}/>
        <Route path="/playlist" exact component={Playlist}/>
        <Route path="/analytics" exact component={Analytics}/>
        <Route path="/profile" exact component={Profile}/>
        <Route path="/upload" exact component={UploadPage}/>
    </AppLayout>
}

if (document.getElementById('container')) {
    ReactDOM.render(
        <App/>,
        document.getElementById('container'),
    );
}
