import React, { useState } from 'react';
import NumberApi from '../API/NumberApi';
import { NumberContext } from '../NumberProvider';
import ButtonCreate from './ButtonCreate';
import ExampleList from './ExampleList';


const Number = () => {
  const [numbers, setNumbers] = React.useContext(NumberContext)
  const [message, setMessage] = useState("");
  console.log("🚀 ~ file: Number.js ~ line 10 ~ Number ~ message", message)

  const handleEditNumber = (editValueEn, editValueNumber, id) => {

    const newNumbers = [...numbers]
    newNumbers.map((numbers) => {
      console.log("🚀 ~ file: Number.js ~ line 12 ~ newNumbers.map ~ newNumbers", newNumbers)
      if (numbers.id === id) {
        numbers.number_en = editValueEn
        numbers.number_doc = editValueNumber
      }
    })
    NumberApi.update(numbers.id, numbers)
      .then(response => {
        setNumbers(response.newNumbers.data)
        setMessage("The was updated successfully!");
      })
      .catch(e => {
        console.log(e);
      });
  }

  return (
    <div className="container-fluid">
      <div className="row">
        <div className="col-md-12">
          <div className="card">
            <div className="card-header">Numberun</div>
            <div className="card-body">
              <ButtonCreate />
              <ul className="list-group list-group-horizontal">
                {(numbers.length > 0) ? numbers.map((item) => {
                  return (
                    <ExampleList item={item} key={item.id} id={item.id} handleEditNumber={handleEditNumber} />
                  )
                }) : <p>Loading...</p>}
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  )
}

export default Number
