import React, { useState, useEffect } from 'react';
import ReactDOM from 'react-dom';
import Create from './Create';
import ExampleList from './ExampleList';

const Example = () => {
  const [data, setData] = useState([]);

  useEffect(() => {
    const fetchData = async () => {
      const result = await axios(
        'http://localhost:8000/api/numberun',
      );
      setData(result.data);
    };

    fetchData();
  }, []);

  return (
    <div className="container-fluid">
      <div className="row">
        <div className="col-md-12">
          <div className="card">
            <div className="card-header">Numberun</div>
            <div className="card-body">
              <button type="button" className="btn btn-primary btn-sm" data-toggle="modal" data-target="#createModal">
                <i className="fa fa-plus" aria-hidden="true"></i> Add New
              </button>
              <div className="modal fade" id="createModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div className="modal-dialog modal-lg">
                  <div className="modal-content">
                    <div className="modal-header">
                      <h5 className="modal-title" id="exampleModalLabel">Create</h5>
                      <button type="button" className="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div className="modal-body mx-1.5">
                      <Create />
                    </div>
                    <div className="modal-footer">
                      <button type="button" className="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                      <button type="button" className="btn btn-primary btn-sm">Save changes</button>
                    </div>
                  </div>
                </div>
              </div>
              <br />
              <br />
              <ExampleList data={data} />
            </div>
          </div>
        </div>
      </div>
    </div>
  )
}

export default Example;

if (document.getElementById('example')) {
  ReactDOM.render(<Example />, document.getElementById('example'));
}