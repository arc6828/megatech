<div class="card mt-4">
  <div class="card-body">
    <div class="row">
      <div class="col-lg-12">
          <input class="form-control" id="isbn" placeholder="Enter Barcode ..." onkeypress="onKeyPressEnterBarcode(event);">
          <button class="d-none" id="btn-isbn"></button>
      </div>
    </div>
  </div>
</div>

<div class="card mt-4" id="table">
	<div class="card-body">
		<style>
		.input{
			max-width: 50px;
			width: 100%;
		}
		</style>

		<div class="table-responsive">
			<table class="table table-hover text-center table-sm" id="table-purchase_receive-detail" style="width:100%"></table>
		</div>
		<script>
			document.addEventListener("DOMContentLoaded", function(event) {
			 	var detail = JSON.parse('@json($table_purchase_receive_detail)');
				//console.log("DETAIL : ",detail);
				var dataSet = [];
				detail.forEach(function(element,index) {
					//console.log(element,index);
					var id = element.purchase_receive_detail_id;
					var row = createRow(id, element);
					dataSet.push(row);
				});
				//console.log(dataSet);

				$('#table-purchase_receive-detail').DataTable({
					"pageLength": 50,
					"data": dataSet,
					"columns": [
							{ title: "#" },
							{ title: "รหัสสินค้า" },
							{ title: "ชื่อสินค้า" },
							{ title: "จำนวน" },
              @if($mode == "create")
							{ title: "จำนวนที่ค้างรับ" },
							{ title: "จำนวนที่รับ" },
              @endif
							//{ title: "หน่วย" },
							{ title: "ราคาตั้ง" },
							//{ title: "ส่วนลด %" },
							{ title: "ราคาซื้อ" },
							{ title: "ราคาซื้อรวม" },
							//{ title: "action" },
					],
					"fnCreatedRow" : function( nRow, aData, iDataIndex ) {
						//console.log("aData : ", aData, iDataIndex);
			      $(nRow).attr('id', "row-"+aData[0]);
			    },
				}); //END DataTable

				//ALL ABOUT EVENT
				refreshDetailTableEvent();

				//Load Product
				showProduct();


				//AVOID TO EDIT
				//$('#table-purchase_receive-detail input').prop('readonly', true);

			});//END DOMContentLoaded

      //EVENT HANDLER
      function createRow(id,element){
        var order_id = "{{ request('purchase_order_code') }}";
        var amount_class = order_id + "-" + element.BARCODE;

        return [
          id +
          "<input type='hidden' class='id_edit' name='id_edit[]'  value='"+id+"' >" +
          "<input type='hidden' class='purchase_order_detail_id_edit' name='purchase_order_detail_id_edit[]'  value='"+element.purchase_order_detail_id+"' >",
          element.product_code+"<input type='hidden' class='product_id_edit' name='product_id_edit[]'  value='"+element.product_id+"' >",
          element.product_name,
          "<input class='input amount_edit' name='amount_edit[]'  value='"+element.amount+"' readonly>",
          @if($mode == "create")
          "<input class='input amount_pending_edit' name='amount_pending_edit[]'  value='"+element.amount_pending_in+"' readonly>",
          "<input class='input amount_receive_edit "+amount_class+"' name='amount_receive_edit[]'  value='0' type='number' data-limit='"+element.amount_pending_in+"' data-quantity='"+element.quantity+"'>",
          @endif
          //element.product_unit,
          "<input class='input normal_price_edit' name='normal_price_edit[]'  value='"+element.normal_price+"' disabled>",
					//"<input type='number' step='any' class='input discount_percent_edit' name='discount_percent_edit[]' max="+element.max_discount_percent+"  value='"+(100 - element.discount_price / element.normal_price * 100)+"' readonly>",
          "<input class='input discount_price_edit' name='discount_price_edit[]'  value='"+element.discount_price+"' readonly>",
          "<input class='input total_edit' name='total_edit[]'  value='"+(element.discount_price *  element.amount)+"' disabled>",
          /*"<a href='javascript:void(0)' class='text-danger btn-delete-detail' style='padding-right:10px;' title='delete' >" +
            "<span class='fa fa-trash'></span>" +
          "</a>",*/
        ];
      }

      //ON CHANGE + ON KEYUP
      function calculateNumber(){
        document.querySelectorAll(".input").forEach(function(element,index){
          element.removeEventListener("change", onChange3,true);
          element.removeEventListener("keyup", onChange3,true);
          element.addEventListener("change", onChange3,true);
          element.addEventListener("keyup", onChange3,true);
        }); //END foreach
      }

      function onChange3(){
        //var row = document.querySelector("#row-"+id);
        var obj = event.target;
        var row = $(obj).parents('tr')[0];
        var discount_price_edit = row.querySelector(".discount_price_edit");
        var discount_percent_edit = row.querySelector(".discount_percent_edit");
        var normal_price_edit = row.querySelector(".normal_price_edit");
        var total_edit = row.querySelector(".total_edit");
        var amount_edit = row.querySelector(".amount_edit");
        //console.log("DOM : ",discount_percent_edit);
        //var btn_submit = row.querySelector("input[name='new_btn_submit']");
        //console.log("print",event,discount_price_edit,discount_percent_edit,normal_price_edit,total_edit,amount_edit);
        switch (obj.name) {
          case "discount_percent_edit[]":
            //EFFECT TO #discount_price_edit
            //console.log("EFFECT TO #discount_price_edit");
            discount_price_edit.value = normal_price_edit.value - normal_price_edit.value * (discount_percent_edit.value) / 100;

            break;
          case "discount_price_edit[]":
            //EFFECT TO #discount_percent_edit
            //console.log("EFFECT TO #discount_percent_edit");
            discount_percent_edit.value = 100.0 - discount_price_edit.value / normal_price_edit.value * 100;
            break;
        }
        //EFFECT TO #total_edit
        total_edit.value = amount_edit.value * discount_price_edit.value;
        //console.log(obj.value, obj.id);


        onChange(document.getElementById("vat_percent"));
      }

			function toDelete(){
				document.querySelectorAll(".btn-delete-detail").forEach(function(element,index){
					element.removeEventListener("click", myFunction,true);
					element.addEventListener("click", myFunction,true);
				}); //END foreach
			}
			function myFunction(event){
				//console.log("CHANGE : ", this,this.getAttribute("data_id"));
				//onChange3(this,this.getAttribute("data_id"));
				var want_to_delete = confirm('Are you sure to delete this purchase_receive detail?');
				if(want_to_delete){
					var table = $('#table-purchase_receive-detail').DataTable();
					table
						.row( $(this).parents('tr') )
						.remove()
						.draw();
					onChange(document.getElementById("vat_percent"));
				}
			}

      function refreshDetailTableEvent(){
				toDelete();
        calculateNumber();
        onChange(document.getElementById("vat_percent"));
      }


      //onKeyISBN
      function onKeyISBN(){
        var order_id = "{{ request('purchase_order_code') }}";
        var isbn = $("#isbn").val();
        var amount_class = order_id + "-" + isbn;


        //FLAG TO CHECK COMMIT
        var flag = 0;
        $("."+amount_class).each(function(){
          var num = parseInt($(this).val());
          var limit = parseInt($(this).attr('data-limit'));
          var quantity = parseInt($(this).attr('data-quantity'));
          var num = num + quantity;
          console.log("NUM" , num , limit);

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
          }else{
            flag = -1;
          }
        });
        //IF NO ITEM IN LIST
        if(flag == 0){
          alert("No item in list");
        }else if(flag < 0){
          alert("Number of item is less than the package!!!");
        }

        //var table_detail = $('#table-order-detail').DataTable();
        //var data = table_detail.search(key).data();
        //console.log("DATA : " , $("."+amount_class));

        //PLUS AMOUNT
      }
      function onKeyPressEnterBarcode(e){
        var code = (e.keyCode ? e.keyCode : e.which);
        if(code == 13) { //Enter keycode
          event.preventDefault();
          //alert('enter press isbn');
          onKeyISBN();
        }
      }



		</script>


	</div>
</div>
