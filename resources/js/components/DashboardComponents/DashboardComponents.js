import React from 'react';
import ReactDOM from 'react-dom';
import {BrowserRouter, Link, Route, Switch} from 'react-router-dom';
import ChannelAnalytics from './ChannelAnalytics';
import LastMonthComparison from "./LastMonthComparison";
import Subscribers from "./Subscribers";

class DashboardComponents extends React.Component {
    constructor(props) {
        super(props);
        this.state={
            totalComments:this.props.totalComments
        }
    }
    render() {
        return <div>
            <ChannelAnalytics totalComments={this.state.totalComments} />
            <hr/>
            <LastMonthComparison/>
            <hr/>
            <Subscribers/>
        </div>
    }
}

export default DashboardComponents;
