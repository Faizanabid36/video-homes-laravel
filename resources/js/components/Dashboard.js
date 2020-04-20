import React from 'react';
import ReactDOM from 'react-dom';
import {BrowserRouter, Link, Route, Switch} from 'react-router-dom';
import DashboardComponents from "./DashboardComponents/DashboardComponents";
import Comments from "./Comments";


class Dashboard extends React.Component {
    constructor(props) {
        super(props);
    }
    componentDidMount() {
        // if()
    }

    render() {
        return <div>
            <div id="main-container" className="container main-content" data-logged="true">
                <div id="container_content">
                    <div className="user-setting-panel pt_shadow">
                        <div>
                            <div className="upload-head">
                                <h4 className="pt_mn_page_hd">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                        <path fill="currentColor"
                                              d="M12,3L2,12H5V20H19V12H22M9,18H7V12H9M13,18H11V10H13M17,18H15V14H17"></path>
                                    </svg>
                                    Dashboard
                                </h4>
                                <div className="tp_vid_fltr_tabs">
                                    <ul className="list-unstyled">
                                        <li className={location.pathname.includes("dashboard")?"selected":""}>
                                            <Link to="/dashboard">Dashboard</Link>
                                        </li>
                                        <li className={location.pathname.includes("videos")?"selected":""}>
                                            <a href="#">Videos</a>
                                        </li>
                                        <li className={location.pathname.includes("comments")?"selected":""}>
                                            <Link to="/comments">Comments</Link>
                                        </li>
                                    </ul>
                                </div>
                                <div className="clear"></div>
                                <hr/>
                                {location.pathname.includes("dashboard")?
                                    <DashboardComponents/>
                                    :location.pathname.includes("comments")?
                                        <Comments/>:<div></div>}
                            </div>
                        </div>
                    </div>
                    <br/>
                </div>
            </div>
        </div>
    }
}

export default Dashboard;
