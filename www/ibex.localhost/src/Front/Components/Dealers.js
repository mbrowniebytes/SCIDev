import React, {Component, Fragment} from "react";
import ibexApp from 'ibexApp';

export default class Dealers extends Component {
    render() {

        const { logged } = ibexApp;

        return (
            <Fragment>
                <div className="dealers grid">
                    grid of dealers

                    <p>API host variable {__API_HOST__}</p>
                </div>
            </Fragment>
        )
    }
}
