import React, {Component} from 'react';

import {Avatar, Button, Card, Col, Divider, Empty, Image, Layout, message, PageHeader, Popconfirm, Row} from 'antd';
import {CloudUploadOutlined, DeleteOutlined, EditOutlined, PlayCircleOutlined,} from '@ant-design/icons';
import axios from "axios";

const {Content} = Layout;

class Video extends Component {
    constructor(props) {
        super(props);
        this.state = {
            videos: [],
            approvedVideos: [],
            pendingVideos: [],
        }
        this.loadData = this.loadData.bind(this);
        this.deleteVideo = this.deleteVideo.bind(this);

    };

    loadData() {
        axios.get('/video')
            .then((res) => {
                console.log(res.data)
                this.setState({...res.data})
            })
            .catch((err) => {
                console.log(err)
            })
    }

    deleteVideo(id) {
        axios.delete('video/' + id)
            .then((res) => {
                let el = document.getElementById(`video-card-${id}`).remove()
            })
            .catch((err) => {
                console.log(err)
            })
    }

    componentDidMount() {
        this.loadData();
    }

    render() {
        return (
            <Content style={{padding: '20px 50px'}}>
                <div className="site-layout-content">
                    <PageHeader
                        className="site-page-header site-page-header-responsive"
                        onBack={() => window.location.hash = "#/"}
                        title="Video"
                    >
                        <Row gutter={16}>
                            <Col span={24}>
                                <h1>Listed Videos</h1>
                            </Col>
                        </Row>
                        <Divider/>
                        <Row gutter={16}>

                            {this.state.approvedVideos.length > 0 ? this.state.approvedVideos.map((item, k) => {
                                return <Col id={'video-card-' + item.id}
                                            offset={1}
                                            xs={24} sm={24} md={24} lg={8} xl={8}
                                            key={k}>
                                    <Card
                                        style={{width: "100%", marginBottom: '20px'}}
                                        cover={
                                            <Image
                                                src={`${window.VIDEO_APP.base_url}/storage/${item.thumbnail}`}
                                                fallback={'https://www.bigfishvideo.com/Samplesite/wp-content/plugins/video-thumbnails/default.jpg'}
                                            />

                                        }
                                        actions={[
                                            <PlayCircleOutlined onClick={
                                                () => {
                                                    window.location = window.VIDEO_APP.base_url + '/' + item.user.username + '/' + item.video_id
                                                }
                                            } key="play"/>,
                                            <EditOutlined key='edit' onClick={
                                                () => {
                                                    window.location = window.VIDEO_APP.base_url + '/dashboard#/edit_video/' + item.video_id
                                                }
                                            } key="edit"/>,
                                            <Popconfirm
                                                title="Are you sure delete this video?"
                                                onConfirm={() => this.deleteVideo(item.id)}
                                                onCancel={() => {
                                                    console.log('Cancelled')
                                                }}
                                                okText="Yes"
                                                cancelText="No"
                                            >
                                                <DeleteOutlined key="ellipsis"/>
                                            </Popconfirm>
                                        ]}
                                    >
                                        <Card.Meta
                                            avatar={<Avatar src={item.user.user_extra.profile_picture}/>}
                                            title={item.title}
                                            description={[
                                                <>
                                                    <span>{item.description}<br/></span>
                                                    <span> Category: {item.category.name}</span><br/>
                                                    <span> Views: {item.views_count}</span><br/>
                                                    <span> Duration: {Math.floor(item.duration / 60)}:{item.duration - Math.floor(item.duration / 60) * 60}</span>
                                                </>
                                            ]}
                                        />
                                    </Card>
                                </Col>
                            }) : <Col span={24}><Empty description={"No Video found"}><Button type="primary"
                                                                                              onClick={event => window.location.hash = "#/upload"}><CloudUploadOutlined/> Upload
                                Video</Button></Empty></Col>}
                        </Row>
                        <Divider/>
                        <Row gutter={16}>
                            <Col span={24}>
                                <h1>Pending Videos</h1>
                            </Col>
                        </Row>
                        <Divider/>
                        <Row gutter={16}>
                            {this.state.pendingVideos.length > 0 ? this.state.pendingVideos.map((item, k) => {
                                return <Col
                                    offset={1}
                                    xs={24} sm={24} md={24} lg={8} xl={8}
                                            key={k}>
                                    <Card
                                        style={{width: '100%',marginBottom:'20px'}}
                                        cover={
                                            <Image
                                                src={`${window.VIDEO_APP.base_url}/storage/${item.thumbnail}`}
                                                fallback={'https://www.bigfishvideo.com/Samplesite/wp-content/plugins/video-thumbnails/default.jpg'}
                                            />

                                        }
                                        actions={[
                                            <PlayCircleOutlined onClick={e => {
                                                location.href = `${window.VIDEO_APP.base_url}/${item.user.username}/${item.video_id}`;
                                            }} key='play'/>,
                                            <EditOutlined key="edit" onClick={e => {
                                                location.hash = `#edit_video/${item.video_id}`;
                                            }}/>,
                                            <Popconfirm
                                                title="Are you sure delete this task?"
                                                onConfirm={(e) => {
                                                    axios.delete(`video/${item.id}`).then(({data}) => {
                                                        message.success('Deleted');
                                                        this.loadData();
                                                    }).catch(error => message.error(error))

                                                }}
                                                onCancel={(e) => {
                                                    console.log(e);
                                                    message.error('Click on No');
                                                }}
                                                okText="Yes"
                                                cancelText="No"
                                            >
                                                <DeleteOutlined key="delete"/></Popconfirm>,
                                        ]}
                                    >
                                        <Card.Meta
                                            avatar={<Avatar src={item.user.user_extra.profile_picture}/>}
                                            title={item.title}
                                            description={[
                                                <>
                                                    <span>{item.description}<br/></span>
                                                    <span> Category: {item.category.name}</span><br/>
                                                    <span> Views: {item.views_count}</span><br/>
                                                    <span> Duration: {Math.floor(item.duration / 60)}:{item.duration - Math.floor(item.duration / 60) * 60}</span>
                                                </>
                                            ]}
                                        />
                                    </Card>
                                </Col>
                            }) : <Col span={24}><Empty description={"No Pending Video found"}/></Col>}
                        </Row>
                    </PageHeader>
                </div>
            </Content>
        );
    }
}

export default Video;
