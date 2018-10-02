
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
      <div class="row">
        <div class="col-lg-12">
          <div class="form-group form-inline">
            <label class="col-lg-3 offset-lg-6">ยอดรวม</label>
            <div class="col-lg-3">
              <input type="number" name="total"  class="form-control form-control-line" value="{{ $row->total }}" readonly>
            </div>
          </div>
          <div class="form-group form-inline">
            <label class="col-lg-3">อัตราภาษี</label>
            <div class="col-lg-3">
              <input type="number" name="tax_rate"  class="form-control form-control-line" value="{{ $row->tax_rate }}" >
              </div>
            <label class="col-lg-3">มูลค่าภาษี</label>
            <div class="col-lg-3">
              <input type="number" name="tax"  class="form-control form-control-line" value="{{ $row->tax }}" >
            </div>
            </div>
          <div class="form-group form-inline">
            <label class="col-lg-3 offset-lg-6">ยอดสุทธิ</label>
            <div class="col-lg-3">
              <input type="number" name="total_tax"  class="form-control form-control-line" value="{{ $row->total_tax }}" readonly>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
