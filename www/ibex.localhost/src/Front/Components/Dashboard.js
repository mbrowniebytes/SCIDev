import React, {Component, Fragment} from "react";

import ReactTable from "react-table";
import "react-table/react-table.css";
import "./Dashboard.css";
import ibexApp from 'ibexApp';

export default class Dashboard extends Component {
    constructor(props) {
        super(props);
        this.state = {
            dashboard: {
                topDealersBySales: [],
                topDealersByNumberCustomers: [],
                topCustomersBySales: [],
                customersWithValidEmails: [],
                totalNumberOfCustomers: [],
            },
        };
    }
    componentDidMount() {
        fetch('/data/dashboard')
            .then(response => response.json())
            .then(data => this.setState({ dashboard: data }));
    }
    render() {

        const { testVar } = ibexApp;
        const { dashboard } = this.state;
        const columnsTopDealersBySales = [{
            Header: 'Dealer',
            accessor: 'dealer'
        },{
            Header: 'Sales',
            accessor: 'sales',
            Cell: (cell) => <div className="text-right">{cell.value}</div>
        }];
        const columnsTopDealersByNumberCustomers = [{
            Header: 'Dealer',
            accessor: 'dealer'
        },{
            Header: 'Customers',
            accessor: 'qty',
            Cell: (cell) => <div className="text-right">{cell.value}</div>
        }];
        const columnsTopCustomersBySales = [{
            Header: 'Customers',
            accessor: 'customer'
        },{
            Header: 'Sales',
            accessor: 'sales',
            Cell: (cell) => <div className="text-right">{cell.value}</div>
        }];

        return (
            <Fragment>
                <div className="dashboard container-fluid">
                    <div class="card">
                        <div className="card-title">Top Dealers by Sales</div>
                        <ReactTable
                            data={dashboard.topDealersBySales}
                            columns={columnsTopDealersBySales}
                            //defaultPageSize = {3}
                            //pageSizeOptions = {[3, 6]}
                            minRows = {1}
                            showPagination = {false}
                        />
                    </div>
                    <div class="card">
                        <div className="card-title">Top Dealers by Number of Customers</div>
                        <ReactTable
                            data={dashboard.topDealersByNumberCustomers}
                            columns={columnsTopDealersByNumberCustomers}
                            //defaultPageSize = {3}
                            //pageSizeOptions = {[3, 6]}
                            minRows = {1}
                            showPagination = {false}
                        />
                    </div>
                    <div class="card">
                        <div className="card-title">Top Customers by Sales</div>
                        <ReactTable
                            data={dashboard.topCustomersBySales}
                            columns={columnsTopCustomersBySales}
                            //defaultPageSize = {3}
                            //pageSizeOptions = {[3, 6]}
                            minRows = {1}
                            showPagination = {false}
                        />
                    </div>
                    <div class="card">
                        <div className="card-title">% Customers with Valid Emails</div>
                        <div className="text-center">{dashboard.customersWithValidEmails.percentage}</div>
                    </div>
                    <div class="card">
                        <div className="card-title">Total Number of Customers</div>
                        <div className="text-center">{dashboard.totalNumberOfCustomers.qty}</div>
                    </div>
                </div>
            </Fragment>
        )
    }
}
