import React, {Component} from 'react';

import {Button, Form, Layout, message, PageHeader, Radio, Spin, Table, Tabs} from 'antd';

import {LoadingOutlined, PlusOutlined, UserOutlined} from '@ant-design/icons';
import axios from "axios";

const {Content} = Layout;
const {Column, ColumnGroup} = Table;
const {TabPane} = Tabs;

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
const renderTitle = title => (
    <span>
    {title}
        <a
            style={{
                float: 'right',
            }}
            href="https://www.google.com/search?q=antd"
            target="_blank"
            rel="noopener noreferrer"
        >
      more
    </a>
  </span>
);

const renderItem = (title, count) => ({
    value: title,
    label: (
        <div
            style={{
                display: 'flex',
                justifyContent: 'space-between',
            }}
        >
            {title}
            <span>
        <UserOutlined/> {count}
      </span>
        </div>
    ),
});

function getBase64(img, callback) {
    const reader = new FileReader();
    reader.addEventListener('load', () => callback(reader.result));
    reader.readAsDataURL(img);
}

class GlobalVideoSettings extends Component {
    constructor(props) {
        super(...arguments);
        this.state = {
            dataloading: false,
            loading: false,
            user: {},
            old_password: '',
            new_password: '',
            confirm_password: '',
            categories: [],
            fileList: [
                {
                    uid: '-1',
                    name: 'image.png',
                    status: 'done',
                    url: 'https://zos.alipayobjects.com/rmsportal/jkjgkEfvpUPVyRjUImniVslZfWPnJuuZ.png',
                },
            ]
        };
        this.formRef = React.createRef();
        this.handleChange = this.handleChange.bind(this);
        this.beforeUpload = this.beforeUpload.bind(this);
        this.defaultValue = this.defaultValue.bind(this);
        this.handleSubmit = this.handleSubmit.bind(this);
        this.handleChangeInput = this.handleChangeInput.bind(this);
    }


    handleSubmit(e) {
        let {user} = this.state
        axios.post('update_video_global_settings', {...user})
            .then((res) => {
                if (res.data.message)
                    message.success(res.data.message)
            })
            .catch((err) => {
                if (err.response.data.errors)
                    message.error('Some Error Occurred');
            })
    }

    handleChangeInput(e, key = false) {
        let {user} = this.state;
        user[key || e.target.name] = e.target.value;
        this.setState({user});
        console.log(this.state.user)
    }

    defaultValue(key) {
        return this.state.user[key] || "";
    }

    beforeUpload(file) {
        const isJpgOrPng = file.type === 'image/jpeg' || file.type === 'image/png';
        if (!isJpgOrPng) {
            message.error('You can only upload JPG/PNG file!');
        }
        const isLt2M = file.size / 1024 / 1024 < 2;
        if (!isLt2M) {
            message.error('Image must smaller than 2MB!');
        }
        return isJpgOrPng && isLt2M;
    }

    handleChange(info, key = false) {
        console.log(info);
        if (info.file.status === 'uploading') {
            console.log(info.file.status, info);
            this.setState({loading: true});
            return;
        }
        let self = this;
        if (info.file.status === 'done') {
            // Get this url from response in real world.
            getBase64(info.file.originFileObj, imageUrl => {

                    let {user} = self.state;
                    if (user[key]) {
                        user[key] = imageUrl;
                        message.success(key.replace("_", " ") + " has been updated");
                        self.setState({
                            user,
                            loading: false,
                        })
                    }
                },
            );
        }
    };


    componentDidMount() {
        axios.get('profile')
            .then(({data}) => {
                console.log(data)
                this.setState({...data}, () => {
                    this.setState({dataloading: true})
                })
            }).catch((err) => {
            console.log(err)
        })
    }

    render() {
        const {loading, imageUrl} = this.state;
        const uploadButton = (
            <div>
                {loading ? <LoadingOutlined/> : <PlusOutlined/>}
                <div style={{marginTop: 8}}>Upload</div>
            </div>
        );

        return (
            <Content style={{padding: '20px 50px'}}>
                <div className="site-layout-content">
                    <PageHeader
                        className="site-page-header site-page-header-responsive"
                        onBack={() => null}
                        title="Global Video Settings"
                    >
                        <Spin spinning={!this.state.dataloading} tip={'Loading'}/>
                        {this.state.dataloading &&
                        <Form
                            ref={this.formRef} name="control-ref" onFinish={this.onFinish}
                            layout="vertical"
                        >
                            <Form.Item name="default_video_state" label="Default Video State">
                                <Radio.Group>
                                    <Radio defaultChecked={this.state.user.default_video_state == 'public'}
                                           onChange={(e) => this.handleChangeInput(e, 'default_video_state')}
                                           value="public">Active</Radio>
                                    <Radio defaultChecked={this.state.user.default_video_state == 'private'}
                                           onChange={(e) => this.handleChangeInput(e, 'default_video_state')}
                                           value="private">Inactive</Radio>
                                </Radio.Group>
                            </Form.Item>
                            <Form.Item name="share_buttons" label="Share Button">
                                <Radio.Group>
                                    <Radio defaultChecked={this.state.user.share_buttons == 'enabled'}
                                           onChange={(e) => this.handleChangeInput(e, 'share_buttons')}
                                           value="enabled">Enabled</Radio>
                                    <Radio defaultChecked={this.state.user.share_buttons == 'disabled'}
                                           onChange={(e) => this.handleChangeInput(e, 'share_buttons')}
                                           value="disabled">Disabled</Radio>
                                </Radio.Group>
                            </Form.Item>
                            <Form.Item name="display_suggested_videos" label="Up Next / Suggested Videos">
                                <Radio.Group>
                                    <Radio defaultChecked={this.state.user.display_suggested_videos == 'enabled'}
                                           onChange={(e) => this.handleChangeInput(e, 'display_suggested_videos')}
                                           value="enabled">Enabled</Radio>
                                    <Radio defaultChecked={this.state.user.display_suggested_videos == 'disabled'}
                                           onChange={(e) => this.handleChangeInput(e, 'display_suggested_videos')}
                                           value="disabled">Disabled</Radio>
                                </Radio.Group>
                            </Form.Item>
                            <Form.Item name="distribution_type" label="Video distribution Type">
                                <Radio.Group>
                                    <Radio defaultChecked={this.state.user.distribution_type == 'uploaded'}
                                           onChange={(e) => this.handleChangeInput(e, 'distribution_type')}
                                           value="uploaded">Uploaded</Radio>
                                    <Radio defaultChecked={this.state.user.distribution_type == 'embedded'}
                                           onChange={(e) => this.handleChangeInput(e, 'distribution_type')}
                                           value="embedded">Embedded</Radio>
                                </Radio.Group>
                            </Form.Item>

                            <Button onClick={(e) => {
                                this.handleSubmit()
                            }}>
                                Save
                            </Button>
                        </Form>}
                    </PageHeader>

                </div>
            </Content>
        );
    }
}

export default GlobalVideoSettings;
