import React, {Component, Fragment} from "react";
import { Link, Route, Switch } from 'react-router-dom';

import Dashboard from './Dashboard';
import Dealers from './Dealers';
import Settings from './Settings';
import Contact from './Contact';

export default class Routes extends Component {
    render() {

        return (
            <Switch>
                <Route exact path="/" component={Dashboard}/>
                <Route path="/dashboard" component={Dashboard}/>
                <Route path="/dealers" component={Dealers}/>
                <Route path="/settings" component={Settings}/>
                <Route path="/contact" component={Contact}/>
            </Switch>
        )
    }
}