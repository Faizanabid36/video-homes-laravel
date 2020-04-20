import React from 'react';
import ReactDOM from 'react-dom';
import {BrowserRouter, Link, Route, Switch} from 'react-router-dom';
import ChannelAnalytics from './ChannelAnalytics';
import LastMonthComparison from "./LastMonthComparison";
import Subscribers from "./Subscribers";

class DashboardComponents extends React.Component {
    render() {
        return <div>
            <ChannelAnalytics/>
            <hr/>
            <LastMonthComparison/>
            <hr/>
            <Subscribers/>
        </div>
    }
}

export default DashboardComponents;
