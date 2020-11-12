@extends('layouts/argon-dashboard/theme')

@section('title','อนุมัติใบเสนอซื้อ')
@section('background-tag','bg-success')

@section('navbar-menu')
<div style="margin:21px;">
  <a class="btn btn-outline-primary" href="{{ url('/') }}/purchase">back</a>
  <button class="btn btn-success d-none" type="submit" onclick="document.getElementById('form').submit();">Update</button>
</div>
@endsection

@section('breadcrumb-menu')

@endsection

@section('content')

<div class="card">
	<div class="card-body">
    <div class="mb-4">
      <a href="{{ url('/purchase') }}" title="Back" class="pb-4">
        <button class="btn btn-warning btn-sm">
          <i class="fa fa-arrow-left" aria-hidden="true"></i> Back
        </button>
      </a>
    </div>
    <form method="get" action="">
  		<div class="form-group form-inline">
  			<label class="col-lg-2 offset-lg-1">สถานะ</label>
  			<div class="col-lg-3">
  					<select name="purchase_requisition_detail_status_id" id="purchase_requisition_detail_status_id" class="form-control form-control-sm"
              onchange="onSubmit(this);" required>
			  
  							@foreach($table_purchase_requisition_detail_status as $row_purchase_requisition_detail_status)
  							<option class="{{ ( in_array($row_purchase_requisition_detail_status->purchase_requisition_detail_status_name, ['อนุมัติ','ไม่อนุมัติ','รออนุมัติ'] ) )?'' : 'd-none'}}"
               value="{{ $row_purchase_requisition_detail_status->purchase_requisition_detail_status_id }}"
                  {{ $row_purchase_requisition_detail_status->purchase_requisition_detail_status_id == $filter->purchase_requisition_detail_status_id ? "selected" : "" }} >
  									{{  $row_purchase_requisition_detail_status->purchase_requisition_detail_status_name }}
  							</option>
  							@endforeach
  					</select>
  			</div>
  			<label class="col-lg-2">วันที่อนุมัติ</label>
  			<div class="col-lg-3">
  				<input type="text" name="approve_date" class="form-control form-control-sm"	value="{{ date('d-m-Y') }}" disabled readonly>
  			</div>
  		</div>

  		<div class="form-group form-inline">
  			<label class="col-lg-2 offset-lg-1">เลือกเดือน</label>
  			<div class="col-lg-2">
  					<select name="m_date" id="m_date" class="form-control form-control-sm"
              onchange="onSubmit(this);"  style="max-width:150px;">
                <option value="">None</option>

                @for($i = 0; $i <= 12; $i++) 
                <option
                  value="{{ date("Y-m-01", strtotime( date( 'Y-m-01' )." -$i months")) }}"
                  {{ $filter->m_date ===  date("Y-m-01", strtotime( date( 'Y-m-01' )." -$i months")) ? "selected" : "" }}>
                  {{ date("Y-m", strtotime( date( 'Y-m-01' )." -$i months")) }}
                </option>
                @endfor
  					</select>
  			</div>
        <label class="col-lg-1 ">หรือ</label>
  			<div class="col-lg-2">
  				<input type="date" name="date_begin" id="date_begin" class="form-control form-control-sm"
            onchange="onSubmit(this);" value="{{ $filter->date_begin }}" style="max-width:150px;">
  			</div>
  			<label class="col-lg-1">-</label>
  			<div class="col-lg-2">
  				<input type="date" name="date_end" id="date_end" class="form-control form-control-sm"
            onchange="onSubmit(this);" value="{{ $filter->date_end }}" style="max-width:150px;" >
  			</div>
  		</div>
      <div><button type="submit" style="display:none;" id="form-submit">submit</button></div>
    </form>
    <script>
      function onSubmit(){
        var purchase_requisition_detail_status_id = document.getElementById("purchase_requisition_detail_status_id");
        var m_date = document.getElementById("m_date");
        var date_begin = document.getElementById("date_begin");
        var date_end = document.getElementById("date_end");
        console.log(event,event.target.id);
        switch (event.target.id) {
          case "purchase_requisition_detail_status_id":
            break;
          case "m_date":
            date_begin.value="";
            date_end.value="";
            break;
          case "date_begin":
            m_date.value="";
            break;
          case "date_end":
            m_date.value="";
            break;
        }

        document.getElementById("form-submit").click();
      }
    </script>
  </div>
</div>
<div class="mt-4 card">
	<div class="card-body">
    <form action="{{ url('/') }}/purchase/requisition_detail/approve" method="post" id="form_table" onsubmit="return validateCheckbox();" >
      {{ csrf_field() }}
    	{{ method_field('PUT') }}

  		<div class="table-responsive">
  			<table class="table table-hover text-center table-sm" id="table-purchase_requisition-detail" style="width:100%">

  			</table>
  		</div>
      <div class="form-group form-inline text-center">
        <div class="col-lg-4 offset-lg-4">
          <select name="action" id="action" class="form-control form-control-sm" required>
	  			@php
	  				$index = 0;
				@endphp
              	@foreach($table_purchase_requisition_detail_status->where('purchase_requisition_detail_status_id','1') as $row_purchase_requisition_detail_status)

				<option
					value="{{ $row_purchase_requisition_detail_status->purchase_requisition_detail_status_id }}" >
					{{  $row_purchase_requisition_detail_status->purchase_requisition_detail_status_name }}
				</option>
				@php
	  				if($index == 2){
						break;
					}
					$index++;
				@endphp
              @endforeach
          </select>
          <button type="summit" id="form_summit_table" class="btn btn-success btn-sm">
    				submit
    			</button>
      </div>
  		</div>
    </form>

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

      var filter = JSON.parse('@json($filter)');
      var filter_param = $.param( filter );
      var url = "{{ url('/') }}/api/purchase/requisition_detail?"+filter_param;
  		//console.log("555",filter,filter_param,url);

			//AJAX
      $.ajax({
          url: url,
          type: "GET",
          dataType : "json",
      }).done(function(result){
			console.log(result);
			var dataSet = [];
			var product_codes = [];
					result.forEach(function(element,index) {
						console.log(element,index);
			
						var id = element.purchase_requisition_detail_id;
						var willing_amount = parseInt(element.pending_out) - (parseInt(element.amount_in_stock) + parseInt(element.pending_in));
						if(willing_amount < 0){
							willing_amount = 0;
						}
						//check if not in array
						if(product_codes.indexOf(element.product_code) == -1){
							product_codes.push(element.product_code);
						}else{
							willing_amount = 0;
						}
						var row = [
							"<input type='checkbox' name='selected_purchase_requisition_detail_ids[]' value='"+id+"' >"+
              "<input type='hidden' name='purchase_requisition_detail_ids[]' value='"+id+"' >"+
              "<input type='hidden' name='amounts[]' value='"+element.amount+"'  >",
							moment(element.date).format('DD-MM-YYYY'),
							element.purchase_requisition_code,
							//element.delivery_time,
							//element.purchase_requisition_detail_status_name,
							element.product_code,
							element.product_name  ,
							element.amount,
							"<input type='number' name='approve_amounts[]' value='"+element.amount+"' class='form-control form-control-sm' style='width:100px;' required>",
							//จำนวนที่ต้องสั่ง = ค้างส่ง - (สต๊อก + ค้างรับ)
							//willing_amount,
							element.pending_in,
							element.pending_out,
							element.amount_in_stock,
						];
						dataSet.push(row);
					});
					console.log(dataSet);

					$('#table-purchase_requisition-detail').DataTable({
						data: dataSet,
						columns: [
								{ title: "#" },
								{ title: "วันที่ PR" },
								{ title: "เลขที่ PR" },
								//{ title: "วันที่ส่งของ" },
								//{ title: "สถานะการขาย" },
								{ title: "รหัสสินค้า" },
								{ title: "ชื่อสินค้า" },
								{ title: "จำนวน" },
								{ title: "ที่อนุมัติ" },
								//{ title: "ที่ต้องซื้อเพิ่ม" },
								{ title: "ค้างรับ" },
								{ title: "ค้างส่ง" },
								{ title: "คงคลัง" },
						]
					}).order( [ 2, 'desc' ] ).draw(); //END DATATABLE
				}); //END DONE AJAX
		}); //END DOMContentLoaded

    function validateCheckbox(){
      checked = $("input[type=checkbox]:checked").length;

      if(checked == 0) {
        alert("กรุณาเลือกอย่างน้อย 1 รายการ");
        return false;
      }
      //return true;
    }

	</script>
</div>



@endsection
