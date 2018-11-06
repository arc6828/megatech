<!-- Button trigger modal -->
<button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">
	<i class="fa fa-plus"></i> เพิ่มรายการสินค้า
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">เพิ่มรายการสินค้า</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="table-responsive">
					<table class="table table-hover text-center" id="table-model">
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
							<form action="{{ url('/') }}/sales/quotation/{{$quotation_id}}/quotation_detail" method="POST">
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
			<div class="modal-footer d-none">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<script>
document.addEventListener("DOMContentLoaded", function(event) {
		console.log("555");
		$('#table-model').DataTable();
});
</script>
