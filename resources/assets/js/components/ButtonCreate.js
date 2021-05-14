import React from 'react';
import Create from './Create';

const ButtonCreate = () => {
  
  return (
    <div>
      <button type="button" className="btn btn-primary btn-sm" data-toggle="modal" data-target="#createModal">
        <i className="fa fa-plus" aria-hidden="true"></i> Add New
      </button>
      <div className="modal fade" id="createModal" tabIndex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Save changes</button>
            </div>
          </div>
        </div>
      </div>
      <br />
      <br />
    </div>

  )
}

export default ButtonCreate
