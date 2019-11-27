import React, { Component, Fragment } from 'react';
import { render } from 'react-dom';
import { asyncComponent } from 'react-async-component';
import { BrowserRouter } from 'react-router-dom';

// import 'normalize.css';
import 'bootstrap/dist/css/bootstrap.min.css';
import './css/app.css';

import Menu from './Components/Menu';



export default class App extends React.Component {
    render() {
        return (
            <BrowserRouter>
            <div>
                <Menu/>
            </div>
            </BrowserRouter>
        );
    }
}

render(<App/>, document.getElementById('app'));
