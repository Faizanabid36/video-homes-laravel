import React, { Component } from 'react';

import {
    Slider,
    Button,
    Form,
    Input,
    Layout,
    message,
    PageHeader,
    Popconfirm,
    Select,
    Spin,
    Table,
    Tabs,
    Upload
} from 'antd';
import MaskedInput from 'antd-mask-input'
import ImgCrop from './Crop';
import GooglePlacesAutocomplete, { geocodeByAddress } from "react-google-places-autocomplete";

import { LoadingOutlined, PlusOutlined, UserOutlined } from '@ant-design/icons';
import { Editor } from "@tinymce/tinymce-react";
import axios from "axios";
import ReactCrop from 'react-image-crop';
import 'react-image-crop/dist/ReactCrop.css';
import Modal from "antd/es/modal";

const { Content } = Layout;
const { Column, ColumnGroup } = Table;
const { TabPane } = Tabs;

function getBase64(img, callback) {
    const reader = new FileReader();
    reader.addEventListener('load', () => callback(reader.result));
    reader.readAsDataURL(img);
}

class Profile extends Component {
    constructor(props) {
        super(...arguments);
        this.state = {
            
            x: 1,
            y: 2,
            
            dataloading: false,
            loading: false,
            user: {},
            old_password: '',
            new_password: '',
            confirm_password: '',
            categories: [],
           
        };
        this.formRef = React.createRef();
        
        this.beforeUpload = this.beforeUpload.bind(this);
        this.defaultValue = this.defaultValue.bind(this);
        this.handleSubmit = this.handleSubmit.bind(this);
        this.handleChangeInput = this.handleChangeInput.bind(this);
        this.changePassword = this.changePassword.bind(this);
        
        this.handleUpdateImage = this.handleUpdateImage.bind(this);
        
    }

    

    onSelectFile(e) {
        if (e.target.files && e.target.files.length > 0) {
            const reader = new FileReader();
            reader.addEventListener('load', () =>
                this.setState({ modalVisible: true, src: reader.result })
            );
            reader.readAsDataURL(e.target.files[0]);
        }
    };
    onSelectFile2(e) {
        if (e.target.files && e.target.files.length > 0) {
            const reader = new FileReader();
            reader.addEventListener('load', () =>
                this.setState({ modalVisible2: true, src2: reader.result })
            );
            reader.readAsDataURL(e.target.files[0]);
        }
    };

    
    changePassword() {
        let { old_password, new_password, confirm_password } = this.state
        axios.put('profile/1', { old_password, new_password, confirm_password })
            .then((res) => {
                if (res.data.message)
                    message.info(res.data.message)
            })
            .catch((err) => {
                console.log(err.response)
                if (err.response.data.errors.old_password)
                    message.error(err.response.data.errors.old_password)
                else if (err.response.data.errors.new_password)
                    message.error(err.response.data.errors.new_password)
                else if (err.response.data.errors.confirm_password)
                    message.error(err.response.data.errors.confirm_password)
            })
    }

    handleSubmit(e) {
        let { user } = this.state
        axios.put('profile/1', { ...user })
            .then((res) => {
                if (res.data.message)
                    message.success(res.data.message)
                console.log(res.data)
            })
            .catch((err) => {
                if (err.response.data.errors.username)
                    message.error(err.response.data.errors.username)
                else if (err.response.data.errors.name)
                    message.error(err.response.data.errors.name)
                else if (err.response.data.errors.company_name)
                    message.error(err.response.data.errors.company_name)
                else if (err.response.data.errors.user_category_id)
                    message.error(err.response.data.errors.user_category_id)
            })
    }

    handleChangeInput(e, key = false) {
        let { user } = this.state;
        user[key || e.target.name] = key ? e : e.target.value;
        this.setState({ user });
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

    
    handleUpdateImage(data,variable_name= "profile_picture") {
        let params = {};
        params[variable_name] = data;
        console.log(params);
        axios.post(`${window.VIDEO_APP.base_url}/profile`, {...params})
            .then((res) => {
                this.setState({ ...res.data,'modalVisible': false });
                message.success(variable_name.replace("_", " ") + " has been updated");
            }).catch((err) => {
                console.log(err)
            })
    }
    
    componentDidMount() {
        axios.get('profile')
            .then(({ data }) => {
                console.log(data)
                this.setState({ ...data, dataloading: true })
            }).catch((err) => {
                console.log(err)
            })
    }

    render() {
        // const onPreview = async file => {
        //     let src = file.url;
        //     if (!src) {
        //         src = await new Promise(resolve => {
        //             const reader = new FileReader();
        //             reader.readAsDataURL(file.originFileObj);
        //             reader.onload = () => resolve(reader.result);
        //         });
        //     }
        //     const image = new Image();
        //     image.src = src;
        //     const imgWindow = window.open(src);
        //     imgWindow.document.write(image.outerHTML);
        // };
        const { crop, croppedImageUrl, src, src2 } = this.state
        const { loading, imageUrl } = this.state;
        const uploadButton = (
            <div>
                {loading ? <LoadingOutlined /> : <PlusOutlined />}
                <div style={{ marginTop: 8 }}>Upload</div>
            </div>
        );

        return (
            <Content style={{ padding: '20px 50px' }}>
                <div className="site-layout-content">
                    <PageHeader
                        className="site-page-header site-page-header-responsive"
                        onBack={() => null}
                        title="Profile"
                    >
                        <Spin spinning={!this.state.dataloading} tip={'Loading'} />
                        {this.state.dataloading && <Form
                            ref={this.formRef} name="control-ref" onFinish={this.onFinish}
                            layout="vertical"
                        >
                            <Tabs defaultActiveKey="1" tabPosition="left">
                                <TabPane tab="General" key="1">
                                    <Form.Item label="Full Name" required rules={[
                                        {
                                            required: true,
                                        },
                                    ]}>
                                        <Input value={this.defaultValue('name')}
                                            name='name'
                                            onChange={(e) => this.handleChangeInput(e)}
                                            placeholder="Full Name" />
                                    </Form.Item>

                                    <Form.Item label="Company Name" required rules={[{ required: true }]}>
                                        <Input value={this.defaultValue('company_name')}
                                            name='company_name'
                                            onChange={(e) => this.handleChangeInput(e)}
                                            placeholder="Company Name" />
                                    </Form.Item>

                                    <Form.Item label="Personal URL" required>
                                        <Input addonBefore={window.VIDEO_APP.base_url}
                                            name='username'
                                            onChange={(e) => this.handleChangeInput(e)}
                                            value={this.defaultValue('username')} placeholder="Personal URL" />
                                    </Form.Item>

                                    <Form.Item label="Website URL" required>
                                        <Input addonBefore='https://'
                                            name='website'
                                            onChange={(e) => this.handleChangeInput(e)}
                                            value={this.defaultValue('website')} placeholder="Website URL" />
                                    </Form.Item>
                                    <Form.Item label="Facebook" required>
                                        <Input addonBefore="https://www.facebook.com/"
                                            name='facebook'
                                            onChange={(e) => this.handleChangeInput(e)}
                                            value={this.defaultValue('facebook')} placeholder="Facebook" />
                                    </Form.Item>
                                    <Form.Item label="Youtube" required>
                                        <Input addonBefore="https://www.youtube.com/"
                                            name='youtube'
                                            onChange={(e) => this.handleChangeInput(e)}
                                            value={this.defaultValue('youtube')} placeholder="Youtube" />
                                    </Form.Item>
                                    <Form.Item label="Instagram" required>
                                        <Input addonBefore="https://www.instagram.com/"
                                            name='instagram'
                                            onChange={(e) => this.handleChangeInput(e)}
                                            value={this.defaultValue('instagram')} placeholder="Instagram" />
                                    </Form.Item>
                                    <Form.Item label="About/Bio">
                                        <Editor
                                            apiKey="rlsbsechuy5zwieakwp79flrto7ipmojgummzxwwjbbcbtye"
                                            name="bio"
                                            initialValue={this.defaultValue('bio') || ''}
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

                                    <Form.Item label="License" required rules={[{ required: true, },]}>
                                        <MaskedInput value={this.defaultValue('license_no')} placeholder="License"
                                            onChange={(e) => this.handleChangeInput(e)}
                                            mask="#######" name="license_no" size="7" />
                                    </Form.Item>

                                    <Form.Item label="Direct Phone" required rules={[
                                        {
                                            required: true,
                                        },
                                    ]}>
                                        <MaskedInput value={this.defaultValue('direct_phone')}
                                            placeholder="Direct Phone" mask="111-111-1111"
                                            onChange={(e) => this.handleChangeInput(e)}
                                            name="direct_phone" size="20" />
                                    </Form.Item>
                                    <Form.Item label="Office Phone" required rules={[
                                        {
                                            required: true,
                                        },
                                    ]}>
                                        <MaskedInput value={this.defaultValue('office_phone')}
                                            placeholder="Office Phone" mask="111-111-1111"
                                            onChange={(e) => this.handleChangeInput(e)}
                                            name="office_phone" size="20" />
                                    </Form.Item>
                                    <Form.Item label="Address" required rules={[
                                        {
                                            required: true,
                                        },
                                    ]}>
                                        <GooglePlacesAutocomplete
                                            initialValue={this.defaultValue('address')}
                                            autocompletionRequest={{
                                                componentRestrictions: {
                                                    country: ['us'],
                                                }
                                            }}
                                            onSelect={({ description }) => {
                                                geocodeByAddress(description).then((results) => {
                                                    let { user } = this.state;
                                                    user.address = description;
                                                    user.location_latitude = results[0].geometry.location.lat();
                                                    user.location_longitude = results[0].geometry.location.lng();
                                                    this.setState({ user });
                                                }).catch(error => console.error(error));
                                            }}

                                            inputClassName="ant-input"
                                        />

                                    </Form.Item>
                                    <Form.Item label="Profession and Expertise">
                                        {this.state.categories.length > 0 && <>
                                            <Select defaultValue={this.defaultValue('user_category_id')} showSearch
                                                name="user_category_id"
                                                onChange={e => this.handleChangeInput(e, 'user_category_id')}
                                                placeholder="Choose one of the following Profession and Expertise...">
                                                {this.state.categories.map((u, key) => u['children'].length > 0 &&
                                                    <Select.OptGroup key={u['id']} label={u['name']}>
                                                        {u['children'].map((u1, k) => {
                                                            return u1['children'].length > 0 ? u1['children'].map((u2, k) =>
                                                                <Select.Option key={u2['id'] * 1000}
                                                                    value={u2['id']}
                                                                    data-subtext={u1['name']}>{u2['name']}</Select.Option>) :
                                                                <Select.Option key={u1['id'] * 1000}

                                                                    value={u1['id']}>{u1['name']}</Select.Option>;
                                                        })}</Select.OptGroup>)}
                                            </Select>
                                        </>}
                                    </Form.Item>
                                    <Form.Item label="Profile Picture">
                                        <ImgCrop onChange={e=>this.handleUpdateImage(e)} defaultSrc={this.defaultValue('profile_picture')} />
                                    </Form.Item>
                                    <Form.Item label="Company Logo">
                                        <ImgCrop onChange={e=>this.handleUpdateImage(e,"company_logo")} defaultSrc={this.defaultValue('company_logo')} />
                                    </Form.Item>
                                    
                                    <Button onClick={this.handleSubmit}>
                                        Save
                                    </Button>
                                </TabPane>
                                <TabPane tab="Change Password" key="2">
                                    <Form.Item label="Old Password" required rules={[
                                        {
                                            required: true,
                                        },
                                    ]}>
                                        <Input value={this.state.old_password}
                                            name='old_password'
                                            type="password"
                                            onChange={(e) => this.setState({ old_password: e.target.value })}
                                            placeholder="Old Password" />
                                    </Form.Item>
                                    <Form.Item label="New Password" required rules={[
                                        {
                                            required: true,
                                        },
                                    ]}>
                                        <Input value={this.state.new_password}
                                            name='new_password'
                                            type="password"
                                            onChange={(e) => this.setState({ new_password: e.target.value })}
                                            placeholder="New Password" />
                                    </Form.Item>
                                    <Form.Item label="Confirm Password" required rules={[
                                        {
                                            required: true,
                                        },
                                    ]}>
                                        <Input value={this.state.confirm_password}
                                            name='confirm_password'
                                            type="password"
                                            onChange={(e) => this.setState({ confirm_password: e.target.value })}
                                            placeholder="Confirm Password" />
                                    </Form.Item>
                                    <Button onClick={this.changePassword}>
                                        Change Password
                                    </Button>
                                </TabPane>
                                <TabPane tab="Delete account" key="3">
                                    <Popconfirm
                                        title="Are you sure delete this task?"
                                        onConfirm={(e) => {
                                            console.log(e);
                                            message.success('Deleted!');
                                        }}
                                        placement="right"
                                        okText="Yes"
                                        cancelText="No"
                                    >
                                        <Button danger onClick={e => {
                                            axios.delete("profile/1").then(({ }) => {
                                                $("#logout-form").submit();
                                            })
                                        }}>Delete Account</Button>
                                    </Popconfirm>
                                </TabPane>
                            </Tabs>
                        </Form>}
                    </PageHeader>
                </div>
            </Content>
        );
    }
}

export default Profile;
