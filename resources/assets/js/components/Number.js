import React from 'react';
import { NumberContext } from '../NumberProvider';
import ButtonCreate from './ButtonCreate';
import ExampleList from './ExampleList';
const Number = () => {
  const [numbers, setNumbers] = React.useContext(NumberContext)

  const handleEditNumber = (editvalue, id) => {
    const newNumbers = [...numbers]
    newNumbers.forEach((numbers, index) => {
      if (numbers.id === id) {
        numbers.name_doc = editvalue
      }
    })
    setNumbers(newNumbers)
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
                    <ExampleList item={item} key={item.id} id={item.id} handleEditTodos={handleEditNumber} />
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
