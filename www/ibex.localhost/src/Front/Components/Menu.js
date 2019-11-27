import React, {Component, Fragment} from "react";
import { NavLink, Route, Switch } from 'react-router-dom';

import 'bootstrap/dist/css/bootstrap.min.css';
import './Menu.css';
import Dashboard from "./Dashboard";
import Dealers from "./Dealers";
import Settings from "./Settings";
import Contact from "./Contact";


export default class Menu extends Component {

    render() {
        return (
            <div>
                <nav className="navbar navbar-expand-lg navbar-light bg-light">
                    <a className="navbar-brand"><NavLink to="/">IBEX</NavLink></a>
                    <div className="collapse navbar-collapse">
                        <NavLink className="nav-item nav-link" activeClassName="active" to="/dashboard">Dashboard</NavLink>
                        <NavLink className="nav-item nav-link" activeClassName="active" to="/dealers">Dealers</NavLink>
                        <NavLink className="nav-item nav-link" activeClassName="active" to="/settings">Settings</NavLink>
                        <NavLink className="nav-item nav-link" activeClassName="active" to="/contact">Contact</NavLink>
                    </div>
                </nav>

                <Switch>
                    <Route exact path="/" component={Dashboard}/>
                    <Route path="/dashboard" component={Dashboard}/>
                    <Route path="/dealers" component={Dealers}/>
                    <Route path="/settings" component={Settings}/>
                    <Route path="/contact" component={Contact}/>
                </Switch>
            </div>
        )
    }
}