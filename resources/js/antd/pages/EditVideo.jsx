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
    Tabs, Col, Table, Form, Radio, Select,AutoComplete,Upload,Carousel
} from 'antd';
const { TextArea } = Input;

import MaskedInput from 'antd-mask-input'
import ImgCrop from 'antd-img-crop';
import GooglePlacesAutocomplete, { geocodeByAddress } from "react-google-places-autocomplete";

import { UserOutlined, EllipsisOutlined, SettingOutlined,PlusOutlined,LoadingOutlined } from '@ant-design/icons';
import { Editor } from "@tinymce/tinymce-react";
import EditableTagGroup from "./Tags";

const {Content} = Layout;
const {Column, ColumnGroup} = Table;
const {TabPane} = Tabs;


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

class EditVideo extends Component {
    constructor(props) {
        super(...arguments);
        this.state = {

        };
        this.onChange = this.onChange.bind(this);

    }
     onChange(a, b, c) {
        console.log(a, b, c);
    }
    render() {

        const contentStyle = {
            height: '160px',
            color: '#fff',
            lineHeight: '160px',
            textAlign: 'center',
            background: '#364d79',
        };
        return (
            <Content style={{padding: '20px 50px'}}>
                <div className="site-layout-content">
                    <PageHeader
                        className="site-page-header site-page-header-responsive"
                        onBack={() => null}
                        title="Edit Video"
                    >
                        <Form
                            ref={this.formRef} name="control-ref" onFinish={this.onFinish}
                            layout="vertical"
                        >
                            <Carousel afterChange={this.onChange}>
                                <div>
                                    <h3 style={contentStyle}>1</h3>
                                </div>
                                <div>
                                    <h3 style={contentStyle}>2</h3>
                                </div>
                                <div>
                                    <h3 style={contentStyle}>3</h3>
                                </div>
                                <div>
                                    <h3 style={contentStyle}>4</h3>
                                </div>
                            </Carousel>
                            <Form.Item label="Title" required rules={[{required: true}]}>
                                <Input placeholder="Title"/>
                            </Form.Item>

                            <Form.Item label="Description" required rules={[{required: true}]}>
                                <TextArea placeholder="Description"/>
                            </Form.Item>
                            <Form.Item label="Tags" required rules={[{required: true}]}>
                                <EditableTagGroup/>
                            </Form.Item>
                            <Form.Item label="Category">
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
                        </Form>
                    </PageHeader>

                </div>
            </Content>
        );
    }
}

export default EditVideo;
