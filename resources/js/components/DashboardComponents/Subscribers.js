import React from 'react';
import {Row, Col} from "react-bootstrap";
import ReactDOM from 'react-dom';
import {Bar} from 'react-chartjs-2';

class Subscribers extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            type: 'today',
            category: [],
            videosWithViews: []
        }
        this.getChartData = this.getChartData.bind(this)
        this.handleChangeInput = this.handleChangeInput.bind(this)
    }

    getChartData() {
        axios.get("/dashboard/" + this.state.type)
            .then((res) => {
                this.setState({...res.data})
            })
            .catch((err) => {
                console.log(err)
            })
    }

    async handleChangeInput(e) {
        await this.setState({type: e.target.value})
        await console.log(this.state.type)
        this.getChartData();
    }

    componentDidMount() {
        this.getChartData();
    }

    render() {
        return <div>
            <h4>Analytics</h4>
            <br/>
            <div className="form-group">
                <div className="row">
                    <div className="col-md-8"></div>
                    <div className="col-md-3">
                        <select id="type" name="type" onChange={this.handleChangeInput}
                                className="form-control pull-right">
                            <option value="today">Today</option>
                            <option value="this_week">This week</option>
                            <option value="this_month">This month</option>
                            <option value="this_year">This year</option>
                        </select>
                    </div>
                </div>
                <br/>

                {/*<Bar*/}
                {/*    data={this.state.Data}*/}
                {/*    height={30}*/}
                {/*    options={{maintainAspectRatio: false}}*/}
                {/*/>*/}

            </div>
            <div className="subscriptions-list">
                <div className="author-list">
                    <div className="video-wrapper" data-id="6" id="video-6">
                        {this.state.videosWithViews.map((item) => {
                            return <Row className="mb-2">
                                <Col md="12">
                                    <div className="video-thumb col-md-3">
                                        <a>
                                            <img src={window.VIDEO_APP.base_url + "/storage/" + item.thumbnail} alt=""/>
                                        </a>
                                    </div>
                                    <div className="video-info col-md-4 no-padding-left">
                                        <div className="video-title">
                                            <a>{item.original_name}</a>
                                        </div>
                                        <div className="video-views vid_stud_stats">
                                    <span>
                                        <svg className="feather feather-eye" xmlns="http://www.w3.org/2000/svg"
                                             width="24" height="24" viewBox="0 0 24 24" fill="none"
                                             stroke="currentColor" strokeWidth="2" strokeLinecap="round"
                                             strokeLinejoin="round" aria-hidden="true">
                                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                            <circle cx="12" cy="12" r="3"></circle>
                                        </svg>
                                        {item.views} {item.views > 1 ? 'Views' : 'View'} &nbsp;&nbsp;&nbsp;
                                    </span>
                                            <span>
                                            <svg className="feather feather-message"
                                                 xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                 viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                 strokeWwidth="2" strokeLinecap="round" strokeLinejoin="round"
                                                 aria-hidden="true">
                                                <path
                                                    d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path>
                                            </svg>
                                                {item.commentsCount} Comments &nbsp;&nbsp;&nbsp;
                                        </span>
                                        </div>
                                        <div className="video-desc">
                                            Uploaded By: {item.user.username}
                                        </div>
                                    </div>

                                </Col>
                            </Row>
                        })}
                        <div className="clear"></div>
                    </div>
                </div>
            </div>
        </div>
    }
}

export default Subscribers;
