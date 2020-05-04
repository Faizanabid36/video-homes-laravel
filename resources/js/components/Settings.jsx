import {Button, Carousel, Col, Row, Container, Form} from "react-bootstrap";
import React from "react";
import BlockUser from "./Settings/BlockUser";
import PrivacySettings from "./Settings/PrivacySettings";

class Settings extends React.Component {
    constructor() {
        super();
        this.state = {
            user: {},
            tab: 'privacy-settings',
        }
    }

    renderTemplate() {
        switch (this.state.tab) {
            case 'block-user':
                return <BlockUser/>;
            default:
                return <PrivacySettings/>
        }
    }

    render() {
        return <Container className="main-content  container">
            <div id="container_content">
                <div className="wo_about_wrapper_parent">
                    <div className="wo_about_wrapper">
                        <div className="hero hero-overlay">
                            <div className="container">
                                <h1 className="text-center">
                                    General Settings
                                </h1>
                            </div>
                        </div>
                    </div>
                </div>
                <div className="pt_page_margin">
                    <Row>
                        <div className="col-md-1"></div>
                        <div className="col-md-3">
                            <div className="settings-sidebar">
                                <ul className="list-group">
                                    <li className={this.state.tab == 'privacy-settings' ? 'list-group-item active' : 'list-group-item'}>
                                        <a onClick={(e) => {
                                            e.preventDefault();
                                            this.setState({tab: 'privacy-settings'})
                                        }}>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                 viewBox="0 0 24 24">
                                                <path fill="#ca4b8e"
                                                      d="M12,12H19C18.47,16.11 15.72,19.78 12,20.92V12H5V6.3L12,3.19M12,1L3,5V11C3,16.55 6.84,21.73 12,23C17.16,21.73 21,16.55 21,11V5L12,1Z"></path>
                                            </svg>
                                            Privacy Settings</a>
                                    </li>

                                    <li className={this.state.tab == 'block-user' ? 'list-group-item active' : 'list-group-item'}>
                                        <a onClick={(e) => {
                                            e.preventDefault();
                                            this.setState({tab: 'block-user'})
                                        }}>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                 viewBox="0 0 24 24">
                                                <path fill="#3f51b5"
                                                      d="M10 4A4 4 0 0 0 6 8A4 4 0 0 0 10 12A4 4 0 0 0 14 8A4 4 0 0 0 10 4M17.5 13C15 13 13 15 13 17.5C13 20 15 22 17.5 22C20 22 22 20 22 17.5C22 15 20 13 17.5 13M10 14C5.58 14 2 15.79 2 18V20H11.5A6.5 6.5 0 0 1 11 17.5A6.5 6.5 0 0 1 11.95 14.14C11.32 14.06 10.68 14 10 14M17.5 14.5C19.16 14.5 20.5 15.84 20.5 17.5C20.5 18.06 20.35 18.58 20.08 19L16 14.92C16.42 14.65 16.94 14.5 17.5 14.5M14.92 16L19 20.08C18.58 20.35 18.06 20.5 17.5 20.5C15.84 20.5 14.5 19.16 14.5 17.5C14.5 16.94 14.65 16.42 14.92 16Z"></path>
                                            </svg>
                                            Block User</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        {this.renderTemplate()}
                        <div className="col-md-1"></div>
                        <div className="clear"></div>
                    </Row>
                </div>
            </div>
        </Container>
    }
}

export default Settings
