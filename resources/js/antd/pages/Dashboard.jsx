import React, {Component} from 'react';
// import {Pie} from '@ant-design/charts';
import {Card, Col, Layout, Row} from 'antd';
import axios from "axios";
import {Doughnut, HorizontalBar, Line} from 'react-chartjs-2';

const {Content} = Layout;

class Dashboard extends Component {
    constructor() {
        super();
        this.state = {
            lineChart: {},
            barData: [],
            loadedOrViewed: {},
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
        return (
            this.state.visible ? <Content style={{padding: '20px 50px'}}>
                <div className="site-layout-content">
                    <div className="site-card-wrapper">
                        <Row gutter={16}>
                            <Col span={12}>
                                <Card title="Traffic Source" bordered={false}>
                                    <Doughnut
                                        data={this.state.viewsSource}
                                    />
                                </Card>
                            </Col>
                            <Col span={12}>
                                <Card title="Player Impressions" bordered={false}>
                                    <Doughnut
                                        data={this.state.loadedOrViewed}
                                    />
                                </Card>
                            </Col>
                            <Col span={12}>
                                <Card title="Views within 7 Days" bordered={false}>
                                    <Line data={this.state.lineChart}/>
                                </Card>
                            </Col>
                            <Col span={12}>
                                <Card title="Top 5 Most Watched Videos" bordered={false}>
                                    <HorizontalBar data={this.state.barData}/>
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
