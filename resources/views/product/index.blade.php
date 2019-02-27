@extends('monster-lite/layouts/theme')

@section('title','แฟ้มสินค้า')

@section('navbar-menu')
<div style="margin:21px;">
	<a href="{{ url('/') }}/product/create" class="btn pull-right hidden-sm-down btn-success btn-sm">
		<i class="fa fa-plus"></i> เพิ่มสินค้า
	</a>
<div>
@endsection

@section('breadcrumb-menu')

@endsection

@section('content')
<div class="card">
	<div class="card-block">
		<div class="row">
			<div class="col-lg-6 align-self-center">
				<h4 class="card-title">แฟ้มสินค้า</h4>
				<h6 class="card-subtitle">Display infomation in the table</h6>
			</div>
			<div class="col-lg-6 align-self-center">
				<form class="" action="{{ url('/') }}/product" method="GET">
					<div class="form-group form-inline pull-right">
						<input class="form-control mb-2 mr-2" type="text" name="q" placeholder="type your keyword..." value="{{ $q }}" >
						<button class="btn btn-primary mb-2 mr-2" type="submit" >ค้นหา</button>
					</div>
				</form>
			</div>
		</div>

		<div class="table-responsive">
			<table class="table table-hover text-center" id="table-product">

			</table>
			<action class="d-none">
				<a href="javascript:void(0)" onclick="onDelete( row->product_id , 'x' )" class="text-danger"><span class="fa fa-trash"></span></a>
				<div class="d-none">
						<form action="#" method="POST" id="form_delete">
							{{ csrf_field() }}
							{{ method_field('DELETE') }}

							<button type="submit"></button>
						</form>
				</div>
			</action>
		</div>
	</div>
</div>

<div class="form-group">
	<div class="col-lg-12">
		<div class="text-center">
	  		<a class="btn btn-outline-primary" href="{{ url('/') }}/sales">back</a>
		</div>
	</div>
</div>
@endsection


@section('script')
<script>
		$(document).ready(function(){
			showProduct();
		});
		function onDelete(id, x){
			//--THIS FUNCTION IS USED FOR SUBMIT FORM BY script--//
			console.log(x);
			//GET FORM BY ID
			var form = document.getElementById("form_delete");

			//CHANGE ACTION TO SPECIFY ID
			form.action = "{{ url('/') }}/product/"+id;

			//SUBMIT
			var want_to_delete = confirm('Are you sure to delete this product?');
			if(want_to_delete){
				form.submit();
			}
		}


		function showProduct(){
			if(  $.fn.DataTable.isDataTable('#table-product') ){
				$('#table-product').DataTable().destroy();
			}
			var table = $('#table-product').DataTable({
				"processing": true,
				"serverSide": true,
				"ajax": {
					"url" : "{{ url('/') }}/api/product",
					"data": function ( d ) {
                d.myKey = "q";
                d.custom = $('#table-product input').val();
                // etc
            },
					"dataSrc" : function(result){
						console.log(result);

						var dataSet = [];
						result.forEach(function(element,index) {
							//console.log(element,index);
							var id = element.product_id;
							var price = element.promotion_price? element.promotion_price : element.normal_price;
							var row = [
								element.product_code,
								element.product_name,
								price,
								element.amount_in_stock,
								0,
								0,
								"",
							];
							dataSet.push(row);


						}); //END FOREACH
						//console.log(dataSet);
						return dataSet;
					}
				},

				//"data": dataSet,
				"columns": [
					{ title: "รหัสสินค้า" },
					{ title: "ชื่อสินค้า" },
					{ title: "ราคาขาย" },
					{ title: "#ในคลัง" },
					{ title: "#ค้างส่ง" },
					{ title: "#ค้างรับ" },
					{ title: "action" },
				],
			}); // END DATATABLE

			/*
			$.ajax({
					url: "{{ url('/') }}/api/product",
					type: "GET",
					dataType : "json",
			}).done(function(result){
					console.log(result);

					var dataSet = [];
					result.forEach(function(element,index) {
						//console.log(element,index);
						var id = element.product_id;
						var price = element.promotion_price? element.promotion_price : element.normal_price;
						var row = [
							element.product_code,
							element.product_name,
							price,
							element.amount_in_stock,
							0,
							0,
							"",
						];
						dataSet.push(row);


					}); //END FOREACH
					//console.log(dataSet);
					var table = $('#table-product').DataTable({
						"data": dataSet,
						"columns": [
							{ title: "รหัสสินค้า" },
							{ title: "ชื่อสินค้า" },
							{ title: "ราคาขาย" },
							{ title: "#ในคลัง" },
							{ title: "#ค้างส่ง" },
							{ title: "#ค้างรับ" },
							{ title: "action" },
						],
					}); // END DATATABLE




				}); //END AJAX
				*/

		}
		</script>

@endsection
