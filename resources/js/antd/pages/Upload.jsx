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
        };

        this.onUpload = this.onUpload.bind(this);
    }
    onUpload(info) {
        const self = this;
        const {status} = info.file;
        console.log(status);
        if (status === 'uploading') {
            // self.setState({current: 1});
            console.log("I am uploading");
        }
        if (status !== 'uploading') {

            console.log(info.file, info.fileList);
        }
        if (status === 'done') {
            // self.next();
            message.success(`${info.file.name} file uploaded successfully.`);
        } else if (status === 'error') {
            // self.setState({current: 0});
            message.error(`${info.file.name} file upload failed.`);
        }
    }


    render() {


        return (
            <Content style={{padding: '20px 50px'}}>
                <div className="site-layout-content">
                    <PageHeader
                        className="site-page-header site-page-header-responsive"
                        onBack={() => null}
                        title="Upload Video"
                    >
                        <Dragger accept={".mov,.mp4,.wmv,.avi,.3gp,.flv"} headers={{ 'X-CSRF-TOKEN':window.document.head.querySelector('meta[name="csrf-token"]').content}} name='video' action={`${window.VIDEO_APP.base_url}/upload-video`} onChange={this.onUpload}>
                            <p className="ant-upload-drag-icon">
                                <InboxOutlined/>
                            </p>
                            <p className="ant-upload-text">Click or drag file to this area to upload</p>
                            {/*<p className="ant-upload-hint">*/}
                            {/*    Support for a single or bulk upload. Strictly prohibit from uploading company data or other*/}
                            {/*    band files*/}
                            {/*</p>*/}
                        </Dragger>
                    </PageHeader>

                </div>
            </Content>
        );
    }
}

export default UploadPage;
