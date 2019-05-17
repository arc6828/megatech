@extends('layouts/argon-dashboard/theme')

@section('title','กำหนดเจ้าหนี้ใบเสนอซื้อ')

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
	<div class="card-block">
    <form method="get" action="">
  		<div class="form-group form-inline">
  			<label class="col-lg-2 offset-lg-1">สถานะ</label>
  			<div class="col-lg-3">{{ $filter->purchase_requisition_detail_status_id}}
  					<select name="purchase_requisition_detail_status_id" id="purchase_requisition_detail_status_id" class="form-control form-control-sm"
              onchange="onSubmit(this);" required>
  							<option value="" >None</option>
  							@foreach($table_purchase_requisition_detail_status as $row_purchase_requisition_detail_status)
  							<option
                  value="{{ $row_purchase_requisition_detail_status->purchase_requisition_detail_status_id }}"
                  {{ $row_purchase_requisition_detail_status->purchase_requisition_detail_status_id == $filter->purchase_requisition_detail_status_id ? "selected" : "" }} >
  									{{  $row_purchase_requisition_detail_status->purchase_requisition_detail_status_name }}
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
<div class="card">
	<div class="card-block">
    <form action="{{ url('/') }}/purchase/purchase_requisition_detail/update_supplier" method="post" id="form_table" onsubmit="return validateCheckbox();" >
      {{ csrf_field() }}
    	{{ method_field('PUT') }}

  		<div class="table-responsive">
  			<table class="table table-hover text-center" id="table-purchase_requisition-detail" style="width:100%">

  			</table>
  		</div>
      <div class="form-group form-inline text-center">
        <div class="col-lg-4 offset-lg-4">
          <select name="action" id="action" class="form-control form-control-sm" required>
              @foreach($table_supplier as $row_supplier)
              <option
                value="{{ $row_supplier->supplier_id }}" >
                  {{  $row_supplier->company_name }}
              </option>
              @endforeach
          </select>
          <select name="action2" id="action2" class="form-control form-control-sm d-none" >
              @foreach($table_purchase_requisition_detail_status as $row_purchase_requisition_detail_status)
              <option
                value="{{ $row_purchase_requisition_detail_status->purchase_requisition_detail_status_id }}" >
                  {{  $row_purchase_requisition_detail_status->purchase_requisition_detail_status_name }}
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
      var url = "{{ url('/') }}/api/purchase_requisition_detail?"+filter_param;
  		console.log("555",filter,filter_param,url);

			//AJAX
      $.ajax({
          url: url,
          type: "GET",
          dataType : "json",
      }).done(function(result){
					console.log(result);
					var dataSet = [];
					result.forEach(function(element,index) {
						console.log(element,index);
            var id = element.purchase_requisition_detail_id;
						var row = [
							"<input type='checkbox' name='selected_purchase_requisition_detail_ids[]' class='form-control form-control-sm' value='"+id+"' >"+
              "<input type='hidden' name='purchase_requisition_detail_ids[]' value='"+id+"' >"+
              "<input type='hidden' name='amounts[]' value='"+element.amount+"'  >",
							element.date,
							element.purchase_requisition_code,
							element.delivery_time,
							element.purchase_requisition_detail_status_name,
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

					$('#table-purchase_requisition-detail').DataTable({
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
					}); //END DATATABLE
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
