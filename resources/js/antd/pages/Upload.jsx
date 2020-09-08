import React, { Component } from 'react';

import {

    Upload, message,
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
    Progress,
    Tabs, Col, Table, Steps
} from 'antd';
import {
    CloudUploadOutlined as InboxOutlined,
    CloudUploadOutlined,
    UserOutlined,
    SolutionOutlined,
    LoadingOutlined,
    SmileOutlined,
    EditOutlined,
    EllipsisOutlined,
    SettingOutlined
} from '@ant-design/icons';

const {Content} = Layout;
const {Step} = Steps;
const {Dragger} = Upload;


class UploadPage extends Component {
    constructor(props) {
        super(props);
        this.state = {
            current: 0,
            steps: [
                {
                    status: "upload",
                    title: 'Upload',
                    description: "This is a description.",
                    subTitle: "This is a Sub description.",
                    content: (<Dragger name='file' action={`${window.VIDEO_APP.base_url}/profile`} onChange={this.onChange}>
                        <p className="ant-upload-drag-icon">
                            <InboxOutlined/>
                        </p>
                        <p className="ant-upload-text">Click or drag file to this area to upload</p>
                        <p className="ant-upload-hint">
                            Support for a single or bulk upload. Strictly prohibit from uploading company data or other
                            band files
                        </p>
                    </Dragger>),
                    icon: <CloudUploadOutlined/>
                },
            ],
        };
        this.next = this.next.bind(this);
        this.prev = this.prev.bind(this);
        this.onChange = this.onChange.bind(this);
    }
    onChange(info) {
        const self = this;
        const {status} = info.file;
        console.log(status);
        if (status === 'uploading') {
            self.setState({current: 1});
            console.log("I am uploading");
        }
        if (status !== 'uploading') {

            console.log(info.file, info.fileList);
        }
        if (status === 'done') {
            self.next();
            message.success(`${info.file.name} file uploaded successfully.`);
        } else if (status === 'error') {
            self.setState({current: 0});
            message.error(`${info.file.name} file upload failed.`);
        }
    }
    next() {
        const current = this.state.current + 1;
        this.setState({current});
    }

    prev() {
        const current = this.state.current - 1;
        this.setState({current});
    }

    render() {

        const {current,steps} = this.state;

        return (
            <Content style={{padding: '20px 50px'}}>
                <div className="site-layout-content">
                    <PageHeader
                        className="site-page-header site-page-header-responsive"
                        onBack={() => null}
                        title="Playlist"
                    >
                        <Steps>
                            {steps.map(item => (
                                <Step status={item.status} description={item.description} key={item.title}
                                      title={item.title} icon={item.icon}/>
                            ))}
                        </Steps>
                        <div className="steps-content">{steps[current].content}</div>
                        {/*<div className="steps-action">*/}
                        {/*    {current < steps.length - 1 && (*/}
                        {/*        <Button type="primary" onClick={() => this.next()}>*/}
                        {/*            Next*/}
                        {/*        </Button>*/}
                        {/*    )}*/}
                        {/*    {current === steps.length - 1 && (*/}
                        {/*        <Button type="primary" onClick={() => message.success('Processing complete!')}>*/}
                        {/*            Done*/}
                        {/*        </Button>*/}
                        {/*    )}*/}
                        {/*    {current > 0 && (*/}
                        {/*        <Button style={{margin: '0 8px'}} onClick={() => this.prev()}>*/}
                        {/*            Previous*/}
                        {/*        </Button>*/}
                        {/*    )}*/}
                        {/*</div>*/}
                    </PageHeader>

                </div>
            </Content>
        );
    }
}

export default UploadPage;
