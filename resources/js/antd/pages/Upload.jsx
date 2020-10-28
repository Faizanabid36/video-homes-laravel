import React, {Component} from 'react';

import {Layout, message, PageHeader, Steps, Upload} from 'antd';
import {CloudUploadOutlined as InboxOutlined} from '@ant-design/icons';

const {Content} = Layout;
const {Step} = Steps;
const {Dragger} = Upload;


class UploadPage extends Component {
    constructor(props) {
        super(...arguments);
        this.onUpload = this.onUpload.bind(this);
    }
    onUpload(info) {
        const self = this;
        const {status} = info.file;
        //console.log(status);
        if (status === 'uploading') {
            // self.setState({current: 1});
            console.log("I am uploading");
        }
        if (status !== 'uploading') {
            console.log(info.file, info.fileList);
        }
        if (status === 'done') {
            // self.next();
            console.log(info);
            message.success(info.file.response.message);
            window.location.hash = "#/edit_video/"+info.file.response.video.video_id
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
                        <Dragger accept={".mov,.mp4,.wmv,.avi,.3gp,.flv"} headers={{ 'X-CSRF-TOKEN':window.document.head.querySelector('meta[name="csrf-token"]').content}} name='video' action={`${window.VIDEO_APP.base_url}/video`} onChange={this.onUpload}>
                            <p className="ant-upload-drag-icon">
                                <InboxOutlined/>
                            </p>
                            <p className="ant-upload-text">Click or drag file to this area to upload</p>
                        </Dragger>
                    </PageHeader>
                </div>
            </Content>
        );
    }
}

export default UploadPage;
