<div class="form-group row px-5{{ $errors->has('name_qt') ? 'has-error' : '' }}">
    <label for="name_qt" class="control-label px-1">{{ 'ตั้งค่าเลขเริ่มต้นเอกสาร' }}</label>
    <input class="form-control form-control-sm  col-lg-2" name="name_doc" type="text" id="name_doc"
        placeholder="ชื่อเอกสาร" value="{{ isset($numberun->name_doc) ? $numberun->name_doc : '' }}">
    <input class="form-control form-control-sm  col-lg-2" name="number_en" type="text" id="number_en"
        placeholder="ตัวย่อชื่อเอกสาร" value="{{ isset($numberun->number_en) ? $numberun->number_en : '' }}">
    <input class="form-control form-control-sm  col-lg-3" name="datetime_doc" type="datetime-local"
        id="datetime_doc" placeholder="ปีที่ใช้ในเอกสาร"
        value="{{ isset($numberun->datetime_doc) ? $numberun->datetime_doc : '' }}">
    <input class="form-control form-control-sm  col-lg-2" name="number_doc" type="text" id="number_doc"
        placeholder="เลขที่ใช้รันเอกสาร" value="{{ isset($numberun->number_doc) ? $numberun->number_doc : '' }}">
</div>
<div class="form-group" style="text-align:right">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
<style>
    .row {
        display: flex;
        flex-wrap: wrap;
        align-content: space-around;
        align-items: stretch;
        justify-content: space-between;
    }

</style>
