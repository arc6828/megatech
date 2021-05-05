import React from 'react';
import { Link } from 'react-router-dom';

const Index = () => {
  return (
    <div className="container-fluid">
      <div className="row">
        <div className="col-md-12">
          <div className="card">
            <div className="card-header">Company</div>
            <div className="card-body">
              <Link to={`/create`} className="btn btn-success btn-sm" title="Add New Company">
                <i className="fa fa-plus" aria-hidden="true"></i> Add New
              </Link>
              <form method="GET" action="{{ url('/company') }}" accept-charset="UTF-8"
                className="form-inline my-2 my-lg-0 float-right" role="search">
                <div className="input-group">
                  <input type="text" className="form-control" name="search" placeholder="Search..."
                    value="" />
                  <span className="input-group-append">
                    <button className="btn btn-secondary" type="submit">
                      <i className="fa fa-search"></i>
                    </button>
                  </span>
                </div>
              </form>
              <br />
              <br />
              <div className="table-responsive">
                <table className="table">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Thname Company</th>
                      <th>Enname Company</th>
                      <th>Address</th>
                      <th>Tal</th>
                      <th>Fax</th>
                      <th>Number Tex</th>
                      <th>Image</th>
                      <th>Email</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div >
  )
}

export default Index
