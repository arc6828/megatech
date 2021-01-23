<style>
    input:read-only, textarea:read-only {
        background-color: #e9ecef;
        border: 1px solid #cad1d7;
    }
</style>
<div class="table-responsive">
    <table class="table table-sm">
        <thead>
            <tr>
                <th>รหัสสินค้า</th><th>สินค้า</th><th>จำนวน</th><th>ราคาที่ซื้อ</th><th>รวม</th><th class="d-none">Return Order Id</th>
                <!-- <th>Actions</th> -->
            </tr>
        </thead>
        <tbody>
        @php 
            $returnorderdetail = isset($returnorderdetail)? $returnorderdetail : [];
                    
        @endphp
        @foreach($returnorderdetail as $item)
            <tr>
                <td><input type="hidden" class="input product_ids" name="product_ids[]" value="{{ $item->product_id }}" /> {{ $item->product->product_code }}</td>
                <td>{{ $item->product->product_name }}</td>
                @if(isset($mode))
                <td><input type="number" class="input amounts" name="amounts[]" value="{{ $item->amount }}" min="0" max="{{ $item->amount }}" title="[0,{{ $item->amount }}]" style="max-width:60px;" /> / {{ $item->amount }}</td>
                <td><input type="hidden" class="input discount_prices" name="discount_prices[]" value="{{ $item->discount_price }}" /> {{ number_format($item->discount_price,2) }}</td>
                <td><input type="number" class="input totals" name="totals[]" value="{{ $item->amount *  $item->discount_price}}" style="max-width:100px;" readonly /></td>
                @else
                <td><input type="number" class="input amounts" name="amounts[]" value="0" min="0" max="{{ $item->amount }}" title="[0,{{ $item->amount }}]" style="max-width:60px;" /> / {{ $item->amount }}</td>
                <td><input type="hidden" class="input discount_prices" name="discount_prices[]" value="{{ $item->discount_price }}" /> {{ number_format($item->discount_price,2) }}</td>
                <td><input type="number" class="input totals" name="totals[]" value="0" style="max-width:100px;" readonly /></td>

                @endif
                <td class="d-none">{{ $item->return_order_id }}</td>
                <!-- <td>
                    <a href="{{ url('/purchase/return-order-detail/' . $item->id) }}" title="View ReturnOrderDetail"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                    <a href="{{ url('/purchase/return-order-detail/' . $item->id . '/edit') }}" title="Edit ReturnOrderDetail"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                    <form method="POST" action="{{ url('/purchase/return-order-detail' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-danger btn-sm" title="Delete ReturnOrderDetail" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                    </form>
                </td> -->
            </tr>
        @endforeach
        </tbody>
    </table>    
</div>
<script>
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

</script>