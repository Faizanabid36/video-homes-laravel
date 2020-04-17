import React from 'react';
import ReactDOM from 'react-dom';
import {Bar} from 'react-chartjs-2';

class Subscribers extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            type: 'today',
            category: [],
            Data: {}
        }
        this.getChartData = this.getChartData.bind(this)
        this.handleChangeInput = this.handleChangeInput.bind(this)
    }

    getChartData() {
        axios.get("/dashboard/" + this.state.type)
            .then((res) => {
                console.log(res)
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
            <h4>Subscribers</h4>
            <br/>
            <div className="form-group">
                <div className="row">
                    <div className="col-md-3 col-sm-6">
                        <div className="vp_mn_dash_stats">
                            <h2 style={{color: '#6abd46'}}>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                     height="24" viewBox="0 0 24 24">
                                    <path fill="currentColor"
                                          d="M17,13H13V17H11V13H7V11H11V7H13V11H17M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2Z"></path>
                                </svg>
                                Total Subscribers
                            </h2>
                            <p>0</p>
                        </div>
                    </div>
                    <div className="col-md-6"></div>
                    <div className="col-md-3">
                        <br/>
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
                <Bar
                    data={this.state.Data}
                    height={45}
                    options={{maintainAspectRatio: false}}
                />
            </div>
        </div>
    }
}

export default Subscribers;
