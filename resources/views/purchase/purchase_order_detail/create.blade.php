@extends('monster-lite/layouts/theme')

@section('title','เพิ่มรายการในใบเสนอราคา')

@section('breadcrumb-menu')

@endsection

@section('content')

<div class="card">
	<div class="card-block">
		<div class="row">
			<div class="col-lg-6 align-self-center">
				<h4 class="card-title">Purchase Order code :
					@foreach($table_purchase_order as $row_purchase_order)
					{{ $row_purchase_order->purchase_order_code }}
					@endforeach
				</h4>
				<h6 class="card-subtitle">Fill infomation in the form</h6>
			</div>
			<div class="col-lg-6 align-self-center">
				<form class="" action="{{ url('/') }}/purchase/purchase_order/{{ $purchase_order_id }}/purchase_order_detail/create" method="GET">
					<div class="form-group form-inline pull-right">
						<input class="form-control mb-2 mr-2" type="text" name="q" placeholder="type your keyword..." value="{{ $q }}" >
						<button class="btn btn-primary mb-2 mr-2" type="submit" >ค้นหา</button>
					</div>
				</form>
			</div>
		</div>

		<div>
			<div class="table-responsive">
				<table class="table table-hover text-center">
					<thead>
						<tr>
							<td class="text-center">รหัสสินค้า</td>
							<td class="text-center">ชื่อสินค้า</td>
							<td class="text-center">จำนวนในคลัง</td>
							<td class="text-center">ราคาขาย</td>
							<td class="text-center">จำนวน</td>
							<td class="text-center">action</td>
						</tr>
					</thead>
					<tbody>
						@foreach($table_product as $row)
						<form action="{{ url('/') }}/purchase/purchase_order/{{$purchase_order_id}}/purchase_order_detail" method="POST">
						{{ csrf_field() }}
					    {{ method_field('POST') }}
						<input type="hidden" name="product_id" value="{{ $row->product_id }}" >
						<input type="hidden" name="discount_price" value="{{ $row->normal_price }}" >
						<tr>
							<td>
								<a href="{{ url('/') }}/product/{{ $row->product_id }}/edit">
									{{ $row->product_code }}
								</a>
							</td>
							<td>{{ $row->product_name }}</td>
							<td>{{ $row->amount_in_stock }}</td>
							<td>{{ $row->promotion_price? $row->promotion_price : $row->normal_price }}</td>
							<td>
								<input class="form-control" type="number" name="amount" value="1" placeholder="กรอกจำนวน">
							</td>
							<td>
								<button class="btn btn-warning" type="submit">
									<span class="fa fa-shopping-cart"></span>
								</button>
							</td>
						</tr>
						</form>
						@endforeach
					</tbody>
				</table>
			</div>





		</div>
	</div>
</div>

<div class="form-group">
	<div class="col-lg-12">
		<div class="text-center">
	  		<a class="btn btn-outline-primary" href="{{ url('/') }}/purchase/purchase_order/{{ $purchase_order_id }}/edit">back</a>
		</div>
	</div>
</div>


@endsection
