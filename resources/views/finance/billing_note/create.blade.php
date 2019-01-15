@extends('monster-lite/layouts/theme')

@section('title','เพิ่มใบวางบิล')

@section('navbar-menu')
<div style="margin:21px;">
        <a href="javascript:void(0)" onclick="summitform()" class="btn btn-success">Save</a>
        <a href="{{ url('/') }}/finance/billing" class="btn btn-danger">Back</a>
</div>
@endsection

@section('breadcrumb-menu')

@endsection

@section('content')

<form action="#" id="form-billing" method="POST">
    {{ csrf_field() }}
    {{ method_field('POST') }}


<div class="card">
    <div class="card-block">
        <div class="row">
            <div class="col-lg-6">
                    <div class="form-group form-inline">
                        <label class="col-lg-3">เลขที่เอกสาร</label>
                            <div class="col-lg-3">
                                <input type="text" name="billing_note_code"  class="form-control form-control-line"  >
                            </div>
                     </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group form-inline">
                     <label class="col-lg-3">วันที่</label>
                        <div class="col-lg-3">
                            <input type="date" name="date"  class="form-control form-control-line"  >
                        </div>
                </div>
            </div>
        </div>
      <div class="row">
          <div class="col-lg-6">
                <div class="form-group form-inline">
                        <label class="col-lg-3">รหัสลูกค้า</label>
                            <div class="col-lg-5">
                                <input type="text" name="customer_id" id="customer_id"  class="form-control form-control-line">
                            </div>
                            @include('finance/billing_note/modal-customer')  
                     </div>
          </div>
      </div>
      <div class="row">
          <div class="col-lg-6">
              <div class="form-group form-inline">
                  <label class="col-lg-3">เงื่อนไขวางบิล</label>
                  <div class="col-lg-3">
                    <input type="text" name="billing_condition" class="form-control form-control-line">
                  </div>
              </div>
          </div>
          <div class="col-lg-6">
              <div class="form-group form-inline">
                  <label class="col-lg-3">เงื่อนไข รับเช็ค</label>
                  <div class="col-lg-3">
                      <input type="text" name="payment_condition" class="form-control form-control-line">
                  </div>
              </div>
          </div>
      </div>
      <div class="row">
            <div class="col-lg-6">
                <div class="form-group form-inline">
                    <label class="col-lg-3">วันที่ไปวางบิล</label>
                    <div class="col-lg-5">
                      <input type="date" name="billing_date" id="billing_date" class="form-control form-control-line">
                    </div>
                    <a href="javascript:void(0)" onclick="clearBilling_date()" class="btn btn-primary"><i class="fa fa-times"></i>Clear</a>
                </div>
            </div>
            <div class="col-lg-6">
                    <div class="form-group form-inline">
                        <label class="col-lg-3">วันนัดรับ</label>
                        <div class="col-lg-5">
                          <input type="date" name="cheque_date" id="cheque_date" class="form-control form-control-line">
                        </div>
                        <a href="javascipt:void(0)" onclick="clearCheque_date()" class="btn btn-primary"><i class="fa fa-times"></i>Clear</a>
                    </div>
            </div>
      </div>
      <div class="row">
        <div class="col-lg-9">
                <div class="form-group form-inline">
                        <label class="col-lg-2">หมายเหตุ</label>
                        <div class="col-lg-7">
                                <input type="text" name="remark" class="form-control form-control-line" style="width:100%">
                        </div>  
                  </div>
        </div>
      </div>
      <div class="row">
          <div class="col-lg-6">
              <div class="form-group form-inline">
                <label class="col-lg-3">รหัสพนักงาน</label>
                <div class="col-lg-5">
                    <input type="text" name="user_id" id="user_id" class="form-control form-control-line" >
                </div>
              @include('customer/modal-user')
              </div>
          </div>
      </div>

      <table class="table">
          <thead>
              <tr>
                  <th>ที่</th>
                  <th>เลือก</th>
                  <th>เอกสารตั้งหนี้/ลดหนี้</th>
                  <th>วันที่</th>
                  <th>วันครบกำหนด</th>
                  <th>เลขที่อ้างอิง</th>
                  <th>ยอดเงิน</th>
              </tr>
          </thead>
          <tbody>
              <tr>
                  <td>1</td>
              </tr>
              <tr>
                <td>2</td>
              </tr>
              <tr>
                    <td>3</td>
              </tr>
              <tr><td>4</td></tr>
              <tr><td>5</td></tr>
              <tr><td>6</td></tr>
              <tr><td>7</td></tr>
              <tr><td>8</td></tr>
              <tr><td>9</td></tr>
              <tr><td>10</td></tr>
              <tr><td>11</td></tr>
              <tr><td>12</td></tr>
              <tr><td>13</td></tr>
              <tr><td>14</td></tr>
              <tr><td>15</td></tr>
              <tr><td>16</td></tr>
              <tr><td>17</td></tr>
              <tr><td>18</td></tr>
              <tr><td>19</td></tr>
          </tbody>
      </table>
    </div>
</div>
<div class="right" style="float:right;margin-right: 20%">
    <label>ยอดเงินรวม</label>
    
</div>


</form>

<script>
        function summitform(){
            var form = document.getElementById('form-billing');
            form.action = "{{ url('/') }}/finance/billing";
            form.submit();
        }
        function clearBilling_date() {
            var billing_date = document.getElementById('billing_date');
            billing_date.value = "";
        }
        function clearCheque_date() {
            var cheque_date = document.getElementById('cheque_date');
            cheque_date.value = "";
        }
</script>
@endsection