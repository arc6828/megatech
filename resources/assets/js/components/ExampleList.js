import React from 'react';
import Edit from './Edit';

const ExampleList = ({ data }) => {
  return (
    <div className="table-responsive">
      <table className="table">
        <thead>
          <tr>
            <th>#</th>
            <th>Name Doc</th>
            <th>number_en</th>
            <th>Datetime Doc</th>
            <th>Number Doc</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          {(data.length > 0) ? data.map((item) => {
            return (
              <tr key={item.id}>
                <td>{item.id}</td>
                <td>{item.name_doc}</td>
                <td>{item.number_en}</td>
                <td>{item.datetime_doc}</td>
                <td>{item.number_doc}</td>
                <td>
                  <button type="button" className="btn btn-warning  btn-sm" data-toggle="modal" data-target="#editModal">
                    Edit
                  </button>
                  <div className="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div className="modal-dialog modal-lg">
                      <div className="modal-content">
                        <div className="modal-header">
                          <h5 className="modal-title" id="exampleModalLabel">Edit</h5>
                          <button type="button" className="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div className="modal-body">
                          <Edit />
                        </div>
                        <div className="modal-footer">
                          <button type="button" className="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                          <button type="button" className="btn btn-primary btn-sm">Save changes</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </td>
              </tr>
            )
          }) : <tr><td colSpan="5">Loading...</td></tr>}
        </tbody>
      </table>
    </div>
  )
}

export default ExampleList
