import React from "react";
import {Card, Layout, PageHeader, Spin} from 'antd';
import moment from "moment";

const {Content} = Layout;

export default class MessagesList extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            messages: [],
            user_id: -1,
            dataloading: false,
        }
    }

    componentDidMount() {
        axios.get('my_messages_list')
            .then((res) => {
                this.setState({...res.data}, () => {
                    this.setState({dataloading: true})
                })
            })
            .catch((err) => {
                console.log(err)
            })
    }

    render() {
        return (
            <Content style={{padding: '20px 50px'}}>
                <div className="site-layout-content">
                    <Spin spinning={!this.state.dataloading} tip={'Loading'}/>
                    {this.state.dataloading && <PageHeader
                        className="site-page-header site-page-header-responsive"
                        title="Messages">

                        <ul style={{
                            listStyle: 'none',
                            margin: 0,
                            padding: 0
                        }}>{this.state.messages.map((message, index) => {
                            return <Card type="inner" key={index} onClick={() => {
                                window.location.hash = '#/messages/' + message.id
                            }}>
                                <h3>{message.user.name}</h3>
                                <h5>{message.user.id === this.state.user_id ? 'You: ' : ''}{message.message}<br/>
                                    <small>{moment(message.created_at).fromNow()}</small>
                                </h5>
                            </Card>
                        })}</ul>
                    </PageHeader>}
                </div>
            </Content>
        );
    }
}
