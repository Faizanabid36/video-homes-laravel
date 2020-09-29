import React, { Component } from 'react';
import { Line, Pie,Bar } from '@ant-design/charts';
import {
    Drawer,
    Divider,
    PageHeader,
    Menu,
    Dropdown,
    Button,
    Space,
    Tag,
    Typography,
    Table,
    Row, Col,
    Layout,
    Badge,
    Avatar,
    notification,
    Progress,
    Tabs,
    Card
} from 'antd';

const {Content} = Layout;

class Dashboard extends Component {
    render() {
        const data = [
            {
                type: '分类一',
                value: 27,
            },
            {
                type: '分类二',
                value: 25,
            },
            {
                type: '分类三',
                value: 18,
            },
            {
                type: '分类四',
                value: 15,
            },
            {
                type: '分类五',
                value: 10,
            },
            {
                type: '其它',
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
                        <Row gutter={16}>
                            <Col span={24}>
                                <Table dataSource={dataSource} columns={columns} />
                            </Col>
                        </Row>
                        <Row gutter={16}>
                            <Col span={8}>
                                <Card title="Card title" bordered={false}>
                                    <Pie style={{width: "100%", height: "400px"}} {...config}/>
                                </Card>
                            </Col>
                            <Col span={8}>
                                <Card title="Card title" bordered={false}>
                                    <Line style={{width: "100%", height: "400px"}}  {...{
                                        data:[
                                        {year: '1991', value: 3},
                                          {year:'1992', value:4},
                                          {year:'1993', value:3.5},
                                          {year:'1994', value:5},
                                          {year:'1995', value:4.9},
                                          {year:'1996', value:6},
                                          {year:'1997', value:7},
                                          {year:'1998', value:9},
                                          {year:'1999', value:13},
                                              ],
                                              title:{
                                              visible:true,
                                              text : 'Line chart with data points' ,
                                          },
                                              xField:'year',
                                              yField:'value',
                                          }}/>
                                </Card>
                            </Col>
                            <Col span={8}>
                                <Card title="Card title" bordered={false}>
                                    <Bar style={{width: "100%", height: "400px"}}  {...{
                                        data:[
                                            { 地区: '华东', 销售额: 1.442 },
                                    { 地区: '中南', 销售额: 2.0929999948 },
                                    { 地区: '东北', 销售额: 3.469000001 },
                                    { 地区: '华北', 销售额: 4.017000004 },
                                    { 地区: '西南', 销售额: 5.508000002 },
                                    { 地区: '西北', 销售额: 2.5959999998 },
                                        ],
                                        title: {
                                        visible: true,
                                        text: '基础条形图',
                                    },
                                        forceFit: true,

                                        xField: '销售额',
                                        yField: '地区',
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
