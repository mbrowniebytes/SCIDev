import React, {Component, Fragment} from "react";

import ReactTable from "react-table";
import "react-table/react-table.css";
import "./Dealers.css";

export default class Dealers extends Component {
    constructor(props) {
        super(props);
        this.state = {
            dealers: [],
        };
    }
    componentDidMount() {
        fetch('/data/dealers')
            .then(response => response.json())
            .then(data => this.setState({ dealers: data }));
    }
    render() {

        const { dealers } = this.state;
        const columns = [{
            Header: 'ID',
            accessor: 'dealer_id'
        },{
            Header: 'Name',
            accessor: 'name'
        },{
            Header: 'Address',
            accessor: 'address'
        },{
            Header: 'City',
            accessor: 'city'
        },{
            Header: 'State',
            accessor: 'state'
        },{
            Header: 'Zip',
            accessor: 'zip'
        }];

        return (
            <Fragment>
                <div className="dealers container-fluid">
                    <div class="card">
                        <div className="card-title">Dealers</div>
                        <ReactTable
                            data={dealers}
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
