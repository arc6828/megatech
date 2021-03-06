@extends('layouts/argon-dashboard/theme')

@section('level-0-url', url('inventory'))
@section('level-0','คงคลัง')

@section('title','แฟ้มสินค้า')



@section('content')
<div class="card">
	<div class="card-body">


    <input hidden id="search_key" value="">
		<div class="table-responsive">
			<table class="table table-hover text-center table-sm" id="table-product" width="100%">

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
        	<a href="{{ url('/') }}/product/create" class="btn  btn-primary">
        		<i class="fa fa-plus"></i> เพิ่มสินค้า
        	</a>
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

				var dataSet = prepareDataSet(result);
				//console.log(dataSet);
				var table = $('#table-product').DataTable({
					"data": dataSet,
					"deferRender" : true,
					//"pageLength": 10,
					"columns": [
						//{ title: "ลำดับ" },
						{ title: "รหัสสินค้า" },
						//{ title: "barcode" },
						{ title: "ชื่อสินค้า" },
						{ title: "ราคาขาย" },
						{ title: "#ในคลัง" },
						{ title: "#ค้างส่ง" },
						{ title: "#ค้างรับ" },
						//{ title: "action" },
					],
					// "scrollY": "250px",
					// "scrollCollapse": true,
					"paging":         false,
					"order": [[ 4, "desc" ]]
				}); // END DATATABLE
				//DATA TABLE SCROLL
				var tableCont = document.querySelector('#table-product');
				tableCont.style.cssText  = "margin-top : -1px !important; width:100%;";
				tableCont.parentNode.style.overflow = 'auto';
				tableCont.parentNode.style.maxHeight = '400px';
				tableCont.parentNode.addEventListener('scroll',function (e){
					var scrollTop = this.scrollTop;
					this.querySelector('thead').style.transform = 'translateY(' + scrollTop + 'px) '+'translateZ(' + 100 + 'px)';
					this.querySelector('thead').style.background = "white";
					this.querySelector('thead').style.zIndex = "3000";
					this.querySelector('thead').style.marginBottom = "100px";
					console.log(scrollTop);
				})
				//END DATA TABLE SCROLL

          table.on( 'search.dt', function () {
            var search_key = table.search();
            if(search_key != $('#search_key').val() ){
				console.log("Hello",table.search() );
				$.ajax({
					url: "{{ url('/') }}/api/product?q="+search_key ,
					type: "GET",
					dataType : "json",
				}).done(function(result1, textStatus, request){

					//console.log(request.getAllResponseHeaders());
					//console.log(new Date(request.getResponseHeader('date')),request.getResponseHeader('date') );
					$('#search_key').val(search_key);
					var new_data = prepareDataSet(result1);
					table.clear();
					table.rows.add(new_data); // Add new data
					table.columns.adjust().draw(); // Redraw the DataTable
              	});
            }
          } ); //END SEARCH
				}); //END AJAX
		}
    function prepareDataSet(result){
      var dataSet = [];
      result.forEach(function(element,index) {
        //console.log(element,index);
        var id = element.product_id;
        var price = element.promotion_price? element.promotion_price : element.normal_price;
		var extension = "<span class='text-danger'>"+(element.stock?"("+element.stock+")":"")+"</span>";
        var row = [
			//element.product_id,
          "<a href='{{ url("/") }}/product/"+element.product_id+"'>"+ element.product_code+"</a>",
          //element.BARCODE,
          element.product_name, //+" / "+element.grade + " " +extension,
          number_format(price,2),
          element.amount_in_stock,
          element.pending_out,
          element.pending_in,
          //"<a href='javascript:void(0)' onclick='onDelete("+id+")' class='text-danger'><span class='fa fa-trash'></span></a>",
        ];
        dataSet.push(row);
      }); //END FOREACH
      console.log(dataSet);
      return dataSet;
    }
		</script>

@endsection
