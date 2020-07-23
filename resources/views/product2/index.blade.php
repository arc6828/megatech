@extends('layouts/argon-dashboard/theme')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <input hidden="" id="search_key" value="">
                    <div class="card-header">Product2</div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-sm" id="table-product" width="100%"></table>
                        </div>
                        <script>
                            $.ajax({
                                    url: "{{ url('/') }}/api/product",
                                    type: "GET",
                                    dataType : "json",
                            })
                            .done(function(result){
                                //console.log(result);

                                var dataSet = prepareDataSet(result);
                                //console.log(dataSet);
                                var table = $('#table-product').DataTable({
                                    "data": dataSet,
                                    "deferRender" : true,
                                    //"pageLength": 10,
                                    "columns": [
                                        { title: "รหัสสินค้า" },
                                        { title: "barcode" },
                                        { title: "ชื่อสินค้า" },
                                        { title: "ราคาขาย" },
                                        { title: "#ในคลัง" },
                                        { title: "#ค้างส่ง" },
                                        { title: "#ค้างรับ" },
                                        //{ title: "action" },
                                    ],
                                    "scrollY": "250px",
                                    "scrollCollapse": true,
                                    "paging":         false,
                                    "ordering": false,
                                    
                                }); // END DATATABLE

                                table.on( 'search.dt', function () {
                                    var search_key = table.search();
                                    console.log("SEAECH", search_key,$('#search_key').val())
                                    if(search_key != $('#search_key').val() ){
                                        //console.log("Hello",table.search() );
                                        $.ajax({
                                            url: "{{ url('/') }}/api/product?q="+search_key ,
                                            type: "GET",
                                            dataType : "json",
                                        }).done(function(result1, textStatus, request){

                                            //console.log(request.getAllResponseHeaders());
                                            //console.log(new Date(request.getResponseHeader('date')),request.getResponseHeader('date') );
                                            $('#search_key').val(search_key);
                                            var new_data = prepareDataSet(result1);
                                            table.clear();
                                            //table.rows.add(new_data); // Add new data
                                            //table.columns.adjust().draw(); // Redraw the DataTable
                                            table.rows.add(new_data).draw(); // Redraw the DataTable
                                        });
                                    }
                                } ); //END SEARCH
                                $('.dataTables_scrollBody').on('scroll', function() {
                                    //var table2 = $('#table-product').DataTable();
                                    //var displayIndexes = table2.scroller.page();
                                    var scroll_top = $('.dataTables_scrollBody').scrollTop();
                                    var table_height = $('#table-product').height();
                                    var scroll_height = $('.dataTables_scrollBody').height();
                                    var scroll_position = scroll_top + scroll_height;
                                    var is_bottom = table_height == scroll_position;

                                    
                                    
                                    console.log('DATA : ', scroll_top , scroll_height, scroll_position , is_bottom,table_height);
                                    
                                    if(is_bottom){
                                        
                                        var search_key = table.search();
                                        console.log("End Scroll", search_key);
                                        console.log("Hello",table.search() );
                                        $.ajax({
                                            url: "{{ url('/') }}/api/product?q="+search_key ,
                                            type: "GET",
                                            dataType : "json",
                                        }).done(function(result1, textStatus, request){

                                            //console.log(request.getAllResponseHeaders());
                                            //console.log(new Date(request.getResponseHeader('date')),request.getResponseHeader('date') );
                                            $('#search_key').val(search_key);
                                            var new_data = prepareDataSet(result1);
                                            //table.clear();
                                            table.rows.add(new_data).draw(); // Redraw the DataTable
                                        });
                                    }
                                });
                            }); //END AJAX

                            function prepareDataSet(result){
                                var dataSet = [];
                                result.forEach(function(element,index) {
                                    //console.log(element,index);
                                    var id = element.product_id;
                                    var price = element.promotion_price? element.promotion_price : element.normal_price;
                                    var extension = "<span class='text-danger'>"+(element.stock?"("+element.stock+")":"")+"</span>";
                                    var row = [
                                    "<a href='{{ url("/") }}/product/"+element.product_id+"/edit'>"+ element.product_code+"</a>",
                                    element.BARCODE,
                                    element.product_name+" / "+element.grade + " " +extension,
                                    price,
                                    element.amount_in_stock,
                                    element.pending_out,
                                    element.pending_in,
                                    //"<a href='javascript:void(0)' onclick='onDelete("+id+")' class='text-danger'><span class='fa fa-trash'></span></a>",
                                    ];
                                    dataSet.push(row);
                                }); //END FOREACH
                                //console.log(dataSet);
                                return dataSet;
                                }
                        
                        </script>
                    </div>
                </div>
                <div class="card d-none">
                    <div class="card-header">Product2</div>
                    <div class="card-body">
                        <a href="{{ url('/product2/create') }}" class="btn btn-success btn-sm" title="Add New Product2">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>

                        <form method="GET" action="{{ url('/product2') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ request('search') }}">
                                <span class="input-group-append">
                                    <button class="btn btn-secondary" type="submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                        </form>

                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table" width="100%">
                                <thead>
                                    <tr>
                                        <th>#</th><th>Product Code</th><th>Product Name</th><th>Product Detail</th><th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                
                                @foreach($product2 as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->product_code }}</td><td>{{ $item->product_name }}</td><td>{{ $item->product_detail }}</td>
                                        <td>
                                            <a href="{{ url('/product2/' . $item->id) }}" title="View Product2"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                            <a href="{{ url('/product2/' . $item->id . '/edit') }}" title="Edit Product2"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                                            <form method="POST" action="{{ url('/product2' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete Product2" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $product2->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
