<!-- Button trigger modal -->
<button type="button" class="btn btn-primary btn-sm d-none" data-toggle="modal" data-target="#customerModal">
	<i class="fa fa-plus"></i> เลือกลูกหนี้
</button>

<!-- Modal -->
<div class="modal fade" id="customerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">เลือกลูกหนี้</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="table-responsive">
					<table class="table table-hover text-center table-sm" id="table-customer-modal" style="width:100%; margin-top:-1px !important;"></table>
				</div>
			</div>
			<div class="modal-footer d-none">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<script>
	//onClick
	function select_item(id,name,code) {
		console.log("ID COMPANY : ",id,name,code);
		$('#customer_id').val(id);
		$('#company_name').val(name);
		//$('#customer_code').val(code);
		$('#customer_code').text(code);

          var obj = JSON.parse($("#text-"+id).val());
		//console.log("Customer", obj, obj.billing_duration);

		document.querySelector("#debt_duration").value = obj.debt_duration;
		//document.querySelector("#billing_duration").value = obj.billing_duration;
		document.querySelector("#payment_condition").value = obj.payment_condition;
		document.querySelector("#delivery_type_id").value = obj.delivery_type_id;
		document.querySelector("#tax_type_id").value = obj.tax_type_id;
		document.querySelector("#delivery_time").value = "3";
		document.querySelector("#contact_name").value = obj.contact_name;
		document.querySelector("#zone_id").value = obj.zone_id;		
		document.querySelector("#staff_id").value = obj.user_id;


		$('#customerModal').modal('hide');
		onChangeCustomer();

		//UPDATE CC
		fetch("{{ url('api/contact/customer') }}/"+id)
			.then(response => response.json())
			.then(data => {
				console.log(data);
				let contact_name = document.querySelector("#contact_name");
				data.forEach(function(item){
					var node = document.createElement("option");                 // Create a <li> node
					node.innerHTML = item.name;
					node.value = item.name;
					contact_name.appendChild(node);
				});
			});
	}
	document.addEventListener("DOMContentLoaded", function(event) {
		//console.log("555");
		//AJAX
		$('#customerModal').on('shown.bs.modal', function (e) {
			if(  ! $.fn.DataTable.isDataTable('#table-customer-modal') ){
				$.ajax({
					url: "{{ url('/') }}/api/customer?user_id={{ Auth::id() }}",
					type: "GET",
					dataType : "json",
				}).done(function(result){
					//console.log(result);
					var dataSet = [];
					result.forEach(function(element,index) {
						//console.log(element,index);
						var row = [
							element.customer_code,
							element.company_name,
							//element.contact_name,
							"<a "
									+"style='position:static; will-change:unset;' "
									+"class='btn btn-success btn-sm d-none'"
									+"href='{{ url('/') }}/sales/quotation/create?customer_id="+element.customer_id+"'"
									+">เลือก</a>"
									+"<button type='button' "
									+"class='btn btn-success btn-sm'"
									+"style='position:static; will-change:unset;' "
									+"onClick='select_item("+element.customer_id+",`"+element.company_name+"`,`"+element.customer_code+"`)' "
									+">เลือก</button>"
									+"<textarea class='d-none' id='text-"+element.customer_id+"'>"+JSON.stringify(element)+"</textarea>",
						];
						dataSet.push(row);
					});
					//console.log(dataSet);

					$('#table-customer-modal').DataTable({
						data: dataSet,
						deferRender : true,
						columns: [
								{ title: "รหัส" },
								{ title: "บริษัท" },
								//{ title: "ผู้ติดต่อ" },
								{ title: "#" },
						],
						paging :         false,
						info :         false,
						

					})
					.search("{{ isset($customer)? $customer->customer_code : '' }}")
					.columns.adjust()
					.draw();// END DATATABLE;
					//DATA TABLE SCROLL
					var tableCont = document.querySelector('#table-customer-modal');
					tableCont.style.cssText  = "margin-top : -1px !important; width:100%;";

					tableCont.parentNode.style.overflow = 'auto';
					tableCont.parentNode.style.maxHeight = '400px';
					tableCont.parentNode.addEventListener('scroll',function (e){
						var scrollTop = this.scrollTop;
						this.querySelector('thead').style.transform = 'translateY(' + scrollTop + 'px) '+'translateZ(' + 100 + 'px)';
						this.querySelector('thead').style.background = "white";
						this.querySelector('thead').style.zIndex = "3000";
						this.querySelector('thead').style.marginBottom = "100px";
						console.log(scrollTop);
					})
					//END DATA TABLE SCROLL
					@if( !empty(request('customer_id')) )
						//$("#btn-customer").click();
						
						//$("#text-{{ $customer->customer_id }}").text( @json($customer) );

						console.log("BTN : ",  $("#text-{{ $customer->customer_id }}"),  $("#text-{{ $customer->customer_id }}").prev());
						$("#text-{{ $customer->customer_id }}").prev().click();
						//select_item(395,`บริษัท อะมะดะ แมชชีน ทูลส์ (ประเทศไทย) จำกัด`,`A0001`);
						//$('#customerModal').modal('hide');

					@endif
				}); //END AJAX
			}
		}); // END MODAL EVENT

	});//END ADD EVENT LISTENER
</script>
