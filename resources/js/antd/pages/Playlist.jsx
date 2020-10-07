import React, { Component } from 'react';

import {
    Image,
    Card,
    Drawer,
    Divider,
    PageHeader,
    Menu,
    Dropdown,
    Button,
    Space,
    Tag,
    Typography,
    Row,
    Layout,
    Badge,
    Avatar,
    notification,
    message,
    Progress,
    Tabs, Col, Table, Empty,
    Form, Input
} from 'antd';
import { CloudUploadOutlined, EditOutlined, EllipsisOutlined, SettingOutlined } from '@ant-design/icons';
import axios from "axios";

const {Content} = Layout;
const {Column, ColumnGroup} = Table;


class Playlist extends Component {

    constructor(props) {
        super(props);
        this.state = {
            action: null,
            playlists: [{}],
            name:'',
            description:'',
            id:'',
        }
        this.editPlaylist = this.editPlaylist.bind(this);
        this.deletePlaylist = this.deletePlaylist.bind(this);
        this.getPlaylist = this.getPlaylist.bind(this);
        this.createPlaylist = this.createPlaylist.bind(this);
        this._render = this._render.bind(this);
    }

    getPlaylist() {
        axios.get('/playlist')
            .then((res) => {
                this.setState({playlists: res.data})
            })
            .catch((err) => {
                console.log(err)
            })
    }

    deletePlaylist(id, e) {

        axios.delete('/playlist/' + id)
            .then((res) => {
                console.log(res);
                this.setState({deleted: res.data.deleted})
                this.getPlaylist();
            })
            .catch((err) => {
                console.log(err)
            })

    }

    editPlaylist(e) {
        let {name, description} = this.state;

        axios.put('/playlist/' + id, {name, description})
            .then(({data}) => {
                this.getPlaylist()
                this.setState({action: null})
                if (data.status) {
                    message.success(data.message);
                } else {
                    message.error(data.message);
                }


            })
            .catch((err) => {
                message.error(err);
            })
    }
    componentDidMount() {
        this.getPlaylist();
    }

    createPlaylist() {
        let {name, description} = this.state;

        axios.post('/playlist/', {name, description})
            .then(({data}) => {
                this.getPlaylist()
                this.setState({action: null})
                if (data.status) {
                    message.success(data.message);
                } else {
                    message.error(data.message);
                }


            })
            .catch((err) => {
                message.error(err);
            })
    }

    _render() {
        const layout = {
            labelCol: {
                span: 8,
            },
            wrapperCol: {
                span: 16,
            },
        };
        switch (this.state.action) {

            case "create":
                return <>
                    <Form
                        {...layout}
                        name="basic"
                        initialValues={{remember: true}}
                        onFinish={this.createPlaylist}
                        onFinishFailed={e => {
                            message.error("Something went wrong");
                        }}
                    >
                        <Form.Item
                            label="Name"
                            name="name"
                            rules={[{required: true, message: 'Please input your username!'}]}
                            onChange={e => this.setState({name: e.target.value})}
                        >
                            <Input/>
                        </Form.Item>
                        <Form.Item label={'Description'} name='description'>
                            <Input.TextArea onChange={e => this.setState({description: e.target.value})} rows={4}/>
                        </Form.Item>
                        <Form.Item>
                            <Button type="primary" htmlType="submit">
                                Submit
                            </Button>
                        </Form.Item>
                    </Form>
                </>;
            case "edit":
                return <>
                    <Form
                        {...layout}
                        name="basic"
                        initialValues={{remember: true}}
                        onFinish={this.editPlaylist}
                        onFinishFailed={e => {
                            message.error("Something went wrong");
                        }}
                    >
                        <Form.Item
                            label="Name"
                            name="name"
                            rules={[{required: true, message: 'Please input playlist name!'}]}
                        >
                            <Input onChange={e => this.setState({name: e.target.value})}
                                   defaultValue={this.state.name}/>
                        </Form.Item>
                        <Form.Item label={'Description'} name='description'>
                            <Input.TextArea onChange={e => this.setState({description: e.target.value})} rows={4}
                                            defaultValue={this.state.description}/>
                        </Form.Item>
                        <Form.Item>
                            <Button type="primary" htmlType="submit">
                                Submit
                            </Button>
                        </Form.Item>
                    </Form>
                </>;
            case "default":
                return this.state.playlists.length > 1 ? <Table dataSource={this.state.playlists}>
                    <Column title="Name" dataIndex="name" key="name"/>
                    <Column title="Description" dataIndex="description" key="description"/>
                    <Column
                        title="Action"
                        key="action"
                        render={(text, record) => (
                            <Space size="middle" key={text.id}>
                                <Button type="primary"
                                        onClick={e => this.setState({
                                            action: 'edit',
                                            editId: text.id
                                        })}><CloudUploadOutlined/> Edit</Button>
                                <Button type="primary"
                                        onClick={e => this.deletePlaylist(text.id)}><CloudUploadOutlined/> Delete</Button>
                            </Space>
                        )}
                    />
                </Table> : <Empty description={"No Playlist found"}><Button type="primary"
                                                                            onClick={e => this.setState({action: 'create'})}><CloudUploadOutlined/> Create</Button></Empty>;
        }
    }

    render() {
        return (
            <Content style={{padding: '20px 50px'}}>
                <div className="site-layout-content">
                    <PageHeader
                        className="site-page-header site-page-header-responsive"
                        onBack={() => window.location.hash = "#/"}
                        title={(this.state.action ? this.state.action + " " : "") + 'Playlist'}
                    >
                        {this._render()}
                    </PageHeader>

                </div>
            </Content>
        );
    }
}

export default Playlist;
