import React, { Component, Fragment } from 'react';
import { render } from 'react-dom';
import { asyncComponent } from 'react-async-component';
import 'normalize.css';
import './css/app.css';

import ibexApp from 'ibexApp';

class Dashboard extends Component {
    render() {

        const { logged } = ibexApp;

        return (
        <Fragment>
            <div className="dashboard">
                {logged &&
                    <h2 className="status">Logged In</h2>
                }
                <div>KPI 1</div>
                <div>KPI 2</div>
                <div>KPI 3</div>
                <div>KPI 4</div>
                <div>KPI 5</div>
                <div>KPI 6</div>

            <p>API host variable {__API_HOST__}</p>
            </div>
        </Fragment>
    )
    }
}

render(<Dashboard/>, document.getElementById('app'));
