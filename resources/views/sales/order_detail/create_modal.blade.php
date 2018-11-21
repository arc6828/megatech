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
									<input class="form-control form-control-sm" type="number" name="amount2" id="amount2" value="1" placeholder="กรอกจำนวน">
								</td>
								<td>
									<button class="btn btn-warning" onclick="onCreate({{ $row->product_id }},{{ $row->normal_price }},document.getElementById('amount2').value);">
										<span class="fa fa-shopping-cart"></span>
									</button>
								</td>
							</tr>
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
<div id="outer-form-container" style="display:none;">
	<form action="{{ url('/') }}/sales/order/{{ $order_id }}/order_detail" method="POST" id="form_create" >
		{{ csrf_field() }}
		{{ method_field('POST') }}

		<input type="hidden" name="product_id" id="product_id" value="{{ $row->product_id }}" >
		<input type="hidden" name="discount_price" id="discount_price" value="{{ $row->normal_price }}" >
		<input type="hidden" name="amount" id="amount" value="1" >
		<button type="submit">Create</button>
	</form>
	<script>
		function onCreate(product_id, normal_price, amount){
			//GET FORM BY ID
			var form =
			document.getElementById("product_id").value = product_id;
			document.getElementById("discount_price").value = normal_price;
			document.getElementById("amount").value = amount;
			document.getElementById("form_create").submit();
		}
	</script>
	<script>
		document.addEventListener("DOMContentLoaded", function(event) {
			console.log("555");
			$('#table-model').DataTable();
		});
	</script>
</div>
