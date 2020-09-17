import React, { Component } from 'react';

import {
    Input,
    Image,
    PageHeader,
    Layout,
    Form, Select,
    Carousel,
    Button,

} from 'antd';
import EditableTagGroup from "./Tags";

const {goTo} = Carousel;

class EditVideo extends Component {
    constructor(props) {
        super(...arguments);
        this.state = {
            video: {},
            current_slide: 0,
            thumbnails: {},
            categories: [],
        };
        this.onChange = this.onChange.bind(this);

    }


    onChange(a, b, c) {
        console.log(a, b, c);
    }

    componentDidMount() {
        let self = this;
        axios.get(`edit_video/${this.props.match.params.id}`).then(({data}) => {
            data.video.tags = data.video.tags ?? [];
            let index = data.video.thumbnail.match(/-(\d+).png/);
            if (index && index[1]) {
                data.current_slide = index[1] - 1;
                // goTo(data.current_tag,false);
            }
            self.setState({...data});
            console.log(this.state);
        })
    }

    saveTags(tags) {
        this.setState({tags});
    }

    defaultValue(key,defaultValue = '') {
        if (typeof key === 'string') {
            return this.state[key] ?? defaultValue
        }
        let state = this.state;
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
        console.log(this.state.video);
        return (
            <Layout.Content style={{padding: '20px 50px'}}>
                <div className="site-layout-content">
                    <PageHeader
                        className="site-page-header site-page-header-responsive"
                        onBack={() => null}
                        title="Edit Video"
                    >
                        <Form ref={this.formRef} name="control-ref" onFinish={this.onFinish} layout="vertical">
                            {Object.values(this.state.thumbnails).length > 0 &&
                            <Carousel slickGoTo={this.state.current_slide} afterChange={this.onChange}>
                                {Object.values(this.state.thumbnails).map((v, k) => <div key={k} style={contentStyle}>
                                    <Image src={window.VIDEO_APP.base_url + "/storage/" + v}/>
                                </div>)}
                            </Carousel>}


                            <Form.Item label="Title" required rules={[{required: true}]}>
                                <Input defaultValue={this.defaultValue(["video","title"])} value={this.state.video.title}
                                       placeholder="Title"/>
                            </Form.Item>

                            <Form.Item label="Description" required rules={[{required: true}]}>
                                <Input.TextArea defaultValue={this.defaultValue(["video","description"])} placeholder="Description"/>
                            </Form.Item>
                            <Form.Item label="Tags" required rules={[{required: true}]}>
                                <EditableTagGroup tags={this.defaultValue(["video","tags",[]])} saveTags={this.saveTags}/>
                            </Form.Item>
                            <Form.Item label="Category">
                                {this.state.categories.length && <Select
                                    defaultValue={this.defaultValue(["video","category_id"])}
                                    showSearch
                                    style={{ width: 200 }}
                                    placeholder="Select a Category"
                                    optionFilterProp="children"
                                    onChange={this.onChange}
                                    filterOption={(input, option) =>
                                        option.children.toLowerCase().indexOf(input.toLowerCase()) >= 0
                                    }
                                >
                                    {this.state.categories.map(e=><Select.Option value={e.id}>{e.name}</Select.Option>)}
                                </Select>}
                            </Form.Item>
                            <Button type='submit'>Update</Button>
                        </Form>
                    </PageHeader>

                </div>
            </Layout.Content>
        );
    }
}

export default EditVideo;
