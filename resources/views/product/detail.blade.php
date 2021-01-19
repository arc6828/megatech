<style>
    input:read-only, textarea:read-only {
        background-color: #e9ecef;
        border: 1px solid #cad1d7;
    }
</style>
<div class="table-responsive">
    <table class="table table-sm text-center" id="table">
        <thead>
            <tr>
                <th>รหัสสินค้า</th><th>สินค้า</th><th>จำนวน</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @php 
            $productdetail = isset($productdetail)? $productdetail : [];
                    
        @endphp
        @foreach($productdetail as $item)
            <tr>
                <td>
                    <input type="hidden" class="input product_ids" name="product_ids[]" value="{{ $item->detail_product_id }}" /> 
                    {{ $item->detail_product->product_code }}
                </td>
                <td>
                    {{ $item->detail_product->product_name }}
                </td>
                <td>
                    <input type="number" class="input amounts" name="amounts[]" value="{{ $item->amount }}" min="0" max="{{ $item->amount }}" title="[0,{{ $item->amount }}]" style="max-width:60px;" /> 
                </td>                
                <td>
                    <a href="javascript:void(0)" class="text-danger btn-delete-detail" style="padding-right:10px;" title="delete" onclick="deleteDetail(this)">
                        <span class="fa fa-trash"></span>
                    </a> 
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>    
</div>
<script>

document.addEventListener("DOMContentLoaded", function(event) {
    var table = $('#table').DataTable({          
        ordering: false,                  
        paging: false,
        info: false,          
        searching: false,                
    }); //END DataTable
});


//ON CHANGE + ON KEYUP
function calculateNumber(){
    document.querySelectorAll(".input").forEach(function(element,index){
        element.removeEventListener("change", onChangeDetail,true);
        element.removeEventListener("keyup", onChangeDetail,true);
        element.addEventListener("change", onChangeDetail,true);
        element.addEventListener("keyup", onChangeDetail,true);
    }); //END foreach
}
calculateNumber();

function onChangeDetail(){
    //var row = document.querySelector("#row-"+id);
    var obj = event.target;
    var row = $(obj).parents('tr')[0];
    var discount_price_edit = row.querySelector("input[name='discount_prices[]']");
    var total_edit = row.querySelector("input[name='totals[]']");
    var amount_edit = row.querySelector("input[name='amounts[]']");
    console.log("DOM : ",discount_price_edit);
    //var btn_submit = row.querySelector("input[name='new_btn_submit']");
    //console.log("print",event,discount_price_edit,discount_percent_edit,normal_price_edit,total_edit,amount_edit);
    
    //EFFECT TO #total_edit
    total_edit.value = amount_edit.value * discount_price_edit.value;

    total_edit.value = parseFloat(total_edit.value).toFixed(2);
    //discount_percent_edit.value = parseFloat(discount_percent_edit.value).toFixed(2);
    //discount_price_edit.value = parseFloat(discount_price_edit.value).toFixed(2);
    //console.log(obj.value, obj.id);


    onChange();
}

function createRow(element){    
    return [        
        "<input type='hidden' class='product_ids' name='product_ids[]'  value='"+element.product_id+"' >" +
            "<input type='hidden' class='ids' name='ids[]'  value='' >" + 
            element.product_code,        
        element.product_name,       
        "<input type='number' class='input amounts' name='amounts[]'  value='"+element.amount+"' >",
        "<a href='javascript:void(0)' class='text-danger btn-delete-detail' style='padding-right:10px;' title='delete' onclick='deleteDetail(this)' >" +
            "<span class='fa fa-trash'></span>" +
        "</a> ",
    ];
}

function deleteDetail(element){
    //console.log("CHANGE : ", this,this.getAttribute("data_id"));
    //onChange3(this,this.getAttribute("data_id"));
    var want_to_delete = confirm('Are you sure to delete this detail?');
    if(want_to_delete){
        // var id_edit = $(this).parents('tr').find(".product_ids");
        // id_edit.val("-"+id_edit.val());
        // $(this).parents('tr').hide();
        console.log("ROW : " ,$(element));
        var table = $('#table').DataTable();
        table
            .row( $(element).parents('tr') )
            .remove()
            .draw();
        //onChange(document.getElementById("vat_percent"));
    }
}
</script>