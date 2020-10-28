import React, {Component} from 'react';

import {Button, Carousel, Form, Image, Input, Layout, message, PageHeader, Select,} from 'antd';
import EditableTagGroup from "./Tags";
import GooglePlacesAutocomplete, {geocodeByAddress} from "react-google-places-autocomplete";

const {goTo} = Carousel;

class EditVideo extends Component {
    constructor(props) {
        super(...arguments);
        this.state = {
            enable:false,
            video: {},
            current_slide: 0,
            thumbnails: {},
            categories: [],
        };
        this.onChange = this.onChange.bind(this);
        this.onUpdate = this.onUpdate.bind(this);
        this.defaultValue = this.defaultValue.bind(this);
        console.log("yes edit video")
    }


    onChange(e,key) {
        let {video} = this.state;
        video[key] = e.target ?  e.target.value : e;
        this.setState({video});

    }
    onUpdate(){
        let self = this;
        axios.put(`video/${this.props.match.params.id}`, {...this.state.video}).then((res) => {
            if (res.data.message)
                message.success(res.data.message)
        }).catch((err) => {
            if (err.response.data.errors.old_password)
                message.error(err.response.data.errors.old_password)
            else if (err.response.data.errors.new_password)
                message.error(err.response.data.errors.new_password)
            else if (err.response.data.errors.confirm_password)
                message.error(err.response.data.errors.confirm_password)
        })
    }

    componentDidMount() {
        let self = this;
        axios.get(`video/${this.props.match.params.id}`).then(({data}) => {
            data.video.tags = data.video.tags ?? [];
            let index = data.video.thumbnail.match(/-(\d+).png/);
            if (index && index[1]) {
                data.current_slide = index[1] - 1;
            }
            self.setState({...data,enable:true});

        })
    }

    defaultValue(key,defaultValue = '') {
        if (typeof key === 'string') {
            return this.state[key] ?? defaultValue
        }
        let state = {...this.state};
        key.map(v => state = state[v]);
        return state ?? defaultValue;
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
            <Layout.Content style={{padding: '20px 50px'}}>
                <div className="site-layout-content">
                    <PageHeader
                        className="site-page-header site-page-header-responsive"
                        onBack={() => {
                            null
                        }}
                        title="Edit Video"
                    >
                        {this.state.enable && <Form ref={this.formRef} name="control-ref" layout="vertical">
                            {Object.values(this.state.thumbnails).length > 0 &&
                            <Carousel slickGoTo={this.state.current_slide}
                                      afterChange={e => this.onChange(e, 'thumbnails')}>
                                {Object.values(this.state.thumbnails).map((v, k) => <div key={k} style={contentStyle}>
                                    <Image src={window.VIDEO_APP.base_url + "/storage/" + v}/>
                                </div>)}
                            </Carousel>}


                            <Form.Item label="Title" required rules={[{required: true}]}>
                                <Input onChange={e => this.onChange(e, 'title')}
                                       defaultValue={this.defaultValue(["video", "title"])}
                                       placeholder="Title"/>
                            </Form.Item>

                            <Form.Item label="Description" required rules={[{required: true}]}>
                                <Input.TextArea autoSize={true} onChange={e => this.onChange(e, 'description')}
                                                defaultValue={this.defaultValue(["video", "description"])}
                                                placeholder="Description"/>
                            </Form.Item>
                            <Form.Item label="Address" required rules={[
                                {
                                    required: true,
                                },
                            ]}>
                                <GooglePlacesAutocomplete
                                    initialValue={this.state.video.video_location}
                                    autocompletionRequest={{
                                        componentRestrictions: {
                                            country: ['us'],
                                        }
                                    }}
                                    onSelect={({description}) => {
                                        geocodeByAddress(description).then((results) => {
                                            let {video} = this.state;
                                            video.video_location = description;
                                            this.setState({video});
                                        }).catch(error => console.error(error));
                                    }}

                                    inputClassName="ant-input"
                                />
                            </Form.Item>
                            <Form.Item label="Tags" required rules={[{required: true}]}>
                                <EditableTagGroup tags={this.defaultValue(["video", "tags"], [])}
                                                  saveTags={e => this.onChange(e, 'tags')}/>
                            </Form.Item>
                            <Form.Item label="Category">
                                {this.state.categories.length && <Select
                                    defaultValue={this.defaultValue(["video", "category_id"])}
                                    showSearch

                                    placeholder="Select a Category"
                                    optionFilterProp="children"
                                    onChange={e => this.onChange(e, 'category_id')}
                                    filterOption={(input, option) =>
                                        option.children.toLowerCase().indexOf(input.toLowerCase()) >= 0
                                    }
                                >
                                    {this.state.categories.map((e,k)=><Select.Option key={k} value={e.id}>{e.name}</Select.Option>)}
                                </Select>}
                            </Form.Item>
                            <Button onClick={this.onUpdate}>Update</Button>
                        </Form>}
                    </PageHeader>
                </div>
            </Layout.Content>
        );
    }
}

export default EditVideo;
