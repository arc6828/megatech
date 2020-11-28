<!-- Button trigger modal -->
<button type="button" class="btn btn-success btn-sm d-none" data-toggle="modal" data-target="#issueStockModal">
	<i class="fa fa-plus"></i> เบิกสินค้าไปผลิต
</button>

<!-- Modal -->
<div class="modal fade" id="issueStockModal" tabindex="-1" role="dialog" aria-labelledby="issueStockModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document" >
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="issueStockModalLabel">รายการเบิกสินค้าไปผลิต (IS)</h5>
				<button type="button" class="close" id="btn-close-product" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
        		<input hidden id="search_key" value="">
				<div class="table-responsive" id="table-container" >
					<table class="table table-hover text-center table-sm" id="table-issue-stock-model2" >
						<thead>
							<tr>
								<!-- <th>#</th> -->
								<th>รหัสเอกสาร</th>
								<th>รหัสสินค้าสำเร็จรูป</th>
								<th>สินค้าสำเร็จรูป</th>
								<th>จำนวน</th>
								<th>พนักงานผู้บันทึก</th>
								<!-- <th>สถานะ</th> -->
								<!-- <th>Remark</th><th>Total</th><th>Revision</th> -->
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
						@foreach($issuestocks as $item)
							<tr>
								<!-- <td>{{ $loop->iteration }}</td> -->
								<td>{{ $item->code }}</td>
								<td>{{ $item->product->product_code }}</td>
								<td>{{ $item->product->product_name }}</td>
								<td>{{ $item->amount }}</td>
								<td>{{ $item->user->short_name }}</td>								
								<!-- <td>
									@switch($item->status_id)
										@case("-1")
											<span class="badge badge-pill badge-secondary">Void</span>
											@break
										@case("1")
											<span class="badge badge-pill badge-warning">เบิกไปผลิต</span>								
											@break                                                
										@case("2")
											<span class="badge badge-pill badge-success">รันสินค้าสำเร็จรูปแล้ว</span>								
											@break
									@endswitch
								</td> -->
								<td>
									<a  class='btn btn-success btn-create btn-sm' href="{{ url('/receive-final/create') }}?is_code={{ $item->code }}" >
										<span class='fa fa-plus'></span>
									</a>
								</td>
								<!-- <td>{{ $item->remark }}</td><td>{{ $item->total }}</td><td>{{ $item->revision }}</td> -->
								<!-- <td>
									<a href="{{ url('/issue-stock/' . $item->id) }}" title="View IssueStock"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
									<a href="{{ url('/issue-stock/' . $item->id . '/edit') }}" title="Edit IssueStock"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

									<form method="POST" action="{{ url('/issue-stock' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
										{{ method_field('DELETE') }}
										{{ csrf_field() }}
										<button type="submit" class="btn btn-danger btn-sm" title="Delete IssueStock" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
									</form>
								</td> -->
							</tr>
						@endforeach
						</tbody>
					</table>
				</div>
			</div>
			<div class="modal-footer d-none">
				<button type="button" class="btn btn-secondary" data-dismiss="modal" id="btn-close">Close</button>
			</div>
		</div>
	</div>
</div>

<script>
	document.addEventListener("DOMContentLoaded", function(event) {

		
		$('#issueStockModal').on('shown.bs.modal', function (e) {
			if(  ! $.fn.DataTable.isDataTable('#table-issue-stock-model') ){
				//setPreLoader(true);

				//FETCHING
				fetch('{{ url('/') }}/api/issue-stock')
					.then(response => response.json())
					.then(result => {
						console.log(result)
						var table = $('#table-issue-stock-model').DataTable({
							"data": prepareDataSet(result),
							"deferRender" : true,
							"columns": [
								{ title: "รหัสเอกสาร" },
								{ title: "รหัสสินค้าสำเร็จรูป" },
								{ title: "ชื่อสินค้า" },
								{ title: "จำนวน" },
								{ title: "พนักงานผู้บันทึก" },
								{ title: "สถานะ" },
								{ title: "action" },
							],
							"paging": false,
							"info": false,
							"order": [[ 4, "desc" ]],
						}); // END DATATABLE

						
						table.columns.adjust().draw();

						//DATA TABLE SCROLL
						var tableCont = document.querySelector('#table-issue-stock-model');
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


				
						// table.on( 'search.dt', function () {
						// 	var search_key = table.search();
						// 	if(search_key != $('#search_key').val()){
						// 		console.log("Hello",table.search() );

						// 		fetch("{{ url('/') }}/api/product?q="+search_key)
						// 			.then(response => response.json())
						// 			.then(result1 => {
						// 				// console.log(result1)
						// 				$('#search_key').val(search_key);
						// 				var new_data = prepareDataSet(result1);
						// 				table.clear();
						// 				table.rows.add(new_data); // Add new data
						// 				table.columns.adjust().draw(); // Redraw the DataTable
						// 			});		 //END FETCH SEARCHING			
						// 	}
						// } );
						
					}); //END FETCH FIRST TIME


				
			}
		}); // END MODAL EVENT

	}); //END ADD EVENT LISTENER
	

	function prepareDataSet(result){
		let dataSet = [];
		result.forEach(function(element,index) {
			//console.log(element,index);
			// var id = element.product_id;
			// var price = parseFloat(element.promotion_price? element.promotion_price : element.normal_price).toFixed(2);
			let row = [
				element.code,
				element.product_id,
				element.product_id ,
				element.amount,
				element.status_id,
				element.user_id,
				"<a  class='btn btn-success btn-create btn-sm' href='{{ url('/receive-final/create') }}?is_code="+element.code+"' >" +
					"<span class='fa fa-plus'></span>" +
					"</a>",
			];
			dataSet.push(row);
		});
		//console.log(dataSet);
		return dataSet;
	}

	function addIssueStock(obj){
		var product = JSON.parse(obj.getAttribute("json"));
		product["amount"] = document.querySelector("#amount_create"+product.product_id).value;
		product["discount_price"] = product.promotion_price? product.promotion_price : product.normal_price;
		//console.log("CLICK PRODUCT : ", product);

		var table = $('#table').DataTable();
		var row = createRow(product);
		table.row.add(row).draw( false );
		//refreshDetailTableEvent();
		document.querySelector("#btn-close-product").click();
		//console.log("CLICK");
	}
</script>
