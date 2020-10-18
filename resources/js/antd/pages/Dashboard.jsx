import React, {Component} from 'react';
import {Bar, Line, Pie} from '@ant-design/charts';
import {Card, Col, Layout, Row, Table} from 'antd';
import axios from "axios";

const {Content} = Layout;

class Dashboard extends Component {
    constructor() {
        super();
        this.state = {
            lineChart: [],
            barData: [],
            loadedOrViewed: [],
            viewsSource: [],
            visible: false,
        }
        this.viewData = this.viewData.bind(this)
    }

    componentDidMount() {
        axios.get('get_dashboard_statistics')
            .then((res) => {
                this.setState({...res.data}, () => {
                    this.setState({visible: true})
                })
            })
            .catch((err) => {
                console.log(err)
            })
    }

    viewData(e) {
        alert('e')
        console.log(e)
    }

    render() {
        let {viewsSource, loadedOrViewed} = this.state
        const configVideoSource = {
            forceFit: true,
            title: {
                visible: true,
                text: 'Views Source',
            },
            description: {
                visible: true,
                text: 'Views Source',
            },
            radius: 0.8,
            padding: 'auto',
            data: viewsSource,
            angleField: 'views',
            colorField: 'source',
        };
        const configLoadedOrViewed = {
            forceFit: true,
            title: {
                visible: true,
                text: 'Views Source',
            },
            description: {
                visible: true,
                text: 'Views Source',
            },
            radius: 0.8,
            padding: 'auto',
            data: loadedOrViewed,
            angleField: 'count',
            colorField: 'type',
        };
        const dataSource = [
            {
                key: '1',
                name: 'Mike',
                age: 32,
                address: '10 Downing Street',
            },
            {
                key: '2',
                name: 'John',
                age: 42,
                address: '10 Downing Street',
            },
        ];

        const columns = [
            {
                title: 'Name',
                dataIndex: 'name',
                key: 'name',
            },
            {
                title: 'Age',
                dataIndex: 'age',
                key: 'age',
            },
            {
                title: 'Address',
                dataIndex: 'address',
                key: 'address',
            },

        ];
        return (
            this.state.visible ? <Content style={{padding: '20px 50px'}}>
                <div className="site-layout-content">
                    <div className="site-card-wrapper">
                        <Row gutter={16}>
                            <Col span={24}>
                                <Table
                                    onRow={(record) => {
                                        return {
                                            onClick: () => {
                                                console.log(record)
                                            }
                                        }
                                    }}
                                    dataSource={dataSource} columns={columns}/>
                            </Col>
                        </Row>
                        <Row gutter={16}>
                            <Col span={12}>
                                <Card title="Traffic Source" bordered={false}>
                                    <Pie style={{width: "100%", height: "400px"}} {...configVideoSource}/>
                                </Card>
                            </Col>
                            <Col span={12}>
                                <Card title="Player Impressions" bordered={false}>
                                    <Pie style={{width: "100%", height: "400px"}} {...configLoadedOrViewed}/>
                                </Card>
                            </Col>
                            <Col span={12}>
                                <Card title="Views within 7 Days" bordered={false}>
                                    <Line style={{width: "100%", height: "400px"}}  {...{
                                        data: this.state.lineChart,
                                        title: {
                                            visible: true,
                                            text: 'Line chart with data points',
                                        },
                                        xField: 'date',
                                        yField: 'views',
                                    }}/>
                                </Card>
                            </Col>
                            <Col span={12}>
                                <Card title="Top 5 Most Watched Videos" bordered={false}>
                                    <Bar style={{width: "100%", height: "400px"}}  {...{
                                        data: this.state.barData,
                                        title: {
                                            visible: true,
                                            text: '基础条形图',
                                        },
                                        forceFit: true,

                                        xField: 'views_count',
                                        yField: 'original_name',
                                        label: {
                                            visible: true,
                                            formatter: (v) => Math.round(v / 10000) + '万',
                                        },
                                    }}/>
                                </Card>
                            </Col>
                        </Row>
                    </div>
                </div>
            </Content> : ''
        );
    }
}

export default Dashboard;
