@extends('monster-lite/layouts/theme')

@section('title','รายละเอียดใบเสนอราคา')

@section('breadcrumb-menu')

@endsection

@section('content')

@forelse($table_quotation as $row)
  <form class="form-material" action="{{ url('/') }}/sales/quotation/{{ $row->quotation_id }}" method="POST">
      {{ csrf_field() }}
      {{ method_field('PUT') }}
    <div class="card">
        <div class="card-block">
          <div class="row"> 
            <div class="col-md-9 align-self-center">              
                <h4 class="card-title">Quotation id : {{ $row->quotation_id }}</h4>
                <h6 class="card-subtitle">Update infomation in the form</h6>
            </div>
            <div class="col-md-3 align-self-center">              
            <div class="dropdown pull-right">
              <button type="button" class="btn btn-secondary btn-circle btn-sm" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="false" aria-expanded="false" style="border: none;"><i class="fa fa-ellipsis-v"></i> </button>             
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                <form id="form-delete" style="display: none;" action="{{ url('/') }}/sales/quotation/{{ $row->quotation_id }}" method="POST">
                  {{ csrf_field() }}
                  {{ method_field('DELETE') }}
                  <button class="btn btn-danger" type="submit">
                    <i class="fa fa-trash-o"></i> Remove
                  </button>
                </form>
                <a class="dropdown-item" href="javascript:document.getElementById('form-delete').submit();">
                  <i class="fa fa-trash-o"></i> Remove
                </a>
              </div>
            </div>      
            </div>
          </div>
          
          
          <div>

            <div class="form-group form-inline">
              <label class="col-md-2">เลขที่เอกสาร</label>
              <div class="col-md-3">
                <input type="text" name="quotation_number" class="form-control form-control-line" value="{{ $row->quotation_num }}" readonly>
              </div>
              <label class="col-md-2 offset-md-1">วันที่</label>
              <div class="col-md-3">
                <input type="date" name="datetime" class="form-control form-control-line"  value="{{ $row->datetime }}" >
              </div>
            </div>    

            <div class="form-group form-inline">
                <label class="col-md-2">รหัสลูกค้า</label>
                <div class="col-md-3">
                <input type="text" name="customer_id" class="form-control form-control-line"  value="{{ $row->customer_id }}" >
                </div>
            </div>

            <div class="form-group form-inline">
                <label class="col-md-2">ระยะเวลาหนี้</label>
                <div class="col-md-3">
                  <input type="number" name="debt_duration"  class="form-control form-control-line"  value="{{ $row->debt_duration }}" >
                </div>
                <label class="col-md-2 offset-md-1">กำหนดยื่นราคา</label>
                <div class="col-md-3">
                  <input type="number" name="billing_duration"  class="form-control form-control-line" value="{{ $row->billing_duration }}" >
                </div>
            </div>

            <div class="form-group form-inline">
                <label class="col-md-2">เงื่อนไขการชำระเงิน</label>
                <div class="col-md-3">
                  <input type="number" name="payment_condition"  class="form-control form-control-line" value="{{ $row->payment_condition }}" >
                </div>
                <label class="col-md-2 offset-md-1">ขนส่งโดย</label>
                <div class="col-md-3">
                <input type="number" name="transportation"  class="form-control form-control-line" value="{{ $row->transportation }}" >
                </div>
            </div>

            <div class="form-group form-inline">
                <label class="col-md-2">ชนิดภาษี</label>
                <div class="col-md-3">
                <input type="number" name="tax_type"  class="form-control form-control-line" value="{{ $row->tax_type }}" >
                </div>
                <label class="col-md-2 offset-md-1">รหัส JOB#</label>
                <div class="col-md-3">
                <input type="number" name="job_id"  class="form-control form-control-line" value="{{ $row->job_id }}" >
                </div>
            </div>

            <div class="form-group form-inline">
                <label class="col-md-2">รหัสแผนก</label>
                <div class="col-md-3">
                <input type="number" name="department_id"  class="form-control form-control-line" value="{{ $row->department_id }}" >
                </div>
                <label class="col-md-2 offset-md-1">สถานะ</label>
                <div class="col-md-3">
                <input type="number" name="status"  class="form-control form-control-line" value="{{ $row->status }}" >
                </div>
            </div>

            <div class="form-group form-inline">
              <label class="col-md-2">รหัสพนักงานขาย</label>
              <div class="col-md-3">
                <input type="number" name="user_id"  class="form-control form-control-line" value="{{ $row->user_id }}" >
                </div>
              <label class="col-md-2 offset-md-1">เขตการขาย</label>
              <div class="col-md-3">
                <input type="number" name="zone"  class="form-control form-control-line" value="{{ $row->zone }}" >
                </div>
            </div>

          </div>

        </div>
      </div>
      <div class="card">
        <div class="card-block">
          <div class="table-responsive">
            <table class="table table-hover text-center">
              <thead>
                <tr>          
                  <th class="text-center">รหัสสินค้า</th>
                  <th class="text-center">รายละเอียดสินค้า</th>
                  <th class="text-center">จำนวน</th>
                  <th class="text-center">หน่วย</th>
                  <th class="text-center">ราคาตั้ง</th>
                  <th class="text-center">ส่วนลด %</th>
                  <th class="text-center">ราคาขาย</th>
                  <th class="text-center">ราคาขายรวม</th>
                  <th class="text-center">action</th>
                </tr> 
              </thead>
              <tbody>
                @foreach($table_quotation_detail as $row)
                <tr>
                  <td>
                    <a href="{{ url('/') }}/sales/quotation/{{ $row->quotation_detail_id }}/edit">  
                      {{ $row->product_id }}
                    </a>
                  </td>
                  <td>{{ $row->product_detail }}</td>
                  <td>{{ $row->amount }}</td>
                  <td>{{ $row->unit }}</td>
                  <td>{{ $row->price }}</td>
                  <td>{{ $row->discount }}</td>
                  <td>{{ $row->value }}</td>
                  <td>
                    <a href="#"><span class="fa fa-trash" style="color: red"></span></a>
                    <div class="row hide">
                      <form action="{{ url('/') }}/sales/quotation/{{ $row->quotation_id }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button type="submit"></button>
                      </form>
                    </div>
                  </td>
                </tr> 
                @endforeach 
              </tbody>          
            </table>  
          </div>
        </div>
      </div>

      <div class="card">
        <div class="card-block">
          
                <div class="form-group form-inline">
                  <label class="col-sm-6">Ref No.</label>
                  <div class="col-sm-6">
                    <input type="number" name="ref_no"  class="form-control form-control-line" value="{{ $row->ref_no }}" >
                  </div>
                </div>            
                <div class="form-group form-inline">
                  <label class="col-sm-6">Remark 2</label>
                  <div class="col-sm-6">
                    <input type="number" name="remark2"  class="form-control form-control-line" value="{{ $row->remark2 }}" >
                  </div>
                </div> 

                <div class="form-group form-inline">
                  <label class="col-sm-6">หมายเหตุ</label>
                  <div class="col-sm-6">
                    <input type="number" name="remark1"  class="form-control form-control-line" value="{{ $row->remark1 }}" >
                  </div>
                </div>        
                       
          </div>          
      </div>

      <div class="card">
        <div class="card-block">
            <div class="row">
              <div class="col-sm-12">
                <div class="form-group form-inline">
                  <label class="col-sm-3 offset-sm-6">ยอดรวม</label>
                  <div class="col-sm-3">
                    <input type="number" name="user_id"  class="form-control form-control-line" value="0" readonly>
                  </div>
                </div>
                <div class="form-group form-inline">
                  <label class="col-sm-3">ส่วนลด</label>
                  <div class="col-sm-3">
                    <input type="number" name="discount"  class="form-control form-control-line" value="{{ $row->discount }}" >
                  </div>
                  <label class="col-sm-3">0.00</label>
                  <div class="col-sm-3">
                    <input type="number" name="zone"  class="form-control form-control-line" value="0.00" >
                  </div>
                </div>
                <div class="form-group form-inline">
                  <label class="col-sm-3">อัตราภาษี</label>
                  <div class="col-sm-3">
                    <input type="number" name="tax_rate"  class="form-control form-control-line" value="{{ $row->tax_rate }}" readonly>
                    </div>
                  <label class="col-sm-3">มูลค่าภาษี</label>
                  <div class="col-sm-3">
                    <input type="number" name="tax"  class="form-control form-control-line" value="{{ $row->tax }}" >
                  </div>
                  </div>
                <div class="form-group form-inline">
                  <label class="col-sm-3 offset-sm-6">ยอดสุทธิ</label>
                  <div class="col-sm-3">
                    <input type="number" name="total"  class="form-control form-control-line" value="{{ $row->total }}" >
                  </div>
                </div>
              </div>
            </div>


            <div class="form-group">
              <div class="col-sm-12">
                <div class="pull-right">
                  <a class="btn btn-outline-primary" href="{{ url('/') }}/sales/quotation">back</a>
                  <button class="btn btn-success" type="submit" >Update</button>
                </div>
              </div>
            </div>  

          </div>
      </div>   

</form>   
@empty
<div class="text-center">
  This activity id ({{ $row->id_activity }}) does not exist
</div>
@endforelse 

@endsection 