import React from 'react';
import ReactDOM from 'react-dom';
import {Route} from "react-router-dom";
import AppLayout from './layout/index';
import Dashboard from './pages/Dashboard';
import Video from './pages/Video';
import Playlist from './pages/Playlist';
import Analytics from './pages/Analytics';
import Profile from './pages/Profile';
import UploadPage from './pages/Upload';
import EditVideo from './pages/EditVideo';
import Ratings from "./pages/Ratings";
import Messages from "./pages/Messages";
import MessagesList from "./pages/MessagesList";
import GlobalVideoSettings from "./pages/GlobalVideoSettings";
import './styles/arrow.css';

function App() {
    return <AppLayout>
        <Route path="/" exact component={Dashboard}/>
        <Route path="/messages" exact component={MessagesList}/>
        <Route path="/messages/:id" exact component={Messages}/>
        <Route path="/video" exact component={Video}/>
        <Route path="/playlist" exact component={Playlist}/>
        <Route path="/analytics" exact component={Analytics}/>
        <Route path="/profile" exact component={Profile}/>
        <Route path="/upload" exact component={UploadPage}/>
        <Route path="/ratings" exact component={Ratings}/>
        <Route path="/edit_video/:id" component={EditVideo}/>
        <Route path="/global_videos_settings" component={GlobalVideoSettings}/>

    </AppLayout>
}

// function Dashboard2(){
//     return "Hello";
// }

function App2() {
    return <AppLayout>
        <Route path="/" component={Dashboard}/>
    </AppLayout>;
}

if (document.getElementById('container2')) {
    ReactDOM.render(
        <App/>,
        document.getElementById('container2'),
    );
}
