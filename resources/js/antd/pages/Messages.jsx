import React from "react";
import {Button, Card, Form, Input, Layout, PageHeader, Spin} from 'antd';
import {SendOutlined} from '@ant-design/icons';
import moment from "moment";

const {Content} = Layout;

export default class Messages extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            messages: [],
            inputText: '',
            dataloading: false,
            from_id: 0,
            to_id: 0,
            user_id: 0,
        }
        this.onChange = this.onChange.bind(this)
        this.handleSubmit = this.handleSubmit.bind(this)
    }

    async handleSubmit(e) {
        await e.preventDefault();
        let {user_id} = this.state
        this.setState({from_id: user_id})
        let {inputText, to_id} = this.state;
        await axios.post('send_message', {inputText, to_id})
            .then(async (res) => {
                console.log(res.data)
                let nextMessages = await this.state.messages.concat([{
                    message: this.state.inputText,
                    contact_user_id: this.state.user_id
                }]);
                await this.setState({messages: nextMessages, inputText: ''});
            })
            .catch((err) => {
                console.log(err)
            })
    }


    async onChange(e) {
        await this.setState({inputText: e.target.value});
    }

    componentDidMount() {
        console.log(this.props.match.params.id)
        let message_id = this.props.match.params.id
        axios.post('my_messages', {message_id})
            .then((res) => {
                console.log(res)
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
                        title="Message History">

                        <ul style={{
                            listStyle: 'none',
                            margin: 0,
                            padding: 0
                        }}>{this.state.messages.map((message, index) => {
                            console.log(this.state.user_id + "and" + message.contact_user_id)
                            return <Card type="inner" key={index}>
                                <h5
                                    className={this.state.user_id != message.contact_user_id ? 'pull-left' : 'pull-right'}>
                                    {message.message}<br/>
                                    <small
                                        className={this.state.user_id != message.contact_user_id ? '' : 'pull-right'}>
                                        {moment(message.created_at).fromNow()}</small>
                                </h5>
                            </Card>
                        })}</ul>
                        <Form className={"mt-3"} name="control-ref" layout="vertical" onSubmit={this.handleSubmit}>
                            <Form.Item rules={[{required: true}]}>
                                <Input onChange={e => this.onChange(e)}
                                       className={"col-md-10 pull-left"}
                                       value={this.state.inputText}
                                       placeholder="Enter Message Here..."/>
                                <Button onClick={this.handleSubmit} className={"col-md-2 pull-right"} type="primary"
                                        icon={<SendOutlined/>}>Send</Button>
                            </Form.Item>
                        </Form>
                    </PageHeader>}
                </div>
            </Content>
        );
    }
}
