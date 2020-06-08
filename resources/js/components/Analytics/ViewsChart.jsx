import React from 'react'
// import { Chart } from 'chart.js'
import { Line,Doughnut } from 'react-chartjs-2';
import axios from "axios";
import DatePicker from "react-datepicker";
import {Button, Tab} from "react-bootstrap";
import 'bootstrap-daterangepicker/daterangepicker.css';

import DateRangePicker from 'react-bootstrap-daterangepicker';

// select count(view) views,date from abc where date between 1-1-2020
// and 11-1-2020 group by date having by views > 0 order by date asc


export default class ViewsChart extends React.Component {

    componentDidMount() {
        this.getChartData();
     }

    constructor() {
        super();
        let startDate = new Date()
        startDate.setDate(startDate.getDate() - 1)
        this.state={
            chartData : [],
            endDate: new Date(),
            startDate: startDate,
            doughnutData:[],
            fromPage:[],
            // doughnutData:{
            //     labels: ['views','loads'],
            //     datasets: [{
            //         label: '# of times',
            //         data: [12, 19],
            //         backgroundColor: [
            //             'rgb(255, 102, 102)',
            //             'rgb(209, 71, 163)'
            //         ],
            //         borderColor: [
            //             'rgb(255, 102, 102)',
            //             'rgb(209, 71, 163)'
            //         ],
            //         borderWidth: 1
            //     }]
            // }
        }
        this.getChartData = this.getChartData.bind(this)
        this.handleChangeInput = this.handleChangeInput.bind(this)
    }
    getChartData() {
        let {startDate, endDate} = this.state
        axios.post('get_all_statistics',{startDate,endDate})
            .then((res) => {
                this.setState({...res.data})
                this.setState({chartData:[...this.state.chartData ]
            }
                )
                console.log( 'post state' ,this.state)
            })
            .catch((err) => {
                console.log(err)
            })
    }
    async handleChangeInput(e) {
        this.getChartData();
    }

    render() {
        console.log( 'render' , this.state)
        return (
            <div>
                    <hr/>
                <div className="row">
                    {/* <div className="col-md-4">
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
                        <Button className="btn btn-primarys" onClick={this.handleChangeInput}>
                            Get Statistics
                        </Button>
                    </div> */}
                    <div className="col-12">
                    <DateRangePicker startDate={this.state.startDate} onApply={this.handleChangeInput} endDate={this.state.endDate}>
        <button className="btn btn-primary">Select Range</button>
      </DateRangePicker>
      </div>
                    <hr/>
                </div>
                <hr/>

                <h1> Video Views </h1>
                <p> Number of times videos have been viewed </p>
                <div className="barChart">
                    <Line
                        data={this.state.chartData}
                        width={10}
                        height={5}
                        options={{ maintainAspectRatio: false }}
                    />
                </div>
                <div className="">
                    <Doughnut
                        data={this.state.doughnutData}
                        options={{
                            responsive: true,
                            maintainAspectRatio: true,
                        }}
                    />
                </div>
                <br/>
                <div className="">
                    <Doughnut
                        data={this.state.fromPage}
                        options={{
                            responsive: true,
                            maintainAspectRatio: true,
                        }}
                    />
                </div>
            </div>

        )
    }
}
