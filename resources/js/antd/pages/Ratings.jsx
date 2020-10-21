import React, {Component} from 'react';

import {Button, Empty, Layout, Space, Table} from 'antd';
import {CloudUploadOutlined} from '@ant-design/icons';
import axios from "axios";

const {Content} = Layout;
const {Column, ColumnGroup} = Table;


class Ratings extends Component {

    constructor(props) {
        super(props);
        this.state = {
            ratings: []
        }
    }

    componentDidMount() {
        axios.get('/my_ratings')
            .then((res) => {
                this.setState({...res.data})
                console.log(this.state)
            })
            .catch((err) => {
                console.log(err)
            });
    }

    render() {
        return (
            this.state.ratings.length > 0 ? <Table dataSource={this.state.ratings}>
                <Column title="Name" dataIndex="name" key="name"/>
                <Column title="Review" dataIndex="review" key="review"/>
                <Column title="Video Title" dataIndex="video_title" key="video_title"/>
                <Column title="Stars left" dataIndex="rating" key="rating"/>
                <Column title="Time" dataIndex="time" key="time"/>

            </Table> : <Empty description={"No Rating Found found"}>
                <Button type="primary"
                        onClick={e => this.setState({action: 'create'})}><CloudUploadOutlined/> Create</Button></Empty>
        );
    }
}

export default Ratings;
