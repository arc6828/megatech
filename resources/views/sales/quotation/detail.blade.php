<div class="card mt-3" id="table" >
	<div class="card-body">
		<style>
		.input{
			max-width: 60px;
			width: 100%;
		}
    table{
      width: 100% !important;
    }
		</style>

		<div class="table-responsive">
			<table class="table table-hover text-center" id="table-quotation-detail" ></table>
		</div>
		<script>
			document.addEventListener("DOMContentLoaded", function(event) {
			 	var detail = JSON.parse('@json($table_quotation_detail)');
				//console.log("DETAIL : ",detail);
				var dataSet = [];
				detail.forEach(function(element,index) {
					//console.log(element,index);
					var id = element.quotation_detail_id;
					var row = createRow(id, element);
					dataSet.push(row);
				});
				//console.log(dataSet);

				var table = $('#table-quotation-detail').DataTable({          
					"ordering": false,          
					"info": false,          
					"searching": false,
					"pageLength": 50,
					"data": dataSet,
					"columns": [
							// { title: "#" },
							{ title: "รหัสสินค้า" },
							{ title: "ชื่อสินค้า" },
							{ title: "วันที่ส่งของ(วัน)" },
							{ title: "จำนวน (pcs)" },
							{ title: "ราคาตั้ง" },
							{ title: "ส่วนลด %" },
							{ title: "ราคาขาย" },
							{ title: "ส่วนลด > 40%" },
							{ title: "ราคาขายรวม" },
							{ title: "action" },
					],
					"fnCreatedRow" : function( nRow, aData, iDataIndex ) {
						//console.log("aData : ", aData, iDataIndex);
			      $(nRow).attr('id', "row-"+aData[0]);
			    },          
					"paging":         false,
				}); //END DataTable



				//ALL ABOUT EVENT
				refreshDetailTableEvent();

				//Load Product
				showProduct();

			});//END DOMContentLoaded

      //EVENT HANDLER
      function createRow(id,element){
        var discount_percent_edit = 100 - element.discount_price / element.normal_price * 100;
        var checked = (discount_percent_edit > element.max_discount_percent? "checked" : "");
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
        return [

          element.product_code +
            "<input type='hidden' class='product_id_edit' name='product_id_edit[]'  value='"+element.product_id+"' >" +
            "<input type='hidden' class='id_edit' name='id_edit[]'  value='"+id+"' >",
          element.product_name ,
          ""+select,
          "<input type='number' class='input amount_edit' name='amount_edit[]'  value='"+element.amount+"' >",

          "<input class='input roundnum normal_price_edit' name='normal_price_edit[]'  value='"+parseFloat(element.normal_price).toFixed(2)+"' disabled>",
					"<input type='number' step='any' class='input roundnum discount_percent_edit' name='discount_percent_edit[]' max="+(checked?parseFloat(element.max_discount_percent)+100:element.max_discount_percent)+"  value='"+(parseFloat(discount_percent_edit).toFixed(2))+"'>",
          "<input class='input roundnum discount_price_edit' name='discount_price_edit[]'  value='"+parseFloat(element.discount_price).toFixed(2)+"'>",
          "<input type='checkbox' class='danger_price_edit' name='danger_price_edit[]' onclick='onChangeDangerPrice(this);' "+checked+" >",
          "<input class='input  roundnum total_edit' name='total_edit[]'  value='"+(element.discount_price *  element.amount)+"' disabled>",
          "<a href='javascript:void(0)' class='text-danger btn-delete-detail' style='padding-right:10px;' title='delete' >" +
              "<span class='fa fa-trash'></span>" +
          "</a> ",
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
        console.log("DOM : ",discount_percent_edit);
        //var btn_submit = row.querySelector("input[name='new_btn_submit']");
        //console.log("print",event,discount_price_edit,discount_percent_edit,normal_price_edit,total_edit,amount_edit);
        switch (obj.name) {
          case "discount_percent_edit[]":
            //EFFECT TO #discount_price_edit
            //console.log("EFFECT TO #discount_price_edit");
            discount_price_edit.value = normal_price_edit.value - normal_price_edit.value * (discount_percent_edit.value) / 100;
            discount_price_edit.value = parseFloat(discount_price_edit.value).toFixed(2);
            break;
          case "discount_price_edit[]":
            //EFFECT TO #discount_percent_edit
            //console.log("EFFECT TO #discount_percent_edit");
            discount_percent_edit.value = 100.0 - discount_price_edit.value / normal_price_edit.value * 100;
            discount_percent_edit.value = parseFloat(discount_percent_edit.value).toFixed(2);
            break;
        }
        //EFFECT TO #total_edit
        total_edit.value = amount_edit.value * discount_price_edit.value;

        total_edit.value = parseFloat(total_edit.value).toFixed(2);
        //discount_percent_edit.value = parseFloat(discount_percent_edit.value).toFixed(2);
        //discount_price_edit.value = parseFloat(discount_price_edit.value).toFixed(2);
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
				var want_to_delete = confirm('Are you sure to delete this quotation detail?');
				if(want_to_delete){
          var id_edit = $(this).parents('tr').find(".id_edit");
          id_edit.val("-"+id_edit.val());
          $(this).parents('tr').hide();
          var table = $('#table-quotation-detail').DataTable();
          table
						.row( $(this).parents('tr') )
            //.hide()
						.remove()
						.draw();
					onChange(document.getElementById("vat_percent"));
				}
			}

      function refreshDetailTableEvent(){
				toDelete();
        calculateNumber();
        onChange(document.getElementById("vat_percent"));
        $('table input').keydown(function (e) {
            if (e.keyCode == 13) {
                e.preventDefault();
                return false;
            }
        });
      }

      function onChangeDangerPrice(obj){
        var element = $(obj);
        var discount_percent_edit = element.parents("tr").find(".discount_percent_edit");
        var max = parseInt(discount_percent_edit.attr("max"));
        //console.log("TOGGLE DANGER PRICE",element);
        if(element.prop("checked") == false){
          //CHANGE MAX INPUT TO NORMAL
          //console.log("Fine");
          max = max%100;
        }else{
          //CHANGE MAX INPUT TO OVERFLOW
          //console.log("Danger");
          max = max+100;
        }
        discount_percent_edit.attr("max",max)
      }

		</script>

		<div class="text-center">

			@include('sales/quotation/create_detail_modal')

		</div>
	</div>
</div>
