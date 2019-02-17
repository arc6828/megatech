@extends('monster-lite/layouts/theme')

@section('title','ปรับปรุงเจ้าหนี้คงค้าง')

@section('breadcrumb-menu')

@endsection

@section('content')
<script type="text/javascript" src="{{url('/')}}/js/debtout/debtout_jquery.js"></script>

@forelse($table_debtout as $row)
<form action="#" method="POST" id="form-submit">
		{{ csrf_field() }}
		{{ method_field('PUT') }}
		<div class="card">
				<div class="card-block">
					<div class="row">
						<div class="col-lg-6">
							<div class="form-group form-inline">
								<label class="col-lg-3">เลขที่เอกสาร</label>
										<div class="col-lg-3">
												<input type="text" name="debt_code"  class="form-control form-control-line" value="{{ $row->debt_code }}">
										</div>
							 </div>
						</div>
						<div class="col-lg-6">
							<div class="form-group form-inline">
								<label class="col-lg-3">วันที่เอกสาร</label>
										<div class="col-lg-3">
												<input type="date" name="date_debt"  class="form-control form-control-line" value="{{ $row->date_debt }}" >
										</div>
							 </div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-6">
							<div class="form-group form-inline">
								<label class="col-lg-3">รหัสเจ้าหนี้</label>
										<div class="col-lg-5">
												<input type="text" name="customer_id" id="customer_id"  class="form-control form-control-line" value="{{ $row->customer_id }}" >
                                        </div>
                                        {{-- Modal --}}
										{{-- @include('finance/billing_note/modal-customer') --}}
							 </div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-6">
							<div class="form-group form-inline">
								<label class="col-lg-3">ชนิดภาษี</label>
										<div class="col-lg-3">
												<select name="tax_type_id" class="form-control form-control-line">
													@foreach ($table_type_tax as $row_type_tax)
													<option value="{{ $row_type_tax->tax_type_id }}">{{ $row_type_tax->tax_type_name }}</option>
													@endforeach
												
												</select>
										</div>
							 </div>
						</div>
						<div class="col-lg-6">
								<div class="form-group form-inline">
										<label class="col-lg-3">วันครบกำหนด</label>
										<div class="col-lg-3">
												<input type="date" name="deadline"  class="form-control form-control-line" value="{{ $row->deadline }}" >
										</div>
								</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-6">
								<div class="form-group form-inline">
										<label class="col-lg-3">ภาระภาษี: </label>
										<div class="col-lg-3">
											<select class="form-control form-control-line" id="tax_liability" name="tax_liability">
													 <option value="right">เกณฑ์สิทธิ์</option>
													 <option value="cash">เกณฑ์เงินสด</option>
												 </select>
										</div>
								</div>
						</div>
						<div class="col-lg-6">
								<div class="form-group form-inline">
										<label class="col-lg-3">ยื่นภาษีในงวด: </label>
										<div class="col-lg-3">
												<input id="date" name="tax_filing" class="form-control form-control-line" value="{{ $row->tax_filing }}">
										</div>
								</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-6">
								<div class="form-group form-inline">
									<div class="col-lg-2"></div>
									<div class="col-lg-5">
										<div class="form-check">
										<input type="checkbox" class="form-check-input">
										<label class="form-check-label">ภาษีมูลค่าค่าเพิ่มยื่นเพิ่ม</label>
									</div>
									</div>
									</div>
						</div>
					</div>
					<hr class="my-4" style="border-top: 1px soild">
					<div class="row">
							<div class="col-lg-6">
							</div>
							<div class="col-lg-6">
								<div class="form-group form-inline">
								<label class="col-lg-3">ยอดรวม</label>
								<div class="col-lg-3">
									<input type="float" name="total_dept" id="totaldept" value="{{ $row->total_debt }}"  class="form-control form-control-line"onchange="myFunction(total_dept)">
								</div>	
								</div>
							</div>
					</div>
					<div class="row">
						<div class="col-lg-6">
								<div class="form-group form-inline">
									<label class="col-lg-3">อัตราภาษี</label>
									<div class="col-lg-3">
											<input type="float" name="tax" id="tax" value="{{ $row->tax }}" class="form-control form-control-line" onchange="myFunction(tax)">
									</div>
								</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group form-inline">
								<label class="col-lg-3">มูลค่าภาษี</label>
								<div class="col-lg-3">
										<input type="float" name="tax_value" id="taxvalue" value="{{ $row->tax_value }}" class="form-control">
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-6"></div>
						<div class="col-lg-6">
							<div class="form-group form-inline">
								<label class="col-lg-3">ยอดสุทธิ</label>
								<div class="col-lg-3">
										<input type="float" name="net_amount" value="{{ $row->net_amount }}" id="total" class="form-control" disabled>
								</div>
							</div>
						</div>
					</div>			
				</div>
			</div>
			@section('navbar-menu')
			<div style="margin:21px;">
			<a href="javascript:void(0)" onclick="submitForm({{ $row->debt_id }})" class="btn btn-success">Save</a>
			<a href="{{ url('/') }}/finance/creditor/debtout" class="btn btn-danger">Back</a>
			</div>
			@endsection
</form>
<script type="text/javascript">
	var d = new Date();
	var month = d.getUTCMonth() + 1;
	var year = d.getUTCFullYear();
	newdate = month + "/" + (year+543);
	document.getElementById("date").innerHTML = newdate;
	
	
	function myFunction(tax,totaldept) {
			var totaldept= document.getElementById("totaldept").value;
			var tax = document.getElementById("tax").value;
			var taxvalue = document.getElementById("taxvalue");
			taxvalue.value = (totaldept*tax)/100;
	}
	function submitForm(id){
		var form = document.getElementById('form-submit');
		form.action = "{{ url('/') }}/finance/creditor/debtout/"+id;
		form.submit();
	}
	</script>
@empty
<div>error</div>
@endforelse
@endsection