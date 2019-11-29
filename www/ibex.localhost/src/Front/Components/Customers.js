import React, {Component, Fragment} from "react";

import ReactTable from "react-table";
import "react-table/react-table.css";
import "./Customers.css";

function validEmail(email)
{
    const re = /\S+@\S+\.\S+/;
    return re.test(email);
}
function validateCell(column, cell)
{
    // console.log(cell);
    if (column === 'customer_name') {
        if (cell.value === '') {
            return <div className="alert alert-warning">missing</div>
        }
    } else if (column === 'email') {
        if (cell.value === '') {
            return <div className="alert alert-warning">missing</div>
        } else if (!validEmail(cell.value)) {
            return customer.email + <div className="alert alert-warning">invalid</div>
        }
    }
    return cell.value;
}
function exportCustomers()
{
    // yeah, could iframe or load into brower and then download
    // but just doing a simple html form works too
    fetch('/data/customers/export', {
        method: 'POST',
    })
        .then(response => {})
}

class ExportCustomers extends Component {
    render() {
        return (
            <Fragment>
                <div className=" float-right">
            <form method="POST" action="/data/customers/export">
                <button className="btn btn-primary" type="submit">Export Distinct List</button>
            </form>
                </div>
            </Fragment>
        )
    }
}

export default class Customers extends Component {
    constructor(props) {
        super(props);
        this.state = {
            customers: [],
        };
    }
    componentDidMount() {
        fetch('/data/customers')
            .then(response => response.json())
            .then(data => this.setState({ customers: data }))
    }
    render() {

        const { customers } = this.state;
        const columns = [{
            Header: 'ID',
            accessor: 'customer_id'
        },{
            Header: 'Name',
            accessor: 'customer_name',
            Cell: (cell) => validateCell('customer_name', cell)
        },{
            Header: 'Email',
            accessor: 'email',
            Cell: (cell) => validateCell('email', cell)
        },{
            Header: 'Dealer',
            accessor: 'dealer_name'
        }];

        return (
            <Fragment>
                <div className="customers container-fluid">
                    <div className="card">
                        <div className="card-title">Customers <ExportCustomers></ExportCustomers></div>
                        <ReactTable
                            data={customers}
                            columns={columns}
                            defaultPageSize = {10}
                            pageSizeOptions = {[10, 20]}
                            minRows = {1}
                            // showPagination = {false}
                        />
                    </div>
                </div>
            </Fragment>
        )
    }
}
