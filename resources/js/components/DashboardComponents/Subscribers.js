import React from 'react';
import {Row, Col, Button} from "react-bootstrap";
import ReactDOM from 'react-dom';
import DatePicker from "react-datepicker";
import "react-datepicker/dist/react-datepicker.css";

class Subscribers extends React.Component {
    constructor(props) {
        super(props);
        let startDate = new Date()
        startDate.setDate(startDate.getDate() - 1)
        this.state = {
            type: 'today',
            category: [],
            videosWithViews: [],
            endDate: new Date(),
            startDate: startDate
        }
        this.getChartData = this.getChartData.bind(this)
        this.handleChangeInput = this.handleChangeInput.bind(this)
    }

    getChartData() {
        let {startDate, endDate} = this.state
        axios.post("/dashboard_statistics", {startDate, endDate})
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
                        <Button onClick={this.handleChangeInput}>
                            Search
                        </Button>
                    </div>
                    <div className="col-md-3">
                        <span className='mr-2'>From Date:</span>
                        <DatePicker
                            selected={this.state.startDate}
                            onChange={date => this.setState({startDate: date})}
                            maxDate={new Date()}
                            placeholderText="Select a date before 5 days in the future"
                        />
                    </div>
                    <div className="col-md-3">
                        <span className='mr-2'>To Date:</span>
                        <DatePicker
                            selected={this.state.endDate}
                            onChange={date => this.setState({endDate: date})}
                            maxDate={new Date()}
                            placeholderText="Select a date before 5 days in the future"
                        />
                    </div>
                </div>
                <br/>

            </div>
            <div className="subscriptions-list">
                <div className="author-list">
                    <div className="video-wrapper" data-id="6" id="video-6">
                        {this.state.videosWithViews.map((item, id) => {
                            return <Row className="mb-2" key={id}>
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
                                                 strokeWidth="2" strokeLinecap="round" strokeLinejoin="round"
                                                 aria-hidden="true">
                                                <path
                                                    d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path>
                                            </svg>
                                                {item.comments} Comments &nbsp;&nbsp;&nbsp;
                                        </span>
                                        </div>
                                        <div className="video-desc">
                                            Uploaded By: {item.user.username}
                                        </div>
                                        <div className="video-desc">
                                            Video Status:
                                            <span className={item.is_video_approved?'text-success':'text-danger'}>
                                                {item.is_video_approved?' Approved':' Not Approved'}
                                            </span>
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
