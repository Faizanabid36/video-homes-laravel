import React, {Component} from 'react';
import {Bar, Line, Pie} from '@ant-design/charts';
import {Card, Col, Layout, Row} from 'antd';
import axios from "axios";

const {Content} = Layout;

class Dashboard extends Component {
    constructor() {
        super();
        this.state = {
            lineChart: [],
            barData: []
        }
    }

    componentDidMount() {
        axios.get('get_dashboard_statistics')
            .then((res) => {
                console.log(res.data.lineChart)
                this.setState({...res.data})
            })
            .catch((err) => {
                console.log(err)
            })
    }

    render() {
        const data = [
            {
                type: 'A',
                value: 27,
            },
            {
                type: 'B',
                value: 25,
            },
            {
                type: 'C',
                value: 18,
            },
            {
                type: 'D',
                value: 15,
            },
            {
                type: 'E',
                value: 10,
            },
            {
                type: 'F',
                value: 5,
            },
        ];
        const config = {
            forceFit: true,
            title: {
                visible: true,
                text: '环图',
            },
            description: {
                visible: true,
                text: '环图的外半径决定环图的大小，而内半径决定环图的厚度。',
            },
            radius: 0.8,
            padding: 'auto',
            data,
            angleField: 'value',
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
            <Content style={{padding: '20px 50px'}}>
                <div className="site-layout-content">
                    <div className="site-card-wrapper">
                        {/*<Row gutter={16}>*/}
                        {/*    <Col span={24}>*/}
                        {/*        <Table dataSource={dataSource} columns={columns} />*/}
                        {/*    </Col>*/}
                        {/*</Row>*/}
                        <Row gutter={16}>
                            <Col span={12}>
                                <Card title="Traffic Source" bordered={false}>
                                    <Pie style={{width: "100%", height: "400px"}} {...config}/>
                                </Card>
                            </Col>
                            <Col span={12}>
                                <Card title="Player Impressions" bordered={false}>
                                    <Pie style={{width: "100%", height: "400px"}} {...config}/>
                                </Card>
                            </Col>
                            <Col span={12}>
                                <Card title="Card title" bordered={false}>
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
                                <Card title="Card title" bordered={false}>
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


                    {/*<PageHeader*/}
                    {/*    className="site-page-header site-page-header-responsive"*/}
                    {/*    // onBack={() => null}*/}
                    {/*    title="Title"*/}
                    {/*    subTitle="This is a subtitle"*/}
                    {/*    extra={[*/}
                    {/*        <Button key="1" type="primary">*/}
                    {/*            Primary*/}
                    {/*        </Button>,*/}
                    {/*    ]}*/}
                    {/*>*/}
                    {/*    <Pie {...config}/>*/}
                    {/*</PageHeader>*/}

                </div>
            </Content>
        );
    }
}

export default Dashboard;
