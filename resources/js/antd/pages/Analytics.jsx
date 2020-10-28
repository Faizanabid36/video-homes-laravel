import React, {Component} from 'react';
import {Line, Pie} from '@ant-design/charts';
import {Card, Col, DatePicker, Layout, Modal, Row, Space, Table} from 'antd';
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
            visibleContent: false,
            endDate: new Date(),
            startDate: startDate,
            videos_table_data: [],
            visible: false,
        }
        this.handleCancelModal = this.handleCancelModal.bind(this)
        this.handleChangeInput = this.handleChangeInput.bind(this)
        this.handleOkModal = this.handleOkModal.bind(this)
        this.getModalData = this.getModalData.bind(this)
        this.onChangeDate = this.onChangeDate.bind(this)
        this.onOk = this.onOk.bind(this)
    }

    componentDidMount() {

        let {startDate, endDate} = this.state
        axios.post('video_with_views', {startDate, endDate})
            .then((res) => {
                this.setState({...res.data}, () => {
                    this.setState({visibleContent: true})
                })
            })
    }

    getModalData(e) {
        const video_id = e.key;
        let {startDate, endDate} = this.state
        axios.post('video_chart_data', {startDate, endDate, video_id})
            .then((res) => {
                console.log(res.data)
                this.setState({...res.data}, () => {
                    this.setState({visible: true})
                })
            })
    }

    handleOkModal(e) {
        console.log(e);
        this.setState({
            visible: false,
        });
    }

    handleCancelModal(e) {
        console.log(e);
        this.setState({
            visible: false,
        });
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
            }
        ];
        return (
            this.state.visibleContent ? <Content style={{padding: '20px 50px'}}>
                <div className="site-layout-content">
                    <div className="site-card-wrapper">
                        <Space direction="vertical" size={16}>
                            <RangePicker
                                showTime={{format: 'HH:mm'}}
                                format="YYYY-MM-DD HH:mm"
                                onChange={this.onChangeDate}
                                onOk={this.onOk}
                            />
                        </Space>
                    </div>
                    <Modal
                        width={800}
                        title="Video Details"
                        visible={this.state.visible}
                        onOk={this.handleOkModal}
                        onCancel={this.handleCancelModal}>
                        <Row gutter={16}>
                            <Col span={16}>
                                <Card title="Traffic Source" bordered={false}>
                                    <Pie style={{width: "100%", height: "400px"}} {...configVideoSource}/>
                                </Card>
                            </Col>
                            <Col span={16}>
                                <Card title="Player Impressions" bordered={false}>
                                    <Pie style={{width: "100%", height: "400px"}} {...configLoadedOrViewed}/>
                                </Card>
                            </Col>
                            <Col span={16}>
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
                        </Row>
                    </Modal>
                    <Row gutter={16}>
                        <Col span={24}>
                            <Table
                                style={{cursor: 'pointer'}}
                                onRow={(record) => {
                                    return {
                                        onClick: () => {
                                            console.log('here')
                                            this.getModalData(record)
                                        }
                                    }
                                }}
                                dataSource={dataSource} columns={columns}/>
                        </Col>
                    </Row>
                </div>
            </Content> : ''
        );
    }
}

export default Dashboard;
