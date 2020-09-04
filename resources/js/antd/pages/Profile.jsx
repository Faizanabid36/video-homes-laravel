import React, { Component } from 'react';

import {
    Image,
    Card,
    Drawer,
    Divider,
    PageHeader,
    Menu,
    Dropdown,
    Button,
    Space,
    Tag,
    Typography,
    Row,
    Layout,
    Badge,
    Avatar,
    notification,
    Progress,
    Tabs, Col,Table,
} from 'antd';
import { EditOutlined, EllipsisOutlined, SettingOutlined } from '@ant-design/icons';

const {Content} = Layout;
const { Column, ColumnGroup } = Table;
const { TabPane } = Tabs;

const data = [
    {
        key: '1',
        firstName: 'John',
        lastName: 'Brown',
        age: 32,
        address: 'New York No. 1 Lake Park',
        tags: ['nice', 'developer'],
    },
    {
        key: '2',
        firstName: 'Jim',
        lastName: 'Green',
        age: 42,
        address: 'London No. 1 Lake Park',
        tags: ['loser'],
    },
    {
        key: '3',
        firstName: 'Joe',
        lastName: 'Black',
        age: 32,
        address: 'Sidney No. 1 Lake Park',
        tags: ['cool', 'teacher'],
    },
];
class Profile extends Component {
    constructor(props){
        super(...arguments);
        this.state = { size: 'small' };

    }
    render() {
        return (
            <Content style={{padding: '20px 50px'}}>
                <div className="site-layout-content">
                    <PageHeader
                        className="site-page-header site-page-header-responsive"
                        onBack={() => null}
                        title="Playlist"
                    >
                        <Tabs defaultActiveKey="1" tabPosition="left" style={{ height: 220 }}>
                            <TabPane tab="Tab 1" key="1">
                                Content of tab 1
                            </TabPane>
                            <TabPane tab="Tab 2" key="2">
                                Content of tab 2
                            </TabPane>
                            <TabPane tab="Tab 3" key="3">
                                Content of tab 3
                            </TabPane>
                        </Tabs>
                    </PageHeader>

                </div>
            </Content>
        );
    }
}

export default Profile;
