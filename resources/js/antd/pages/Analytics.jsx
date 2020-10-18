import React, {Component} from 'react';
import {Bar, Line, Pie} from '@ant-design/charts';
import {Button, Card, Col, DatePicker, Layout, Row, Space, Table} from 'antd';
import axios from "axios";

const {Content} = Layout;

class Dashboard extends Component {

    constructor() {
        super();
        let startDate = new Date()
        startDate.setDate(startDate.getDate() - 365)
        this.state = {
            lineChart: [],
            barData: [],
            loadedOrViewed: [],
            viewsSource: [],
            visible: false,
            endDate: new Date(),
            startDate: startDate,
            videos_table_data: [],
        }
        this.getChartData = this.getChartData.bind(this)
        this.handleChangeInput = this.handleChangeInput.bind(this)
        this.onChangeDate = this.onChangeDate.bind(this)
        this.onOk = this.onOk.bind(this)
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
        let {startDate, endDate} = this.state
        axios.post('video_with_views', {startDate, endDate})
            .then((res) => {
                this.setState({...res.data})
            })
    }

    getChartData() {
        let {startDate, endDate} = this.state
        axios.post('get_all_statistics', {startDate, endDate})
            .then((res) => {
                this.setState({...res.data})
                this.setState({
                        chartData: [...this.state.chartData]
                    }
                )
                console.log('post state', this.state)
            })
            .catch((err) => {
                console.log(err)
            })
    }

    async handleChangeInput(startDate, endDate, label) {
        this.setState({startDate: startDate, endDate: endDate})
    }

    onChangeDate(value, dateString) {
        console.log('Formatted Selected Time: ', dateString);
    }

    async onOk(value) {
        await this.setState({startDate: value[0]._d,})
        if (value[1] != null)
            await this.setState({endDate: value[1]._d,})

        let {startDate, endDate} = this.state
        axios.post('video_with_views', {startDate, endDate})
            .then((res) => {
                this.setState({...res.data})
            })
            .catch((err) => {
                console.log(err)
            })
    }

    render() {
        const {RangePicker} = DatePicker;
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
        const dataSource = this.state.videos_table_data;

        const columns = [
            {
                title: 'Title',
                dataIndex: 'title',
                key: 'title',
            },
            {
                title: 'Views Count',
                dataIndex: 'views_count',
                key: 'views_count',
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
                        <Space direction="vertical" size={12}>
                            <RangePicker
                                showTime={{format: 'HH:mm'}}
                                format="YYYY-MM-DD HH:mm"
                                onChange={this.onChangeDate}
                                onOk={this.onOk}
                            />
                        </Space>
                        {/*<DateRangePicker startDate={this.state.startDate} onCallback={this.handleChangeInput}*/}
                        {/*                 endDate={this.state.endDate}>*/}
                        {/*    <button className="btn btn-primary">Select Date Range</button>*/}
                        {/*</DateRangePicker>*/}
                        <Button onClick={() => this.getChartData()}>Get Data</Button>
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
