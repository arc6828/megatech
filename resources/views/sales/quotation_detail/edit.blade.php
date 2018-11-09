<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">แก้ไข Quotation detail id : <span id="quotation_detail_id"></span> </h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="{{ url('/') }}/sales/quotation/{{ $row->quotation_id }}/quotation_detail/row->quotation_detail_id" method="POST" id="form_edit">
					{{ csrf_field() }}
					{{ method_field('PUT') }}


					<div class="form-group form-inline">
						<label class="col-lg-2">รหัสสินค้า</label>
						<div class="col-lg-3">
							<span id="product_code"></span>
						</div>
						<label class="col-lg-2 offset-lg-1">ชื่อสินค้า</label>
						<div class="col-lg-3">
							<span id="product_name"></span>
						</div>
					</div>

					<div class="form-group form-inline">
						<label class="col-lg-2">จำนวน</label>
						<div class="col-lg-3">
							<input type="number" name="amount_edit" id="amount_edit"  value="0" onkeyup="onChange2(this)" onChange="onChange2(this)" 	class="form-control form-control-sm form-control-line"	 >
						</div>
						<label class="col-lg-2 offset-lg-1">ส่วนลด %</label>
						<div class="col-lg-3">
							<input type="number" name="discount_percent_edit" id="discount_percent_edit" value="0" onkeyup="onChange2(this)" onChange="onChange2(this)" class="form-control form-control-sm form-control-line" >
						</div>
					</div>

					<div class="form-group form-inline">
						<label class="col-lg-2">ราคาตั้ง</label>
						<div class="col-lg-3">
							<input type="number" name="normal_price_edit"  id="normal_price_edit" value="" readonly disabled class="form-control form-control-sm">
						</div>
						<label class="col-lg-2 offset-lg-1">ราคาขาย</label>
						<div class="col-lg-3">
							<input type="number" name="discount_price_edit"  id="discount_price_edit" value="" onkeyup="onChange2(this)" onChange="onChange2(this)" class="form-control form-control-sm form-control-line" >
						</div>
					</div>

					<div class="form-group form-inline">
						<label class="col-lg-2">ราคารวม</label>
						<div class="col-lg-3">
							<input type="number" name="total_edit"  id="total_edit" value="" readonly disabled class="form-control form-control-sm">
						</div>
					</div>


					<div class="form-group">
						<div class="col-lg-12">
							<div class="text-center">
								<a class="btn btn-outline-primary d-none" href="{{ url('/') }}/sales/quotation/{{ $quotation_id}}/quotation_detail">back</a>
								<button class="btn btn-success" type="submit" >Update</button>
							</div>
						</div>
					</div>

				</form>
				<script>
				function onChange2(obj){
					var discount_price_edit = document.getElementById("discount_price_edit");
					var discount_percent_edit = document.getElementById("discount_percent_edit");
					var normal_price_edit = document.getElementById("normal_price_edit");
					var total_edit = document.getElementById("total_edit");
					var amount_edit = document.getElementById("amount_edit");
					//console.log("print",discount_price_edit,discount_percent_edit,normal_price_edit);
					switch (obj.id) {
						case "discount_percent_edit":
							//EFFECT TO #discount_price_edit
							discount_price_edit.value = normal_price_edit.value - normal_price_edit.value * (discount_percent_edit.value) / 100;

							break;
						case "discount_price_edit":
							//EFFECT TO #discount_percent_edit
							discount_percent_edit.value = 100.0 - discount_price_edit.value / normal_price_edit.value * 100;
							break;
					}
					//EFFECT TO #total_edit
					total_edit.value = amount_edit.value * discount_price_edit.value;
					//console.log(obj.value, obj.id);
				}
				</script>

			</div>
			<div class="modal-footer d-none">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
