@extends('monster-lite/layouts/theme')

@section('title','ใบเบิกของ')

@section('navbar-menu')
<div style="margin:21px;">
  <a class="btn btn-outline-primary" href="{{ url('/') }}/sales">back</a>
  <button class="btn btn-success d-none" type="submit" onclick="document.getElementById('form').submit();">Update</button>
</div>
@endsection

@section('breadcrumb-menu')

@endsection

@section('content')

<div class="card">
	<div class="card-block">
		<div class="form-group form-inline">
			<label class="col-lg-2 offset-lg-1">สถานะ</label>
			<div class="col-lg-3">
					<select name="order_detail_status_id" class="form-control form-control-sm" required>
							<option value="" >None</option>
							@foreach($table_order_detail_status as $row_order_detail_status)
							<option value="{{ $row_order_detail_status->order_detail_status_id }}" >
									{{  $row_order_detail_status->order_detail_status_name }}
							</option>
							@endforeach
					</select>
			</div>
			<label class="col-lg-2 offset-lg-1">วันที่อนุมัติ</label>
			<div class="col-lg-3">
				<input type="date" name="approve_date" class="form-control form-control-sm"	value="" >
			</div>
		</div>

		<div class="form-group form-inline">
			<label class="col-lg-1">ตั้งแต่วันที่</label>
			<div class="col-lg-2">
					<select name="order_detail_status_id" class="form-control form-control-sm" required  style="max-width:150px;">
							<option value="" >เดือนนี้</option>
							<option value="" >เดือนที่แล้ว</option>
					</select>
			</div>
			<label class="col-lg-2">วันที่อนุมัติ</label>
			<div class="col-lg-2">
				<input type="date" name="approve_date" class="form-control form-control-sm"	value="" style="max-width:150px;">
			</div>
			<label class="col-lg-2">-</label>
			<div class="col-lg-2">
				<input type="date" name="approve_date" class="form-control form-control-sm"	value="" style="max-width:150px;" >
			</div>
			<div class="col-lg-1">

			</div>
		</div>

		<div class="table-responsive">
			<table class="table table-hover text-center" id="table-order-detail" style="width:100%">

			</table>
		</div>
		<div class="text-center">
			<button class="btn btn-primary"	>
				อนุมัติ
			</button>
		</div>
	</div>
</div>

<div id="outer-form-container" style="display:none;">
	<script>
		//onClick
		function select_item(id,name) {
				console.log(id);
						$('#customer_id').val(id);
						$('#contact_name').val(name);
						$('#customerModal').modal('hide');
		}
		document.addEventListener("DOMContentLoaded", function(event) {
			console.log("555");
			//AJAX
      $.ajax({
          url: "{{ url('/') }}/api/order_detail",
          type: "GET",
          dataType : "json",
      }).done(function(result){
					console.log(result);
					var dataSet = [];
					result.forEach(function(element,index) {
						console.log(element,index);
						var row = [
							"<input type='checkbox' name='' class='form-control form-control-sm'>",
							element.date,
							element.order_code,
							element.delivery_time,
							element.order_detail_status_name,
							element.product_id,
							element.product_name,
							element.amount,
							"<input name='' class='form-control form-control-sm' value='"+element.amount+"' style='max-width:50px;'>",
							0,
							0,
							0,
						];
						dataSet.push(row);
					});
					console.log(dataSet);

					$('#table-order-detail').DataTable({
						data: dataSet,
						columns: [
								{ title: "#" },
								{ title: "วันที่ OE" },
								{ title: "เลขที่ OE" },
								{ title: "วันที่ส่งของ" },
								{ title: "สถานะการขาย" },
								{ title: "รหัสสินค้า" },
								{ title: "ชื่อสินค้า" },
								{ title: "จำนวน" },
								{ title: "จำนวนที่อนุมัติ" },
								{ title: "ค้างรับ" },
								{ title: "ค้างส่ง" },
								{ title: "จำนวนคงคลัง" },
						]
					});
				});
		});
	</script>
</div>



@endsection
