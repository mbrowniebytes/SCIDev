import React, {Component, Fragment} from "react";
import ibexApp from 'ibexApp';

export default class Dashboard extends Component {
    render() {

        const { testVar } = ibexApp;

        return (
            <Fragment>
                <div className="dashboard">
                    {testVar &&
                    <h2 className="status">testVar is true</h2>
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
