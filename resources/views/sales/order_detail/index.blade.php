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
  			<label class="col-lg-2 ">สถานะ</label>
  			<div class="col-lg-2">
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
  			<div class="col-lg-2">
  				<input type="date" name="approve_date" class="form-control form-control-sm"	value="{{ date('Y-m-d') }}" disabled readonly>
  			</div>
  		</div>

  		<div class="form-group form-inline">
  			<label class="col-lg-2 ">เลือกเดือน</label>
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
                <option value="all" {{ $filter->m_date ===  "all" ? "selected" : "" }}>
                  ทั้งหมด
                </option>
  					</select>
  			</div>
        <label class="col-lg-2 ">หรือ</label>
  			<div class="col-lg-2">
  				<input type="date" name="date_begin" id="date_begin" class="form-control form-control-sm"
            onchange="onSubmit(this);" value="{{ $filter->date_begin }}" style="max-width:150px;">
  			</div>
  			<label class="col-lg-2">-</label>
  			<div class="col-lg-2">
  				<input type="date" name="date_end" id="date_end" class="form-control form-control-sm"
            onchange="onSubmit(this);" value="{{ $filter->date_end }}" style="max-width:150px;" >
  			</div>
  		</div>
      <div class="form-group form-inline">
        <label class=" col-lg-2  text-center">รหัสใบจอง</label>
  			<div class="col-lg-2">
  				<input name="order_id" id="order_id" class="form-control form-control-sm" onchange="onSubmit(this);" value="{{ $filter->order_id }}">
  			</div>
        <label class=" col-lg-2  text-center">ลูกค้า</label>
  			<div class="col-lg-2">
  				<input name="company_name" id="company_name" class="form-control form-control-sm"  readonly>
  			</div>
        <label class="col-lg-2  text-center">หมายเหตุ</label>
  			<div class="col-lg-2">
  				<input name="remark" id="remark" class="form-control form-control-sm" value="{{ $filter->remark }}">
  			</div>
      </div>
      <div class="d-none"><button type="submit" style="display:none;" id="form-submit">submit</button></div>
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
<div class="card mt-4">
	<div class="card-body">
    <div class="row mb-4">
      <div class="col-lg-12">
          <input class="form-control" id="isbn" placeholder="barcode ..." onkeypress="onKeyPressEnter(event);">
          <button class="d-none" id="btn-isbn"></button>

      </div>
    </div>
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
    //onKeyISBN
    function onKeyISBN(){
      //TICK ITEM which in visible datatable
      console.log("HELLO");
      var order_id = "{{ $filter->order_id }}";
      var isbn = $("#isbn").val();
      var amount_class = order_id + "-" + isbn;


      //FLAG TO CHECK COMMIT
      var flag = 0;
      $("."+amount_class).each(function(){
        var num = parseInt($(this).val());
        var limit = parseInt($(this).attr('data-limit'));
        var quantity = parseInt($(this).attr('data-quantity'));
        var num = num + quantity;
        //COMMIT
        if(num <= limit){
          //SET NEW NUMBER
          $(this).val(num);
          flag = 1;
          console.log("World");
          //CLEAR ISBN
          $("#isbn").val("");
          //SET CHECKBOX
          $(this).closest("tr").find("input[type=checkbox]").prop('checked', true);
          console.log();
          return false;
        }
      });
      //IF NO ITEM IN LIST
      if(flag == 0){
        alert("No item in list");
      }

      //var table_detail = $('#table-order-detail').DataTable();
      //var data = table_detail.search(key).data();
      console.log("DATA : " , $("."+amount_class));

      //PLUS AMOUNT
    }
    function onKeyPressEnter(e){
      var code = (e.keyCode ? e.keyCode : e.which);
      if(code == 13) { //Enter keycode
        //alert('enter press');
        onKeyISBN();
      }
    }
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
						console.log(element,index,element.picking_code);
            var id = element.order_detail_id;
            var order_id = $("#order_id").val();
            var company_name = element.company_name;
            if(order_id === element.order_code){
              $("#company_name").val(company_name);
            }
            var amount_class = order_id+"-"+element.BARCODE;
						var row = [
							"<input type='checkbox' name='selected_order_detail_ids[]' class='' value='"+id+"' >"+
              "<input type='hidden' name='order_detail_ids[]' value='"+id+"' >"+
              "<input type='hidden' name='amounts[]' value='"+element.amount+"'  >",

							element.order_code,
              element.date,
							//element.delivery_time,
							//element.company_name,
							element.BARCODE,
							element.product_name,
							element.amount,
							"<input name='approve_amounts[]' value='0' class='approve_amount form-control form-control-sm "+amount_class+"' data-limit='"+element.amount+"' data-quantity='"+element.quantity+"' style='max-width:40px;'  required>",
							0,
							0,
							0,
							element.picking_code,
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
								//{ title: "ลูกค้า" },
								{ title: "รหัสสินค้า" },
								{ title: "ชื่อสินค้า" },
								{ title: "จำนวนที่จอง" },
								{ title: "จำนวนที่อนุมัติ" },
								{ title: "ค้างรับ" },
								{ title: "ค้างส่ง" },
								{ title: "จำนวนคงคลัง" },
								{ title: "Picking" },
						]
					}).order( [ 1, 'desc' ] ).draw(); //END DATATABLE
          var key = "{{ $filter->order_id }}";
          var table_detail = $('#table-order-detail').DataTable();
          table_detail.search(key).draw();
          $("#table-order-detail input[type=search]").prop('readonly', true)
				});//END DONE AJAX

        //ONFOCUS
        if( $('#order_id').val() === "" ){
          //FOCUS ON OE
          $('#order_id').focus();
        }else{
          //FOCUS ON ISBN
          $('#isbn').focus();
        }
		}); //END DOMContentLoaded

    function validateCheckbox(){
      checked = $("input[type=checkbox]:checked").length;
      var clean = true;

      if(checked == 0) {
        alert("กรุณาเลือกอย่างน้อย 1 รายการ");
        clean = false;
      }


      var tr = $("input[type=checkbox]:checked").closest("tr");
      tr.each(function (index){
        var amount = $(this).find(".approve_amount").val();
        if(amount === "0"){
          alert("กรุณาใส่จำนวน > 0");
          clean = false;
          //exit from loop
          return false;
        }
      });
      //return true;

      return clean;
    }

	</script>
</div>



@endsection
