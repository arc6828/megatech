import React from 'react';

const Edit = () => {
  return (
    <div>
      <div class="form-group row pl-5{{ $errors->has('name_qt') ? 'has-error' : '' }}">
        <label for="name_qt" class="control-label pt-1">ตั้งค่าเลขเริ่มต้นเอกสาร</label>
        <input class="form-control form-control-sm  col-lg-2 mx-2" name="name_doc" type="text" id="name_doc"
          placeholder="ชื่อเอกสาร" value="" />
        <input class="form-control form-control-sm  col-lg-2 mx-2" name="number_en" type="text" id="number_en"
          placeholder="ตัวย่อชื่อเอกสาร" value="" />
        <input class="form-control form-control-sm  col-lg-3 mx-2" name="datetime_doc" type="datetime-local"
          id="datetime_doc" placeholder="ปีที่ใช้ในเอกสาร"
          value="" />
        <input class="form-control form-control-sm  col-lg-2 mx-2" name="number_doc" type="text" id="number_doc"
          placeholder="เลขที่ใช้รันเอกสาร" value="" />
      </div>
    </div>
  )
}


export default Edit
