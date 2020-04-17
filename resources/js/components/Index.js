import React from 'react';
import ReactDOM from 'react-dom';
import { BrowserRouter, Route, Switch, Link } from 'react-router-dom';
import Dashboard from "./Dashboard";

class Index extends React.Component{
    render() {
        return <main>
            <Switch>
                <Route path='/dashboard' component={Dashboard} />
                {/*<Route path="/shop" component={Shop} />*/}
            </Switch>
        </main>
    }
}

export default Index;

if (document.getElementById('container')) {
    ReactDOM.render(
        <BrowserRouter>
            <Index />
        </BrowserRouter>
        , document.getElementById('container'));
}
