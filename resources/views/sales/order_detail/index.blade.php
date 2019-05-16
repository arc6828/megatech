@extends('layouts/argon-dashboard/theme')

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
	<div class="card-body">
    <form method="get" action="">
  		<div class="form-group form-inline">
  			<label class="col-lg-2 offset-lg-1">สถานะ</label>
  			<div class="col-lg-3">{{ $filter->order_detail_status_id}}
  					<select name="order_detail_status_id" id="order_detail_status_id" class="form-control form-control-sm"
              onchange="onSubmit(this);" required>
  							<option value="" >None</option>
  							@foreach($table_order_detail_status as $row_order_detail_status)
  							<option
                  value="{{ $row_order_detail_status->order_detail_status_id }}"
                  {{ $row_order_detail_status->order_detail_status_id == $filter->order_detail_status_id ? "selected" : "" }} >
  									{{  $row_order_detail_status->order_detail_status_name }}
  							</option>
  							@endforeach
  					</select>
  			</div>
  			<label class="col-lg-2">วันที่อนุมัติ</label>
  			<div class="col-lg-3">
  				<input type="date" name="approve_date" class="form-control form-control-sm"	value="{{ date('Y-m-d') }}" disabled readonly>
  			</div>
  		</div>

  		<div class="form-group form-inline">
  			<label class="col-lg-2 offset-lg-1">เลือกเดือน</label>
  			<div class="col-lg-2">
  					<select name="m_date" id="m_date" class="form-control form-control-sm"
              onchange="onSubmit(this);"  style="max-width:150px;">
                <option value="">None</option>

                @for($i = 1; $i <= 12; $i++)
                <option
                  value="{{ date("Y") }}-{{ sprintf("%02d",$i) }}-01"
                  {{ $filter->m_date ===  sprintf("%d-%02d-01",date("Y"), $i) ? "selected" : "" }}>
                  {{ date("Y") }}-{{ sprintf("%02d",$i) }}
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
        var order_detail_status_id = document.getElementById("order_detail_status_id");
        var m_date = document.getElementById("m_date");
        var date_begin = document.getElementById("date_begin");
        var date_end = document.getElementById("date_end");
        console.log(event,event.target.id);
        switch (event.target.id) {
          case "order_detail_status_id":
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
<div class="card">
	<div class="card-body">
    <form action="{{ url('/') }}/sales/order_detail/approve" method="post" id="form_table" onsubmit="return validateCheckbox();" >
      {{ csrf_field() }}
    	{{ method_field('PUT') }}

  		<div class="table-responsive">
  			<table class="table table-hover table-sm text-center  table-bordered" id="table-order-detail" style="width:100%">

  			</table>
  		</div>
      <div class="form-group form-inline text-center">
        <div class="col-lg-4 offset-lg-4">
          <select name="action" id="action" class="form-control form-control-sm" required>
              @foreach($table_order_detail_status as $row_order_detail_status)
              <option
                value="{{ $row_order_detail_status->order_detail_status_id }}" >
                  {{  $row_order_detail_status->order_detail_status_name }}
              </option>
              @endforeach
          </select>
          <button type="summit" id="form_summit_table" class="btn btn-primary">
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
  		console.log("555",filter,filter_param,url);
      var url = "{{ url('/') }}/api/order_detail?"+filter_param;

			//AJAX
      $.ajax({
          url: "{{ url('/') }}/api/order_detail?"+filter_param,
          type: "GET",
          dataType : "json",
      }).done(function(result){
					console.log(result);
					var dataSet = [];
					result.forEach(function(element,index) {
						console.log(element,index);
            var id = element.order_detail_id;
						var row = [
							"<input type='checkbox' name='selected_order_detail_ids[]' class='' value='"+id+"' >"+
              "<input type='hidden' name='order_detail_ids[]' value='"+id+"' >"+
              "<input type='hidden' name='amounts[]' value='"+element.amount+"'  >",

							element.order_code,
              element.date,
							//element.delivery_time,
							element.company_name,
							element.product_id,
							element.product_name,
							element.amount,
							"<input name='approve_amounts[]' value='"+element.amount+"' class='form-control form-control-sm' style='max-width:40px;' required>",
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
								{ title: "เลขที่ OE" },
								{ title: "วันที่ OE" },
								//{ title: "วันที่ส่งของ" },
								{ title: "ลูกค้า" },
								{ title: "รหัสสินค้า" },
								{ title: "ชื่อสินค้า" },
								{ title: "จำนวน" },
								{ title: "จำนวนที่อนุมัติ" },
								{ title: "ค้างรับ" },
								{ title: "ค้างส่ง" },
								{ title: "จำนวนคงคลัง" },
						]
					}).order( [ 2, 'desc' ] ).draw(); //END DATATABLE
				});//END DONE AJAX
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
