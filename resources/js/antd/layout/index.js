import React from 'react';
import {BreakpointsProvider, ShowAt} from 'react-with-breakpoints';
import {Avatar, Badge, Button, Divider, Drawer, Dropdown, Layout, Menu, notification, Progress, Space,} from 'antd';

import {
    BellOutlined,
    CloudUploadOutlined,
    DashboardOutlined,
    LineChartOutlined,
    LogoutOutlined,
    MenuFoldOutlined,
    ProfileOutlined,
    SettingOutlined,
    UserOutlined,
    VideoCameraOutlined,
    StarOutlined,
    MessageOutlined
} from '@ant-design/icons';
import {HashRouter as Router} from "react-router-dom";
import axios from 'axios';


import 'antd/dist/antd.css';
import './style.css';

const {Header, Sider} = Layout;

class MyProgress extends React.Component {
    constructor(props) {
        super(...arguments);
        this.state = {
            percent: 0,

        };
    }

    componentDidMount() {
        this.intervalId = setInterval(() => {
            if (this.state.percent >= 100) {
                clearInterval(this.intervalId);
            }
            this.setState({
                percent: this.state.percent + 10,
            })
        }, 100)
    }

    render() {
        return <Progress percent={this.state.percent}/>;
    }
}

const openNotification = () => {
    notification.open({
        message: 'Notification Title',
        description: <MyProgress/>,
        duration: 0,
    });
};

class SidebarMenu extends React.Component {
    constructor(props) {
        super(...arguments);
        this.state = {
            current: window.location.hash === "#/" ? 'dashboard' : window.location.hash.substr(2)
        };
        this.menuClick = this.menuClick.bind(this);
    }

    menuClick(e) {
        console.log(e.key);
        this.setState({current: e.key}, () => {
            window.location.hash = "#/" + (e.key === "dashboard" ? "" : e.key);
        })
    }

    render() {
        return <Menu
            onClick={this.menuClick}
            defaultSelectedKeys={[this.state.current]}
            mode='vertical'
            theme='light'
        >
            <Menu.Item key="dashboard" icon={<DashboardOutlined/>}>
                Dashboard
            </Menu.Item>
            <Menu.Item key="video" icon={<VideoCameraOutlined/>}>
                Videos
            </Menu.Item>
            <Menu.Item key="playlist" icon={<ProfileOutlined/>}>
                Playlists
            </Menu.Item>
            {/*<Menu.Item key="custom-design" icon={<FormatPainterOutlined/>}>*/}
            {/*    Custom Design*/}
            {/*</Menu.Item>*/}
            <Menu.Item key="analytics" icon={<LineChartOutlined/>}>
                Analytics
            </Menu.Item>

            <Menu.Item key="messages" icon={<MessageOutlined/>}>
                Messages
            </Menu.Item>
            <Menu.Item key="ratings" icon={<StarOutlined/>}>
                Rating
            </Menu.Item>
        </Menu>
    }
}

class App extends React.Component {
    constructor(props) {
        super(...arguments);
        this.props = props;
        this.state = {
            collapsed: false,
            current: false,
            visible: false,
            placement: 'left',
            user: {},
            dataloaded: false,
        };
        this.onCollapse = this.onCollapse.bind(this);
        this.showDrawer = this.showDrawer.bind(this);
        this.onClose = this.onClose.bind(this);
        this.profileMenu = this.profileMenu.bind(this);
        this.menuClick = this.menuClick.bind(this);
        this.logOut = this.logOut.bind(this);
    }

    componentDidMount() {
        axios.get('logged_in_user').then((res) => {
            this.setState({user: res.data.user, dataloaded: true})
            console.log('here', res.data.user.user_extra)
        })
            .catch((err) => {
                console.log(err)
            })
    }

    logOut() {
        axios.post('logout')
            .then((res) => {
                window.location.reload()
            })
            .catch((err)=>{console.log(err)})
    }

    showDrawer() {
        this.setState({
            visible: true,
        });
    };

    menuClick(e) {
        console.log(e.key);
        this.setState({current: e.key}, () => {
            window.location.hash = "#/" + (e.key === "dashboard" ? "" : e.key);
        })
    }


    onClose() {
        this.setState({
            visible: false,
        });
    };

    onCollapse(collapsed) {
        console.log(collapsed);
        this.setState({collapsed});
    }

    profileMenu() {
        return <Menu onClick={this.menuClick}>
            <Menu.Item key="profile" icon={<UserOutlined/>}>
                Edit Profile
            </Menu.Item>
            <Menu.Item key="setting" disabled icon={<SettingOutlined/>}>
                Setting
            </Menu.Item>
            <Divider style={{margin: "3px 0"}}/>
            <Menu.Item onClick={this.logOut} key="logout" icon={<LogoutOutlined/>}>
                Logout
            </Menu.Item>
        </Menu>
    }

    notificationMenu() {
        // return <Tabs defaultActiveKey="1" onChange={callback}>
        //     <TabPane tab="Tab 1" key="1">
        //         Content of Tab Pane 1
        //     </TabPane>
        //     <TabPane tab="Tab 2" key="2">
        //         Content of Tab Pane 2
        //     </TabPane>
        //     <TabPane tab="Tab 3" key="3">
        //         Content of Tab Pane 3
        //     </TabPane>
        // </Tabs>;
        return <Menu onClick={this.menuClick}>
            <Menu.Item key="1" icon={<UserOutlined/>}>
                1st menu item
            </Menu.Item>
            <Menu.Item key="2" icon={<UserOutlined/>}>
                2nd menu item
            </Menu.Item>
            <Menu.Item key="3" icon={<UserOutlined/>}>
                3rd menu item
            </Menu.Item>
        </Menu>;
    }

    render() {
        return (
            <Router>
                <BreakpointsProvider>
                    <Layout style={{height: "100vh"}}>
                        <ShowAt breakpoint={'small'}>
                            <Drawer
                                title="VideoHomes"
                                placement={'left'}
                                closable={false}
                                onClose={this.onClose}
                                visible={this.state.visible}
                                key={'left'}
                                className={"drawer"}
                            >
                                <SidebarMenu/>
                            </Drawer>
                        </ShowAt>
                        <ShowAt breakpoint={'mediumAndAbove'}>
                            <Sider breakpoint="md"
                                   collapsedWidth="0" theme={'light'} style={{width: 256}} collapsible
                                   collapsed={this.state.collapsed}
                                   onCollapse={this.onCollapse}>
                                <div className="ant-drawer-header">
                                    <div className="ant-drawer-title">
                                        <a href={window.VIDEO_APP.base_url}>
                                            VideoHomes
                                        </a>
                                    </div>
                                </div>
                                <div className="ant-drawer-header">
                                    <div className="ant-drawer-title">
                                        Space Used {this.state.user.uploaded_videos_space}.GB out of 3.GB
                                    </div>
                                    <Progress strokeColor={{
                                        from: '#108ee9',
                                        to: '#87d068',
                                    }}
                                              status={'active'}
                                              percent={this.state.user.space_used} showInfo={false}/>
                                </div>
                                <SidebarMenu/>
                            </Sider>
                        </ShowAt>
                        {/*<Spin spinning={this.state.dataloading} tip={'Loading'}/>*/}
                        {this.state.dataloaded && <Layout className="site-layout">
                            <Header className="header">
                                <Space size={8} align="center">
                                    <ShowAt breakpoint={'small'}>
                                        <MenuFoldOutlined onClick={this.showDrawer}/>
                                    </ShowAt>
                                    <div className="logo">VideoHomes</div>
                                </Space>
                                <Space size={8} align="center" style={{float: "right"}}>
                                    <Button type="primary"
                                            onClick={event => window.location.hash = "#/upload"}><CloudUploadOutlined/> Upload
                                        Video</Button>

                                    <Dropdown overlay={this.notificationMenu()}>
                                        <Badge count={1} size={'md'}>
                                            <BellOutlined style={{fontSize: "20px"}} onClick={e => e.preventDefault()}/>
                                        </Badge>
                                    </Dropdown>
                                    <Dropdown overlay={this.profileMenu()}>
                                        <a onClick={(e) => e.preventDefault()}>
                                            <Avatar style={{marginTop: '-12px'}}
                                                    src={this.state.user.user_extra.profile_picture}/>
                                            {this.state.user.name}
                                        </a>
                                    </Dropdown>
                                </Space>
                            </Header>
                            {this.props.children}
                        </Layout>}
                    </Layout></BreakpointsProvider></Router>
        );
    }
}

export default React.memo(App);
