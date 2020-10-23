import React, {Component} from 'react';

import {Empty, Layout, Table} from 'antd';
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

            </Table> : <Empty description={"No One Has Left A Rating"}></Empty>
        );
    }
}

export default Ratings;
