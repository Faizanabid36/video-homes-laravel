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
import GooglePlacesAutocomplete, { geocodeByAddress } from "react-google-places-autocomplete";

import { UserOutlined, EllipsisOutlined, SettingOutlined,PlusOutlined,LoadingOutlined } from '@ant-design/icons';
import { Editor } from "@tinymce/tinymce-react";

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
        this.onChange = this.onChange.bind(this);
        this.handleChange = this.handleChange.bind(this);
        this.beforeUpload = this.beforeUpload.bind(this);
        this.defaultValue = this.defaultValue.bind(this);
        this.handleChangeInput = this.handleChangeInput.bind(this);
    }
    handleChangeInput(e, key = false) {
        let {user} = this.state;
        user[key || e.target.name] = key ? e : e.target.value;
        this.setState({user});
    }
    defaultValue(key) {
        return this.state.user[key] || null;
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
        const { loading, imageUrl } = this.state;
        const uploadButton = (
            <div>
                {loading ? <LoadingOutlined /> : <PlusOutlined />}
                <div style={{ marginTop: 8 }}>Upload</div>
            </div>
        );

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
                                    <Form.Item label="Full Name" required rules={[
                                        {
                                            required: true,
                                        },
                                    ]}>
                                        <Input placeholder="Full Name"/>
                                    </Form.Item>

                                    <Form.Item label="Company Name" required rules={[
                                        {
                                            required: true,
                                        },
                                    ]}>
                                        <Input placeholder="Company Name"/>
                                    </Form.Item>

                                    <Form.Item label="Website" required>
                                        <Input addonBefore="https://" placeholder="Website"/>
                                    </Form.Item>
                                    <Form.Item label="Facebook" required>
                                        <Input addonBefore="https://www.facebook.com/" placeholder="Facebook"/>
                                    </Form.Item>
                                    <Form.Item label="Twitter" required>
                                        <Input addonBefore="https://www.twiiter.com/" placeholder="Twitter"/>
                                    </Form.Item>
                                    <Form.Item label="Instagram" required>
                                        <Input addonBefore="https://www.instagram.com/" placeholder="Instagram"/>
                                    </Form.Item>
                                    <Form.Item label="About/Bio">
                                        <Editor
                                            apiKey="rlsbsechuy5zwieakwp79flrto7ipmojgummzxwwjbbcbtye"
                                            name="bio"
                                            // initialValue={this.defaultValue('bio')}
                                            init={{
                                                height: 250,
                                                menubar: false,
                                                plugins: [
                                                    'advlist autolink lists link image charmap print preview anchor',
                                                    'searchreplace visualblocks code fullscreen',
                                                    'insertdatetime media table paste code help wordcount'
                                                ],
                                                toolbar:
                                                    'undo redo | formatselect | bold italic backcolor | \
                                                    alignleft aligncenter alignright alignjustify | \
                                                    bullist numlist outdent indent | removeformat | help'
                                            }}
                                            onEditorChange={(content, editor) => this.handleChangeInput(content, 'bio')}
                                        />
                                    </Form.Item>

                                    <Form.Item label="License" required rules={[
                                        {
                                            required: true,
                                        },
                                    ]}>
                                        <MaskedInput placeholder="License" mask="#######" name="license_no" size="7" />
                                    </Form.Item>

                                    <div style={{marginBottom: 16}}>
                                        <Form.Item label="Personal URL" required rules={[
                                            {
                                                required: true,
                                            },
                                        ]}>
                                            <Input placeholder="username" addonBefore={`${window.VIDEO_APP.base_url}/`} defaultValue="mysite"/>
                                        </Form.Item>
                                        <Form.Item label="Direct Phone" required rules={[
                                            {
                                                required: true,
                                            },
                                        ]}>
                                            <MaskedInput placeholder="Direct Phone" mask="111-111-1111" name="direct_phone" size="20" />
                                        </Form.Item>
                                        <Form.Item label="Office Phone" required rules={[
                                            {
                                                required: true,
                                            },
                                        ]}>
                                            <MaskedInput  placeholder="Office Phone" mask="111-111-1111" name="office_phone" size="20" />
                                        </Form.Item>
                                        <Form.Item label="Address" required rules={[
                                            {
                                                required: true,
                                            },
                                        ]}>
                                            <GooglePlacesAutocomplete
                                                // initialValue={this.defaultValue('address')}
                                                autocompletionRequest={{
                                                    componentRestrictions: {
                                                        country: ['us'],
                                                    }
                                                }}
                                                onSelect={({description}) => {
                                                    geocodeByAddress(description)
                                                        .then((results) => {
                                                            let {user} = this.state;
                                                            user.address = description;
                                                            user.location_latitude = results[0].geometry.location.lat();
                                                            user.location_longitude = results[0].geometry.location.lng();
                                                            this.setState({user});
                                                        })
                                                        .catch(error => console.error(error));
                                                }}

                                                inputClassName="ant-input"
                                            />

                                        </Form.Item>

                                        {/*<Form.Item label="Field C" required rules={[*/}
                                        {/*    {*/}
                                        {/*        required: true,*/}
                                        {/*    },*/}
                                        {/*]}>*/}
                                        {/*    <AutoComplete*/}
                                        {/*        style={{*/}
                                        {/*            width: 200,*/}
                                        {/*        }}*/}
                                        {/*        options={[*/}
                                        {/*            {*/}
                                        {/*                value: 'Burns Bay Road',*/}
                                        {/*            },*/}
                                        {/*            {*/}
                                        {/*                value: 'Downing Street',*/}
                                        {/*            },*/}
                                        {/*            {*/}
                                        {/*                value: 'Wall Street',*/}
                                        {/*            },*/}
                                        {/*        ]}*/}
                                        {/*        placeholder="try to type `b`"*/}
                                        {/*        filterOption={(inputValue, option) =>*/}
                                        {/*            option.value.toUpperCase().indexOf(inputValue.toUpperCase()) !== -1*/}
                                        {/*        }*/}
                                        {/*    />*/}
                                        {/*    <AutoComplete*/}
                                        {/*        dropdownClassName="certain-category-search-dropdown"*/}
                                        {/*        dropdownMatchSelectWidth={500}*/}
                                        {/*        style={{*/}
                                        {/*            width: 250,*/}
                                        {/*        }}*/}
                                        {/*        options={[*/}
                                        {/*            {*/}
                                        {/*                label: renderTitle('Libraries'),*/}
                                        {/*                options: [renderItem('AntDesign', 10000), renderItem('AntDesign UI', 10600)],*/}
                                        {/*            },*/}
                                        {/*            {*/}
                                        {/*                label: renderTitle('Solutions'),*/}
                                        {/*                options: [renderItem('AntDesign UI FAQ', 60100), renderItem('AntDesign FAQ', 30010)],*/}
                                        {/*            },*/}
                                        {/*            {*/}
                                        {/*                label: renderTitle('Articles'),*/}
                                        {/*                options: [renderItem('AntDesign design language', 100000)],*/}
                                        {/*            },*/}
                                        {/*        ]}*/}
                                        {/*    >*/}
                                        {/*        <Input.Search size="large" placeholder="input here" />*/}
                                        {/*    </AutoComplete>*/}
                                        {/*</Form.Item>*/}
                                        <ImgCrop rotate>
                                            <Upload
                                                action="https://www.mocky.io/v2/5cc8019d300000980a055e76"
                                                listType="picture-card"
                                                className="avatar-uploader"
                                                showUploadList={false}
                                                onChange={this.handleChange}
                                                beforeUpload={this.beforeUpload}
                                            >
                                                {imageUrl ? <img src={imageUrl} alt="avatar" style={{ width: '100%' }} /> : uploadButton}

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
