import React from 'react';
import {Button, Card} from 'react-bootstrap';
import {Tabs, Tab , Row} from 'react-bootstrap' ;
import {FontAwesomeIcon} from "@fortawesome/react-fontawesome";
import {
    faEye,
    faComment
} from "@fortawesome/free-solid-svg-icons";
import DatePicker from "react-datepicker";
import "react-datepicker/dist/react-datepicker.css";
import ViewsChart from "./Analytics/ViewsChart";

class Analytics extends React.Component {
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
                console.log(res.data)
            })
            .catch((err) => {
                console.log(err)
            })
    }

    componentDidMount() {
        this.getChartData();
    }

    async handleChangeInput(e) {
        await this.setState({type: e.target.value})
        this.getChartData();
    }

    render() {
        return (
            
                <div className="container">
            <h1> Analytics <div className="borderBottom2"> </div> </h1>
            <Tabs defaultActiveKey="Indiviual-Videos" className="border" id="uncontrolled-tab-example">
                <Tab eventKey="Overall-Videos" title="Overall Statistics">
                    <ViewsChart/>
                    <hr/>

                </Tab>
                <Tab eventKey="Indiviual-Videos" title="Individual Videos">
                    <hr/>
                    <div className="row">
                        <div className="col-md-4">
                            <label className='mr-2'>From Date:</label>
                            <DatePicker
                                className="form-control"
                                selected={this.state.startDate}
                                onChange={date => this.setState({startDate: date})}
                                maxDate={new Date()}
                                placeholderText="Select a date before 5 days in the future"
                            />
                        </div>
                        <div className="col-md-4">
                            <label className='mr-2'>To Date:</label>
                            <DatePicker
                                className="form-control"
                                selected={this.state.endDate}
                                onChange={date => this.setState({endDate: date})}
                                maxDate={new Date()}
                                placeholderText="Select a date before 5 days in the future"
                            />
                        </div>
                        <div className="col-md-4">
                            <Button className="btn btn-primary" onClick={this.handleChangeInput}>
                                Get Statistics
                            </Button>
                        </div>
                    </div>
                    <hr/>
                    
                    <div className="Analytics_Card_Container">
                        {this.state.videosWithViews.length  ?      this.state.videosWithViews.map((item,id)=>{
                            return <div className="Card3_container" key={id}>
                                <Card style={{width: '18rem'}} className="card3">
                                    <Card.Img variant="top" height="95"  src={window.VIDEO_APP.base_url+'/storage/'+item.thumbnail}/>
                                    <Card.Body className="card-body">
                                        <Card.Title>{item.title}</Card.Title>
                                        <Card.Text>
                                            <FontAwesomeIcon
                                                icon={faEye}
                                                className=""
                                                color="black"
                                            />{" "}
                                            {item.views} Views
                                            <br/>
                                            <FontAwesomeIcon
                                                icon={faComment}
                                                className=""
                                                color="black"
                                            />{" "}
                                            {"  "}
                                            {item.comments} Comments
                                        </Card.Text>
                                    </Card.Body>
                                </Card>
                            </div>
                        }) :  <h2 className="Novideos"> No Videos Found  </h2> };  
                    </div>
                </Tab>

            </Tabs>


        </div>
        
        )
    }

}

export default Analytics
