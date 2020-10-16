import React, {Component} from 'react';

import {Button, Empty, Layout, PageHeader, Space, Table} from 'antd';
import {CloudUploadOutlined} from '@ant-design/icons';
import axios from "axios";

const {Content} = Layout;
const {Column, ColumnGroup} = Table;
const data = [
    {
        key: '1',
        firstName: 'John',
        lastName: 'Brown',
        age: 32,
        address: 'New York No. 1 Lake Park',
        tags: ['nice', 'developer'],
    },
    {
        key: '2',
        firstName: 'Jim',
        lastName: 'Green',
        age: 42,
        address: 'London No. 1 Lake Park',
        tags: ['loser'],
    },
    {
        key: '3',
        firstName: 'Joe',
        lastName: 'Black',
        age: 32,
        address: 'Sidney No. 1 Lake Park',
        tags: ['cool', 'teacher'],
    },
];

class Playlist extends Component {

    constructor(props) {
        super(props);
        this.state = {
            playlists: [{}],
            message: null,
            deleted: 0,
            mainPage: true,
            addPlaylist: false,
            editPlaylist: false,
            description: '',
            name: '',
            id: -1,
            added: 0,
            purpose: '',
            showAlert: false,
            AlertMessage: '',
            Alertvariant: '',
            columns: [{
                title: 'Name',
                dataIndex: 'name',
                key: 'name',
            }, {
                title: 'Description',
                dataIndex: 'description',
                key: 'description',
            }]
        }
        this.editPlaylist = this.editPlaylist.bind(this);
        this.deletePlaylist = this.deletePlaylist.bind(this);
        this.getPlaylist = this.getPlaylist.bind(this);
        this.createPlaylist = this.createPlaylist.bind(this);
    }

    componentDidMount() {
        this.getPlaylist();
    }

    getPlaylist() {
        axios.get('/playlist')
            .then((res) => {
                this.setState({playlists: res.data})
                console.log(this.state.playlists)
            })
            .catch((err) => {
                console.log(err)
            })
    }

    deletePlaylist(id, e) {
        axios.delete('playlist/' + id)
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
        let {name, description, purpose, id} = this.state;

        axios.put('/playlist/'+id, {name, description, purpose, id})
            .then((res) => {
                this.setState({added: res.data.added, mainPage: true, addPlaylist: false, editPlaylist: false,})
                this.getPlaylist()
                if (this.state.added) {

                    this.setState({showAlert: true, variant: 'primary', AlertMessage: 'Setting Saved'});

                } else
                    // alert('Some Error Occured')
                    this.setState({showAlert: true, variant: 'danger', AlertMessage: 'Some Error Occured'});

            })
            .catch((err) => {
                console.log(err)
            })
    }

    createPlaylist() {
        let {name, description, purpose, id} = this.state;

        axios.post('/playlist/', {name, description, purpose, id})
            .then((res) => {
                this.setState({added: res.data.added, mainPage: true, addPlaylist: false, editPlaylist: false,})
                this.getPlaylist()
                if (this.state.added) {

                    this.setState({showAlert: true, variant: 'primary', AlertMessage: 'Setting Saved'});

                } else
                    // alert('Some Error Occured')
                    this.setState({showAlert: true, variant: 'danger', AlertMessage: 'Some Error Occured'});

            })
            .catch((err) => {
                console.log(err)
            })
    }

    render() {
        return (
            <Content style={{padding: '20px 50px'}}>
                <div className="site-layout-content">
                    <PageHeader
                        className="site-page-header site-page-header-responsive"
                        onBack={() => window.location.hash = "#/"}
                        title="Playlist"
                    >
                        {this.state.playlists.length > 0 ?
                            <Table dataSource={this.state.playlists}>
                                <Column title="Name" dataIndex="name" key="name"/>
                                <Column title="Description" dataIndex="description" key="description"/>
                                <Column
                                    title="Action"
                                    key="action"
                                    render={(text, record) => (
                                        <Space size="middle">
                                            <Button type="primary"
                                                    onClick={this.editPlaylist}><CloudUploadOutlined/> Edit</Button>
                                            <Button type="primary"
                                                    onClick={() => {
                                                        this.deletePlaylist(text.id)
                                                    }}><CloudUploadOutlined/> Delete</Button>
                                        </Space>
                                    )}
                                />
                            </Table> : <Empty description={"No Playlist found"}><Button type="primary"
                                                                                        onClick={this.createPlaylist}><CloudUploadOutlined/> Create</Button></Empty>}
                    </PageHeader>

                </div>
            </Content>
        );
    }
}

export default Playlist;
