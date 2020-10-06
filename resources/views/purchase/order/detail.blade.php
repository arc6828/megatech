<div class="card mt-4" id="table">
	<div class="card-body">
		<style>
		.input{
			max-width: 50px;
			width: 100%;
		}
		</style>

		<div class="table-responsive">
			<table class="table table-hover text-center table-sm" id="table-purchase_order-detail" style="width:100%"></table>
		</div>
		<script>
			document.addEventListener("DOMContentLoaded", function(event) {
			 	var detail = JSON.parse('@json($table_purchase_order_detail)');
				//console.log("DETAIL : ",detail);
				var dataSet = [];
				detail.forEach(function(element,index) {
					//console.log(element,index);
					var id = element.purchase_order_detail_id;
					var row = createRow(id, element, element.requisition_detail_id);
					dataSet.push(row);
				});
				//console.log(dataSet);

				$('#table-purchase_order-detail').DataTable({
					"pageLength": 50,
					"data": dataSet,
					"columns": [
							//{ title: "#" },						
							{ title: "เลขที่ PR" },
							{ title: "รหัสสินค้า" },	
							{ title: "ชื่อสินค้า" },
							{ title: "วันที่ส่งของ <br>(วัน)" },
							{ title: "จำนวน" },
							//{ title: "ราคาตั้ง" },
							//{ title: "ส่วนลด %" },
							{ title: "ราคาซื้อ" },
							{ title: "ราคาซื้อรวม" },
							{ title: "action" },
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
				//$('#table-purchase_order-detail input').prop('readonly', true);

			});//END DOMContentLoaded

      //EVENT HANDLER
      function createRow(id,element, requisition_detail_id){
        var discount_percent_edit = 100 - element.discount_price / element.normal_price * 100;
        //var checked = (discount_percent_edit > element.max_discount_percent? "checked" : "")
        var checked = true;
        var discount_price = ("{{$method}}"=="edit")?element.discount_price:0;
        //discount_price = 0;

		//ELEMENT DELIVERY DURATION
        let wrap = document.createElement("div");
        let select = document.createElement("select");
        select.name="delivery_duration[]";
        select.required = "true";
        //console.log("element.delivery_duration : ", element.delivery_duration);
        wrap.append(select);
        ["โปรดระบุ","3 - 5","7 - 10","15 - 30","30 - 60"].forEach(function(item, index){
          let option = document.createElement("option");
          option.value = index==0?"":item;
          option.innerHTML = item;
          if(element.delivery_duration == item){
            
            //console.log("element.delivery_duration 2 : ", element.delivery_duration);
            option.setAttribute("selected", "true")
            console.log(option);
          }
          select.append(option);

        });
        select = wrap.innerHTML;

        //select.value = element.delivery_duration;
        console.log(select, wrap);

        //CHECK IF EDIT
        let max_amount = "";        
        //CHECK INVOICE OR NOT OVER SAME NUMBER
        @if( isset($order->purchase_order_code) )
          //EDIT MODE
          max_amount =  element.amount;          
        @endif
        let min_amount = "0";  
        @if( isset($order->purchase_order_code) )  
              
          let unchangable_items = @json($unchangable_items);
          //IF SOME ITEMS HAVE BEEN INVOICE
          min_amount = (unchangable_items[element.product_code]) ? 
              unchangable_items[element.product_code] :
              0;
        @endif

        return [
          element.purchase_requisition_code +
          "<input type='hidden' class='id_edit' name='id_edit[]'  value='"+id+"' >" +
          "<input type='hidden' class='requisition_detail_id_edit' name='requisition_detail_id_edit[]'  value='"+requisition_detail_id+"' >",
          element.product_code+"<input type='hidden' class='product_id_edit' name='product_id_edit[]'  value='"+element.product_id+"' >",
          element.product_name,		  
          ""+select,
          "<input type='number' class='input amount_edit' name='amount_edit[]'  value='"+element.amount+"' min='"+min_amount+"' max='"+max_amount+"' title='["+min_amount+","+max_amount+"]' style='min-width:60px;'>"

          +"<input class='d-none input roundnum normal_price_edit' name='normal_price_edit[]'  value='"+parseFloat(element.normal_price).toFixed(2)+"' disabled>"
          +"<input type='number' step='any' class='d-none input roundnum discount_percent_edit' name='discount_percent_edit[]' max="+(checked?parseFloat(element.max_discount_percent)+100:element.max_discount_percent)+"  value='"+(parseFloat(discount_percent_edit).toFixed(2))+"'>",
          "<input class='input roundnum discount_price_edit' name='discount_price_edit[]'  value='"+parseFloat(discount_price).toFixed(2)+"'>",
          "<input class='input  roundnum total_edit' name='total_edit[]'  value='"+(discount_price *  element.amount)+"' disabled>",
          @if( isset($order->purchase_order_code) ) 
          "",
          @else
		  "<a href='javascript:void(0)' class='text-danger btn-delete-detail' style='padding-right:10px;' title='delete' >" +
            "<span class='fa fa-trash'></span>" +
          "</a>",
		  @endif
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
				var want_to_delete = confirm('Are you sure to delete this purchase_order detail?');
				if(want_to_delete){
          var id_edit = $(this).parents('tr').find(".id_edit");
          id_edit.val("-"+id_edit.val());
          $(this).parents('tr').hide();
					var table = $('#table-purchase_order-detail').DataTable();
					table
						//.row( $(this).parents('tr') )
						//.remove()
						.draw();
					onChange(document.getElementById("vat_percent"));
				}
			}

      function refreshDetailTableEvent(){
				toDelete();
        calculateNumber();
        onChange(document.getElementById("vat_percent"));
      }
		</script>


	</div>
</div>
