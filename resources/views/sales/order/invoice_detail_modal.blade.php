
<!-- Button trigger modal -->
<button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#detailModal" id="btn-detail">
	<i class="fa fa-truck"></i> รายละเอียดส่งสินค้า
</button>

<!-- Modal -->
<div class="modal fade text-left" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document" >
		<div class="modal-content">
			<div class="modal-header pb-1">				
                <!-- <h4>รายละเอียดคงค้าง</h4> -->
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body pt-1">
                <!-- <h4>รายละเอียดคงค้าง</h4> -->
                <div class="table-responsive mb-4">
                    <h4>รายละเอียดคงค้าง</h4>
                    <table width="100%" class="table text-center table-sm table-bordered table-striped " id="table-detail-model">
                        <thead >
                            <tr >
                                <th class="text-center">#</th>
                                <th class="text-center">รหัสสินค้า</th>
                                <th class="text-center">รายละเอียด</th>
                                <th class="text-center">ยอดจอง</th>
                                <th class="text-center">ยอดส่ง</th>
                                <th class="text-center">ยอดค้างส่ง</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->details as $item )
                            @php 
                                $invoiced_item = array_key_exists($item->product->product_code,$unchangable_items)?$unchangable_items[$item->product->product_code]:0;
                            @endphp
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$item->product->product_code}}</td>
                                <td>{{$item->product->product_name}}</td>
                                <td>{{$item->amount}}</td>
                                <td>{{ $invoiced_item  }}</td>
                                <td>{{ $item->amount - $invoiced_item }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>  
                </div>
                <!-- <hr>    -->
                <div class="table-responsive mb-4">
                    <h4>ตรวจสอบรายละเอียดใบส่งสินค้า (IV)</h4>
                    <table width="100%" class="table  text-center table-sm table-bordered table-striped " id="table-detail-invoice-model">
                        <thead >
                            <tr >
                                <th class="text-center">#</th>
                                <th class="text-center">วันที่</th>
                                <th class="text-center">เลขที่ใบส่งสินค้า</th>
                                <th class="text-center">รหัสสินค้า</th>
                                <th class="text-center">รายละเอียด</th>
                                <th class="text-center">ยอดส่ง</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->invoices as $invoice )
                                @foreach($invoice->details as $item )
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{date_format( date_create( explode(" ", $item->invoice->datetime)[0]),"d-m-Y" ) }}</td>
                                    <td>{{$item->invoice->invoice_code}}</td>
                                    <td>{{$item->product->product_code}}</td>
                                    <td>{{$item->product->product_name}}</td>
                                    <td>{{$item->amount}}</td>
                                </tr>
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>  
                </div>
			</div>
		</div>
	</div>
</div>

<script>
	document.addEventListener("DOMContentLoaded", function(event) {
				
		$('#detailModal').on('shown.bs.modal', function (e) {
			//console.log("POP");
			
			if(  ! $.fn.DataTable.isDataTable('#table-detail-model') ){
				$('#table-detail-model').DataTable({
                    order : [ 1, 'asc' ],
                    paging : false,
                    info : false,
                    searching : false,
                }); // END DATATABLE	

                $('#table-detail-invoice-model').DataTable({
                    order : [ 3, 'asc' ],
                    paging : false,
                    info : false,
                    searching : false,
                }); // END DATATABLE	
			}
		}); // END MODAL EVENT
	
	}); //END ADD EVENT LISTENER

</script>