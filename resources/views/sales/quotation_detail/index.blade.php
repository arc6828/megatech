<div class="card" id="table">
	<div class="card-block">
		<style>
		.input{
			max-width: 50px;
			width: 100%;
		}
		</style>

		<div class="table-responsive">
			<table class="table table-hover text-center table-bordered" id="table">
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
					@foreach($table_quotation_detail as $row_quotation_detail)
					<tr>
						<td>
							<button class="btn btn-link" json='@json($row_quotation_detail)' data-toggle="modal" data-target="#myModal">
								{{ $row_quotation_detail->product_code }}
							</button>
						</td>
						<td>{{ $row_quotation_detail->product_name }}</td>
						<td><input class="input" name="amount_edit" id="new_amount_edit{{ $row_quotation_detail->quotation_detail_id }}" value="{{ $row_quotation_detail->amount }}" onkeyup="onChange3(this,{{ $row_quotation_detail->quotation_detail_id }})" onChange="onChange3(this,{{ $row_quotation_detail->quotation_detail_id }})"></td>
						<td>{{ $row_quotation_detail->product_unit }}</td>
						<td>{{ $row_quotation_detail->normal_price }}<input type="hidden" name="normal_price_edit" id="new_normal_price_edit{{ $row_quotation_detail->quotation_detail_id }}" value="{{ $row_quotation_detail->normal_price }}" ></td>
						<td><input class="input" name="discount_percent_edit" id="new_discount_percent_edit{{ $row_quotation_detail->quotation_detail_id }}" value="{{ 100 - $row_quotation_detail->discount_price / $row_quotation_detail->normal_price * 100 }}" onkeyup="onChange3(this,{{ $row_quotation_detail->quotation_detail_id }})" onChange="onChange3(this,{{ $row_quotation_detail->quotation_detail_id }})"></td>
						<td><input class="input" name="discount_price_edit" id="new_discount_price_edit{{ $row_quotation_detail->quotation_detail_id }}" value="{{ $row_quotation_detail->discount_price }}" onkeyup="onChange3(this,{{ $row_quotation_detail->quotation_detail_id }})" onChange="onChange3(this,{{ $row_quotation_detail->quotation_detail_id }})"></td>
						<td><input class="input" name="total_edit" id="new_total_edit{{ $row_quotation_detail->quotation_detail_id }}" value="{{ $row_quotation_detail->discount_price *  $row_quotation_detail->amount }}" readonly disabled></td>
						<td>
							<a href="javascript:void(0)" onclick="onDelete( {{ $row_quotation_detail->quotation_detail_id }} )" class="text-danger">
								<span class="fa fa-trash"></span>
							</a>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
		<div class="text-center">

			@include('sales/quotation_detail/create')

		</div>
	</div>
</div>

@include('sales/quotation_detail/edit')


<div id="outer-form-container" style="display:none;">
	<form action="#" method="POST" id="form_delete" >
		{{ csrf_field() }}
		{{ method_field('DELETE') }}
		<button type="submit">Delete</button>
	</form>
	<script>
		document.addEventListener("DOMContentLoaded", function(event) {
			$('#myModal').on('shown.bs.modal', function (e) {
				var row = JSON.parse(e.relatedTarget.getAttribute("json"));

				console.log(row);
				document.getElementById("form_edit").action = "{{ url('/') }}/sales/quotation/{{ $row->quotation_id }}/quotation_detail/"+row.quotation_detail_id;

				document.getElementById("quotation_detail_id").innerHTML = row.quotation_detail_id;
				document.getElementById("product_code").innerHTML = row.product_code;
				document.getElementById("product_name").innerHTML = row.product_name;
				console.log(row.amount*1,document.getElementById("amount"));
				document.getElementById("amount_edit").value = row.amount;
				document.getElementById("discount_percent_edit").value = (100 - row.discount_price / row.normal_price * 100) ;
				document.getElementById("normal_price_edit").value = row.normal_price;
				document.getElementById("discount_price_edit").value = row.discount_price;
				document.getElementById("total_edit").value = row.discount_price *  row.amount;
			});

		});
		function onEdit(){
			console.log("edit",$('#myModal'));
			$('#myModal').on('show');
		}

		function onDelete(id){
			//--THIS FUNCTION IS USED FOR SUBMIT FORM BY script--//

			//GET FORM BY ID
			var form = document.getElementById("form_delete");
			//CHANGE ACTION TO SPECIFY ID
			form.action = "{{ url('/') }}/sales/quotation/{{ $quotation_id }}/quotation_detail/"+id;
			//SUBMIT
			var want_to_delete = confirm('Are you sure to delete this quotation detail?');
			if(want_to_delete){
				form.submit();
			}
		}
	</script>
	<script>
	function onChange3(obj,id){
		var discount_price_edit = document.getElementById("new_discount_price_edit"+id);
		var discount_percent_edit = document.getElementById("new_discount_percent_edit"+id);
		var normal_price_edit = document.getElementById("new_normal_price_edit"+id);
		var total_edit = document.getElementById("new_total_edit"+id);
		var amount_edit = document.getElementById("new_amount_edit"+id);
		//console.log("print",event,discount_price_edit,discount_percent_edit,normal_price_edit,total_edit,amount_edit);
		switch (obj.id) {
			case "new_discount_percent_edit"+id:
				//EFFECT TO #discount_price_edit
				console.log("EFFECT TO #discount_price_edit");
				discount_price_edit.value = normal_price_edit.value - normal_price_edit.value * (discount_percent_edit.value) / 100;

				break;
			case "new_discount_price_edit"+id:
				//EFFECT TO #discount_percent_edit
				discount_percent_edit.value = 100.0 - discount_price_edit.value / normal_price_edit.value * 100;
				break;
		}
		//EFFECT TO #total_edit
		total_edit.value = amount_edit.value * discount_price_edit.value;
		//console.log(obj.value, obj.id);

		if(event.type === "change"){
			console.log("Change");
			//ajax to server update + or click submit
		}
	}
	</script>
</div>
