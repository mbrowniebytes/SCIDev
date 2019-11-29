import React, {Component, Fragment} from "react";
import { NavLink, Route, Switch } from 'react-router-dom';

import 'bootstrap/dist/css/bootstrap.min.css';
import './Menu.css';
import Dashboard from "./Dashboard";
import Dealers from "./Dealers";
import Customers from "./Customers";
import Settings from "./Settings";
import Contact from "./Contact";


export default class Menu extends Component {

    render() {
        return (
            <div>
                <nav className="navbar navbar-expand-sm navbar-light bg-light">
                    <NavLink className="navbar-brand" to="/">IBEX</NavLink>
                    <div className="collapse navbar-collapse">
                        <NavLink className="nav-item nav-link" activeClassName="active" to="/dashboard">Dashboard</NavLink>
                        <NavLink className="nav-item nav-link" activeClassName="active" to="/dealers">Dealers</NavLink>
                        <NavLink className="nav-item nav-link" activeClassName="active" to="/customers">Customers</NavLink>
                        <NavLink className="nav-item nav-link" activeClassName="active" to="/settings">Settings</NavLink>
                        <NavLink className="nav-item nav-link" activeClassName="active" to="/contact">Contact</NavLink>
                    </div>
                </nav>

                <Switch>
                    <Route exact path="/" component={Dashboard}/>
                    <Route path="/dashboard" component={Dashboard}/>
                    <Route path="/dealers" component={Dealers}/>
                    <Route path="/customers" component={Customers}/>
                    <Route path="/settings" component={Settings}/>
                    <Route path="/contact" component={Contact}/>
                </Switch>
            </div>
        )
    }
}