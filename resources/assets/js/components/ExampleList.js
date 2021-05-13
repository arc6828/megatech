import React, { useState } from 'react';

const ExampleList = ({ item, id }) => {
  const [onEdit, setOnEdit] = useState(false);

  const handleOnEdit = () => {
    setOnEdit(true)
  }

  const handleSave = id => {
    setOnEdit(false)
    if (editValue) {
      handleEditNumber(editValue, id)
    } else {
      setEditValue(item.name_doc)
    }
  }

  if (onEdit) {
    return (
      <li className="list-group-item">
        <div className="form-row">
          <div className="col-sm-2">
            <input
              className="form-control form-control-sm"
              type="text"
              value={item.name_doc}
              name="name_doc"
              id="name_doc"
              disabled
            />
          </div>
          <div className="col-sm-1">
            <input
              type="text"
              className="form-control form-control-sm"
              value={item.number_en}
              name="number_en"
              id="number_en"
            />
          </div>
          <div className="col-sm-2">
            <input
              type="datetime-local"
              className="form-control form-control-sm"
              value={item.datetime_doc}
              name="datetime_doc"
              id="datetime_doc"
              disabled
            />
          </div>
          <div className="col-sm-1">
            <input
              type="text"
              className="form-control form-control-sm"
              value={item.number_doc}
              name="number_doc"
              id="number_doc"
            />
          </div>
          <div className="col-sm-2">
            <button type="submit" className="btn btn-warning btn-sm">
              save
            </button>
          </div>
        </div>
      </li>

    )
  } else {
    return (
      <li className="list-group-item">
        <div className="form-row">
          <div className="col-sm-2">
            <input
              className="form-control form-control-sm"
              type="text"
              value={item.name_doc}
              name="name_doc"
              id="name_doc"
              disabled
            />
          </div>
          <div className="col-sm-1">
            <input
              type="text"
              className="form-control form-control-sm"
              value={item.number_en}
              name="number_en"
              id="number_en"
              disabled
            />
          </div>
          <div className="col-sm-2">
            <input
              type="text"
              className="form-control form-control-sm"
              value={item.datetime_doc}
              name="datetime_doc"
              id="datetime_doc"
              disabled
            />
          </div>
          <div className="col-sm-1">
            <input
              type="text"
              className="form-control form-control-sm"
              value={item.number_doc}
              name="number_doc"
              id="number_doc"
              disabled
            />
          </div>
          <div className="col-sm-2">
            <button type="submit" className="btn btn-warning btn-sm" onClick={handleOnEdit}>
              edit
            </button>
          </div>
        </div>
      </li>
    )
  }
}
export default ExampleList
{/* <label htmlFor="inputEmail4">ชื่อเอกสาร</label>
        <input className="form-control form-control-sm" type="text" value={editValue} name="editValue" />
        <button type="submit" className="btn btn-warning" onClick={handleOnEdit}>
          edit
        </button> */}