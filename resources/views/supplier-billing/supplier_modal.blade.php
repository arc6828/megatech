<!-- Button trigger modal -->
<button type="button" class="btn btn-sm btn-light" id="btn-supplier" data-toggle="modal" data-target="#supplierModal">
	<i class="fa fa-plus"></i> เลือกเจ้าหนี้
</button>

<!-- Modal -->
<div class="modal fade" id="supplierModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">เลือกลูกหนี้</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="table-responsive d-none">
					<table class="table table-hover text-center table-sm" id="table-supplier-modal" style="width:100%"></table>
				</div>
				<div class="table-responsive">
					<table class="table table-hover text-center table-sm" id="table">
						<thead>
							<tr>
								<th class="text-center">รหัส</th>
								<th class="text-center">ชื่อบริษัท</th>
								<th class="text-center">ยอดหนึ้เดือนที่ผ่านมา</th>
								<th class="text-center">ยอดหนึ้ทั้งหมด</th>
								<th class="text-center ">วางบิล</th>
							</tr>
						</thead>
						<tbody>
						@foreach($suppliers as $row)
						@php
							$total_debt = $row->Receives_on_debt->sum('total_debt');
							$total_debt_last_cycle = $row->Receives_on_debt_last_cycle->sum('total_debt');
							
						@endphp
						<tr>
							<td><a href2="{{ url('/') }}/supplier/{{ $row->supplier_id }}/edit">{{ $row->supplier_code }}</a></td>
							<td>{{ $row->company_name }}</td>
							<td>{{ number_format($total_debt_last_cycle,2) }}</td>
							<td>{{ number_format($total_debt,2) }}</td>
							<td class=" ">
								@if($total_debt > 0)
								<a class="btn btn-sm btn-primary" href="{{ url('/') }}/finance/supplier-billing/create?supplier_id={{ $row->supplier_id }}&end_date={{ date('Y-m-t', strtotime( '-1 month' ) ) }}">วางบิลเดือนที่ผ่านมา</a>
								<a class="btn btn-sm btn-success" href="{{ url('/') }}/finance/supplier-billing/create?supplier_id={{ $row->supplier_id }}&end_date={{ date('Y-m-t' ) }}">วางบิลทั้งหมด</a>
								@endif
								<a href="javascript:void(0)" onclick="onDelete( {{ $row->supplier_id }} )" class="text-danger d-none">
									<span class="fa fa-trash"></span>
								</a>
							</td>
						</tr>
						@endforeach
						</tbody>
					</table>
				</div>
			</div>
			<div class="modal-footer d-none">
				<button type="button" class="btn btn-secondary" data-dismiss="modal" id="btn-close-supplier">Close</button>
			</div>
		</div>
	</div>
</div>

<script>	
	document.addEventListener("DOMContentLoaded", function(event) {
		$('#supplierModal').on('show.bs.modal', function (e) {			
			var dataTable_not_exist = ! $.fn.DataTable.isDataTable('#table') ;
			if( dataTable_not_exist ){
				$('#table').DataTable();
			}
		});  
	});
</script>
