
<!-- Button trigger modal -->
<button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#detailModal" id="btn-detail">
	<i class="fa fa-truck"></i> รายละเอียดรับสินค้า
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
                                <th class="text-center">ยอดสั่งซื้อ</th>
                                <th class="text-center">ยอดรับ</th>
                                <th class="text-center">ยอดค้างรับ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->details as $item )
                           
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$item->product->product_code}}</td>
                                <td>{{$item->product->product_name}}</td>
                                <td>{{ $item->amount }}</td>
                                <td>{{ $item->amount -  $item->amount_pending_in }}</td>
                                <td>{{ $item->amount_pending_in }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>  
                </div>
                <!-- <hr>    -->
                <div class="table-responsive mb-4">
                    <h4>ตรวจสอบรายละเอียดใบรับสินค้า (RC)</h4>
                    <table width="100%" class="table  text-center table-sm table-bordered table-striped " id="table-detail-receive-model">
                        <thead >
                            <tr >
                                <th class="text-center">#</th>
                                <th class="text-center">วันที่</th>
                                <th class="text-center">เลขที่ใบส่งสินค้า</th>
                                <th class="text-center">รหัสสินค้า</th>
                                <th class="text-center">รายละเอียด</th>
                                <th class="text-center">ยอดรับ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->receives->where("purchase_status_id","!=","-1") as $receive )
                                @foreach($receive->details as $item )
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{date_format( date_create( explode(" ", $item->receive->datetime)[0]),"d-m-Y" ) }}</td>
                                    <td>{{$item->receive->purchase_receive_code}}</td>
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

                $('#table-detail-receive-model').DataTable({
                    order : [ 3, 'asc' ],
                    paging : false,
                    info : false,
                    searching : false,
                }); // END DATATABLE	
			}
		}); // END MODAL EVENT
	
	}); //END ADD EVENT LISTENER

</script>