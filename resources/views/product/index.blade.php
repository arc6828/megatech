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


		<div class="table-responsive">
			<table class="table table-hover text-center" id="table-product">

			</table>
			<form action="#" method="POST" id="form_delete" class="d-none">
				{{ csrf_field() }}
				{{ method_field('DELETE') }}

				<button type="submit"></button>
			</form>

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

		function onDelete(id){
			//--THIS FUNCTION IS USED FOR SUBMIT FORM BY script--//
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

			$.ajax({
					url: "{{ url('/') }}/api/product",
					type: "GET",
					dataType : "json",
			}).done(function(result){
					//console.log(result);

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
							"<a href='javascript:void(0)' onclick='onDelete("+id+")' class='text-danger'><span class='fa fa-trash'></span></a>",
						];
						dataSet.push(row);


					}); //END FOREACH
					//console.log(dataSet);
					var table = $('#table-product').DataTable({
						"data": dataSet,
						"deferRender" : true,
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


		}
		</script>

@endsection
