import React, { Component } from 'react';

import {
    Input,
    Image,
    PageHeader,
    Layout,
    Form, AutoComplete,
    Carousel
} from 'antd';
import EditableTagGroup from "./Tags";
const {goTo} = Carousel;
class EditVideo extends Component {
    constructor(props) {
        super(...arguments);
        this.state = {
            video: {},
            current_tag: 0,
            thumbnails:{},
            categories:[],
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
                data.current_tag = index[1] - 1;
                goTo(data.current_tag,false);
            }
            self.setState({...data});
        })
    }

    saveTags(tags) {
        this.setState({tags});
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
                        onBack={() => null}
                        title="Edit Video"
                    >
                        <Form
                            ref={this.formRef} name="control-ref" onFinish={this.onFinish}
                            layout="vertical"
                        >

                            {Object.values(this.state.thumbnails).length > 0 && <Carousel afterChange={this.onChange}>
                                {Object.values(this.state.thumbnails).map(v => <div style={contentStyle}>
                                    <Image
                                        src={window.VIDEO_APP.base_url + "/storage/" + v}
                                    />
                                </div>)}
                            </Carousel>
                            }


                            <Form.Item label="Title" required rules={[{required: true}]}>
                                <Input defaultValue={this.state.video.title} placeholder="Title"/>
                            </Form.Item>

                            <Form.Item label="Description" required rules={[{required: true}]}>
                                <Input.TextArea defaultValue={this.state.video.description} placeholder="Description"/>
                            </Form.Item>
                            <Form.Item label="Tags" required rules={[{required: true}]}>
                                <EditableTagGroup tags={this.state.video.tags || []} saveTags={this.saveTags}/>
                            </Form.Item>
                            <Form.Item label="Category">
                                <AutoComplete key='id'
                                              dropdownClassName="certain-category-search-dropdown"
                                              dropdownMatchSelectWidth={500}
                                              style={{
                                                  width: 250,
                                              }}
                                              options={this.state.categories}
                                >
                                    <Input.Search defaultValue={this.state.video.category_id} size="large"
                                                  placeholder="input here"/>
                                </AutoComplete>
                            </Form.Item>
                        </Form>
                    </PageHeader>

                </div>
            </Layout.Content>
        );
    }
}

export default EditVideo;
