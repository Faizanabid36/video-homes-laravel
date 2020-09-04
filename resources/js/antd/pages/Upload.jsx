import React, { Component } from 'react';

import {Upload, message,
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
    Tabs, Col,Table,Steps
} from 'antd';
import { CloudUploadOutlined as InboxOutlined, CloudUploadOutlined,UserOutlined, SolutionOutlined, LoadingOutlined, SmileOutlined,EditOutlined, EllipsisOutlined, SettingOutlined } from '@ant-design/icons';

const {Content} = Layout;
const { Step } = Steps;
const { Dragger } = Upload;

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
class UploadPage extends Component {
    constructor(props) {
        super(props);
        this.state = {
            current: 0,
            steps:[
                {
                    status:"upload",
                    title: 'Upload',
                    description:"This is a description.",
                    subTitle:"This is a Sub description.",
                    content: (<Dragger {...uploadProps}>
                        <p className="ant-upload-drag-icon">
                            <InboxOutlined />
                        </p>
                        <p className="ant-upload-text">Click or drag file to this area to upload</p>
                        <p className="ant-upload-hint">
                            Support for a single or bulk upload. Strictly prohibit from uploading company data or other
                            band files
                        </p>
                    </Dragger>),
                    icon:<CloudUploadOutlined />
                },
            ],
        };
        this.next = this.next.bind(this);
        this.prev = this.prev.bind(this);
    }

    next() {
        const current = this.state.current + 1;
        this.setState({ current });
    }

    prev() {
        const current = this.state.current - 1;
        this.setState({ current });
    }
    render() {
        const self = this;
        const {current} = this.state;
        const uploadProps = {
            name: 'file',
            multiple: false,
            action: 'https://www.mocky.io/v2/5cc8019d300000980a055e76',
            onChange(info) {
                const { status } = info.file;
                console.log(status);
                if (status === 'uploading'){
                    self.setState({current:1});
                    console.log("I am uploading");
                }
                if (status !== 'uploading') {

                    console.log(info.file, info.fileList);
                }
                if (status === 'done') {
                    self.next();
                    message.success(`${info.file.name} file uploaded successfully.`);
                } else if (status === 'error') {
                    self.setState({current:0});
                    message.error(`${info.file.name} file upload failed.`);
                }
            },
        };
        // const steps = [
        //     {
        //         status:"upload",
        //         title: 'Upload',
        //         description:"This is a description.",
        //         subTitle:"This is a Sub description.",
        //         content: (<Dragger {...uploadProps}>
        //             <p className="ant-upload-drag-icon">
        //                 <InboxOutlined />
        //             </p>
        //             <p className="ant-upload-text">Click or drag file to this area to upload</p>
        //             <p className="ant-upload-hint">
        //                 Support for a single or bulk upload. Strictly prohibit from uploading company data or other
        //                 band files
        //             </p>
        //         </Dragger>),
        //         icon:<CloudUploadOutlined />
        //     },
        //     {
        //         status:"wait",
        //         title: 'Progress',
        //         description:"This is a description.",
        //         subTitle:"This is a Sub description.",
        //         content: (<h1>Second-content</h1>),
        //         icon:<LoadingOutlined />
        //     },
        //     {
        //         status:"finished",
        //         title: 'Finished',
        //         description:"This is a description.",
        //         subTitle:"This is a Sub description.",
        //         content: (<h1>Third-content</h1>),
        //         icon:<SmileOutlined />
        //     },
        // ];
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
                                <Step status={item.status} description={item.description} key={item.title} title={item.title} icon={item.icon} />
                            ))}
                        </Steps>
                        <div className="steps-content">{steps[current].content}</div>
                        <div className="steps-action">
                            {current < steps.length - 1 && (
                                <Button type="primary" onClick={() => this.next()}>
                                    Next
                                </Button>
                            )}
                            {current === steps.length - 1 && (
                                <Button type="primary" onClick={() => message.success('Processing complete!')}>
                                    Done
                                </Button>
                            )}
                            {current > 0 && (
                                <Button style={{ margin: '0 8px' }} onClick={() => this.prev()}>
                                    Previous
                                </Button>
                            )}
                        </div>
                    </PageHeader>

                </div>
            </Content>
        );
    }
}

export default UploadPage;
