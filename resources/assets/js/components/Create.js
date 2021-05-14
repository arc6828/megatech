import React, { useContext } from 'react';
import NumberApi from '../API/NumberApi';
import { NumberContext } from '../NumberProvider';


const Create = () => {
  const [numbers, setNumbers] = useContext(NumberContext);

  const handleInputChange = event => {
    const { name, value } = event.target;
    setNumbers({ ...numbers, [name]: value });
  };

  const addNumber = () => {
    let data = {
      name_doc: numbers.name_doc,
      number_doc: numbers.number_doc,
      number_en: numbers.number_en,
      datetime_doc: numbers.datetime_doc,
    };
    NumberApi.create(data)
      .then(response => {
        setNumbers({
          name_doc: response.data.name_doc,
          number_doc: response.data.number_doc,
          number_en: response.data.number_en,
          datetime_doc: response.data.datetime_doc
        });
        console.log("..", response.data)
      })
      .catch(e => {
        console.log(e);
      });
  }
  console.log("addNumber", addNumber)

  return (
    <div className="form-group row pl-5">
      <label htmlFor="name_qt" className="control-label pt-1">ตั้งค่าเลขเริ่มต้นเอกสาร</label>
      <input className="form-control form-control-sm  col-lg-2 mx-2" name="name_doc" type="text" id="name_doc"
        placeholder="ชื่อเอกสาร" value={numbers.name_doc} onChange={handleInputChange} />
      <input className="form-control form-control-sm  col-lg-2 mx-2" name="number_en" type="text" id="number_en"
        placeholder="ตัวย่อชื่อเอกสาร" value={numbers.number_en} onChange={handleInputChange} />
      <input className="form-control form-control-sm  col-lg-3 mx-2" name="datetime_doc" type="datetime-local"
        id="datetime_doc" placeholder="ปีที่ใช้ในเอกสาร"
        value={numbers.datetime_doc} onChange={handleInputChange} />
      <input className="form-control form-control-sm  col-lg-2 mx-2" name="number_doc" type="text" id="number_doc"
        placeholder="เลขที่ใช้รันเอกสาร" value={numbers.number_doc} onChange={handleInputChange} />
      {/* <button className="btn btn-primary btn-sm" onClick={addNumber}>Create</button> */}
    </div>


  )
}

export default Create
