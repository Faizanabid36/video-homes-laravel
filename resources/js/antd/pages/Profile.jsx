import React, { Component } from 'react';

import {
    Input,
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
    Tabs, Col, Table, Form, Radio, Select,AutoComplete,Upload
} from 'antd';
import MaskedInput from 'antd-mask-input'
import ImgCrop from 'antd-img-crop';

import { UserOutlined, EllipsisOutlined, SettingOutlined } from '@ant-design/icons';

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
        <UserOutlined /> {count}
      </span>
        </div>
    ),
});
function getBase64(img, callback) {
    const reader = new FileReader();
    reader.addEventListener('load', () => callback(reader.result));
    reader.readAsDataURL(img);
}

function beforeUpload(file) {
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
class Profile extends Component {
    constructor(props) {
        super(...arguments);
        this.state = {
            loading: false,
            fileList:[
                {
                    uid: '-1',
                    name: 'image.png',
                    status: 'done',
                    url: 'https://zos.alipayobjects.com/rmsportal/jkjgkEfvpUPVyRjUImniVslZfWPnJuuZ.png',
                },
            ]
        };
        this.formRef = React.createRef();
        this.onGenderChange = this.onGenderChange.bind(this);
        this.onFinish = this.onFinish.bind(this);
        this.onReset = this.onReset.bind(this);
        this.onFill = this.onFill.bind(this);
    }
    handleChange(info) {
        if (info.file.status === 'uploading') {
            this.setState({ loading: true });
            return;
        }
        if (info.file.status === 'done') {
            // Get this url from response in real world.
            getBase64(info.file.originFileObj, imageUrl =>
                this.setState({
                    imageUrl,
                    loading: false,
                }),
            );
        }
    };
    onChange({ fileList }) {
        this.setState({fileList});
    };
    onGenderChange() {
        this.formRef.current.setFieldsValue({
            note: `Hi, ${value === 'male' ? 'man' : 'lady'}!`,
        });
    };

    onFinish() {
        console.log(values);
    };

    onReset() {
        this.formRef.current.resetFields();
    };

    onFill() {
        this.formRef.current.setFieldsValue({
            note: 'Hello world!',
            gender: 'male',
        });
    };

    render() {
        const onPreview = async file => {
            let src = file.url;
            if (!src) {
                src = await new Promise(resolve => {
                    const reader = new FileReader();
                    reader.readAsDataURL(file.originFileObj);
                    reader.onload = () => resolve(reader.result);
                });
            }
            const image = new Image();
            image.src = src;
            const imgWindow = window.open(src);
            imgWindow.document.write(image.outerHTML);
        };


        return (
            <Content style={{padding: '20px 50px'}}>
                <div className="site-layout-content">
                    <PageHeader
                        className="site-page-header site-page-header-responsive"
                        onBack={() => null}
                        title="Profile"
                    >
                        <Form
                            ref={this.formRef} name="control-ref" onFinish={this.onFinish}

                            layout="vertical"
                        >
                            <Tabs defaultActiveKey="1" tabPosition="left" >
                                <TabPane tab="Tab 1" key="1">
                                    <Form.Item label="Field A" required rules={[
                                        {
                                            required: true,
                                        },
                                    ]}>
                                        <Input placeholder="input placeholder"/>
                                    </Form.Item>

                                    <div style={{marginBottom: 16}}>
                                        <Form.Item label="Field A" required rules={[
                                            {
                                                required: true,
                                            },
                                        ]}>
                                            <Input addonBefore="http://" defaultValue="mysite"/>
                                        </Form.Item>
                                        <Form.Item label="Field C" required rules={[
                                            {
                                                required: true,
                                            },
                                        ]}>
                                            <MaskedInput mask="111-111-1111" name="card" size="20" />
                                        </Form.Item>
                                        <Form.Item label="Field C" required rules={[
                                            {
                                                required: true,
                                            },
                                        ]}>
                                            <AutoComplete
                                                style={{
                                                    width: 200,
                                                }}
                                                options={[
                                                    {
                                                        value: 'Burns Bay Road',
                                                    },
                                                    {
                                                        value: 'Downing Street',
                                                    },
                                                    {
                                                        value: 'Wall Street',
                                                    },
                                                ]}
                                                placeholder="try to type `b`"
                                                filterOption={(inputValue, option) =>
                                                    option.value.toUpperCase().indexOf(inputValue.toUpperCase()) !== -1
                                                }
                                            />
                                        </Form.Item>
                                        <Form.Item label="Field C" required rules={[
                                            {
                                                required: true,
                                            },
                                        ]}>
                                            <AutoComplete
                                                dropdownClassName="certain-category-search-dropdown"
                                                dropdownMatchSelectWidth={500}
                                                style={{
                                                    width: 250,
                                                }}
                                                options={[
                                                    {
                                                        label: renderTitle('Libraries'),
                                                        options: [renderItem('AntDesign', 10000), renderItem('AntDesign UI', 10600)],
                                                    },
                                                    {
                                                        label: renderTitle('Solutions'),
                                                        options: [renderItem('AntDesign UI FAQ', 60100), renderItem('AntDesign FAQ', 30010)],
                                                    },
                                                    {
                                                        label: renderTitle('Articles'),
                                                        options: [renderItem('AntDesign design language', 100000)],
                                                    },
                                                ]}
                                            >
                                                <Input.Search size="large" placeholder="input here" />
                                            </AutoComplete>
                                        </Form.Item>
                                        <ImgCrop rotate>
                                            <Upload
                                                action="https://www.mocky.io/v2/5cc8019d300000980a055e76"
                                                listType="picture-card"
                                                fileList={this.state.fileList}
                                                onChange={onChange}
                                                onPreview={onPreview}
                                            >
                                                {this.state.fileList.length < 5 && '+ Upload'}
                                            </Upload>
                                        </ImgCrop>
                                    </div>
                                </TabPane>
                                <TabPane tab="Tab 2" key="2">
                                    Content of tab 2
                                </TabPane>
                                <TabPane tab="Tab 3" key="3">
                                    Content of tab 3
                                </TabPane>
                            </Tabs>
                        </Form>
                    </PageHeader>

                </div>
            </Content>
        );
    }
}

export default Profile;
