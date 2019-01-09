
<div class="card">
  <div class="card-block">

    <div class="row">
        <div class="col-lg-9 align-self-center">
            <h4 class="card-title">Invoice Detail</h4>
            <h6 class="card-subtitle">Display infomation in the table</h6>
        </div>
        <div class="col-lg-3 align-self-center">
			<a href="{{ url('/') }}/sales/invoice/{{ $invoice_id }}/invoice_detail" class="btn btn-warning pull-right">See detail</a>
		</div>
    </div>

    <div class="table-responsive">
      <table class="table table-hover text-center">
        <thead>
          <tr>
            <th class="text-center">รหัสสินค้า</th>
            <th class="text-center">ชื่อสินค้า</th>
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
          @foreach($table_invoice_detail as $row_invoice_detail)
          <tr>
            <td>
              <a href="{{ url('/') }}/sales/invoice/{{ $invoice_id }}/invoice_detail/{{ $row_invoice_detail->invoice_detail_id }}/edit">
                {{ $row_invoice_detail->product_code }}
              </a>
            </td>
            <td>{{ $row_invoice_detail->product_name }}</td>
            <td>{{ $row_invoice_detail->amount }}</td>
            <td>{{ $row_invoice_detail->product_unit }}</td>
            <td>{{ $row_invoice_detail->normal_price }}</td>
            <td>{{ 100 - $row_invoice_detail->discount_price / $row_invoice_detail->normal_price * 100 }}</td>
            <td>{{ $row_invoice_detail->discount_price }}</td>
            <td>{{ $row_invoice_detail->discount_price *  $row_invoice_detail->amount }}</td>
            <td>
  				<a href="javascript:void(0)" onclick="onDelete( {{ $row_invoice_detail->invoice_detail_id }} )" class="text-danger">
					<span class="fa fa-trash"></span>
				</a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
