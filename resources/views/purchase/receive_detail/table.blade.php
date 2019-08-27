
<div class="card" id="table">
  <div class="card-block">

    <div class="row">
        <div class="col-lg-9 align-self-center">
            <h4 class="card-title">Purchase Receive Detail</h4>
            <h6 class="card-subtitle">Display infomation in the table</h6>
        </div>
        <div class="col-lg-3 align-self-center hide">
			<a href="{{ url('/') }}/purchase/purchase_receive/{{ $purchase_receive_id }}/purchase_receive_detail" class="btn btn-warning pull-right">See detail</a>
		</div>
    </div>

    <div class="table-responsive">
      <table class="table table-hover text-center table-bordered">
        <thead class="thead-light">
          <tr>
            <td>รหัสสินค้า</td>
            <td>ชื่อสินค้า</td>
            <td>จำนวน</td>
            <td>หน่วย</td>
            <td>ราคาตั้ง</td>
            <td>ส่วนลด %</td>
            <td>ราคาขาย</td>
            <td>ราคาขายรวม</td>
            <td>action</td>
          </tr>
        </thead>
        <tbody>
          @foreach($table_purchase_receive_detail as $row_purchase_receive_detail)
          <tr>
            <td>
              <a href="{{ url('/') }}/purchase/purchase_receive/{{ $purchase_receive_id }}/purchase_receive_detail/{{ $row_purchase_receive_detail->purchase_receive_detail_id }}/edit">
                {{ $row_purchase_receive_detail->product_code }}
              </a>
            </td>
            <td>{{ $row_purchase_receive_detail->product_name }}</td>
            <td>{{ $row_purchase_receive_detail->amount }}</td>
            <td>{{ $row_purchase_receive_detail->product_unit }}</td>
            <td>{{ $row_purchase_receive_detail->normal_price }}</td>
            <td>{{ 100 - $row_purchase_receive_detail->discount_price / $row_purchase_receive_detail->normal_price * 100 }}</td>
            <td>{{ $row_purchase_receive_detail->discount_price }}</td>
            <td>{{ $row_purchase_receive_detail->discount_price *  $row_purchase_receive_detail->amount }}</td>
            <td>
  				<a href="javascript:void(0)" onclick="onDelete( {{ $row_purchase_receive_detail->purchase_receive_detail_id }} )" class="text-danger">
					<span class="fa fa-trash"></span>
				</a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
	<div class="text-center">
		<a href="{{ url('/') }}/purchase/purchase_receive/{{ $purchase_receive_id }}/purchase_receive_detail/create" class="btn btn-success">
			<i class="fa fa-plus"></i> เพิ่มรายการสินค้า
		</a>
	</div>
  </div>
</div>
