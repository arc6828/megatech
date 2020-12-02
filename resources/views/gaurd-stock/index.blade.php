@extends('layouts/argon-dashboard/theme')

@section('level-0-url', url('inventory'))
@section('level-0','คงคลัง')

@section('level-1-url', url('product'))
@section('level-1','แฟ้มหลักสินค้า')


@section('level-2-url', url('product/'.$product->product_id.'' ))
@section('level-2', $product->product_code)

@section('title','Gaurd Stock')

@section('content')
    <div class="container">
        <div class="row  justify-content-center">

            <div class="col-md-12">
                <div class="card">
                    <!-- <div class="card-header">Gaurdstock</div> -->
                    <div class="card-body">
                        <!-- <a href="{{ url('/gaurd-stock/create') }}" class="btn btn-success btn-sm d-none" title="Add New GaurdStock">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a> -->

                        <!-- <form method="GET" action="{{ url('/gaurd-stock') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ request('search') }}">
                                <span class="input-group-append">
                                    <button class="btn btn-secondary" type="submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                        </form> -->

                        <!-- <br/>
                        <br/> -->
                        <div class="table-responsive">
                            <table class="table table-sm table-hover text-center table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Date</th>
                                        <th>Product Id</th>
                                        <th>Code</th>
                                        <!-- <th>Amount</th> -->
                                        <th>รับเข้า</th>
                                        <th>ส่งออก</th>
                                        <th>สุทธิ</th>
                                        <!-- <th>Remark</th> -->
                                        <th class=" d-none">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>0</td>
                                        <td>{{ $product->date_default }}</td>                                        
                                        <td>{{ $product->product_code }}</td>                                        
                                        <td> ยอดยกมา </td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>{{ $product->amount_in_stock_default }}</td>                                        
                                    </tr>

                                @foreach($gaurdstock as $item)                                    
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->created_at }}</td>
                                        
                                        <td>{{ $item->product->product_code }}</td>
                                        @php 
                                            $positive = true;
                                        @endphp
                                        <td>
                                            @switch($item->type)
                                                @case("sales_order")
                                                    {{ $item->sales_order->order_code }}
                                                    @break
                                                @case("sales_invoice")
                                                @case("sales_invoice_cancel")
                                                    {{ $item->sales_invoice->invoice_code }}      
                                                    @php 
                                                        $positive = $item->type == "sales_invoice" ? false : true;
                                                    @endphp                                             
                                                    @break
                                                @case("sales_dt_create")
                                                    @php 
                                                        $positive = false;
                                                    @endphp  
                                                    {{ isset($item->delivery_temporary)? $item->delivery_temporary->delivery_temporary_code : "DT".$item->code }}
                                                    @break
                                                @case("sales_dt_cancel")
                                                    @php 
                                                        $positive = true;
                                                    @endphp  
                                                    {{ isset($item->delivery_temporary)? $item->delivery_temporary->delivery_temporary_code : "DT".$item->code }}
                                                    @break
                                                @case("sales_dt_void")
                                                    @php 
                                                        $positive = true;
                                                    @endphp  
                                                    {{ isset($item->delivery_temporary)? $item->delivery_temporary->delivery_temporary_code : "DT".$item->code }}
                                                    @break
                                                @case("purchase_order")
                                                    <a href="{{ url('/') }}/purchase/order/{{ $item->purchase_order->purchase_order_id }}/edit">{{ $item->purchase_order->purchase_order_code }}</a>
                                                    @break
                                                @case("purchase_receive")                                                                                                        
                                                @case("purchase_receive_cancel")                                                                                                        
                                                    @php 
                                                        $positive = $item->type == "purchase_receive" ? true : false;
                                                    @endphp
                                                    {{ $item->purchase_receive->purchase_receive_code }}    
                                                    @break
                                                @case("sales_return_invoice")                                                    
                                                    @php 
                                                        $positive = true;
                                                    @endphp  
                                                    {{ $item->code }}         
                                                    @break
                                                @case("sales_return_invoice_cancel")                                                    
                                                    @php 
                                                        $positive = false;
                                                    @endphp  
                                                    {{ $item->code }}         
                                                    @break
                                                @case("purchase_return_order")                                                    
                                                    @php 
                                                        $positive = false;
                                                    @endphp  
                                                    {{ $item->code }}         
                                                    @break
                                                @case("purchase_return_order_cancel")                                                    
                                                    @php 
                                                        $positive = false;
                                                    @endphp  
                                                    {{ $item->code }}         
                                                    @break
                                                @case("issue_stock")
                                                @case("issue_stock_cancel")                                                        
                                                    @php 
                                                        $positive = $item->type == "issue_stock" ? false : true;
                                                    @endphp  
                                                    {{ $item->code }}
                                                    @break
                                                    @case("issue_stock")
                                                @case("receive_final")   
                                                @case("receive_final_cancel")                                                       
                                                    @php 
                                                        $positive = $item->type == "receive_final" ? true : false;
                                                    @endphp  
                                                    {{ $item->code }}
                                                    @break
                                                @case("adjust_stock")
                                                @case("adjust_stock_cancel")                                                           
                                                    @php 
                                                        $positive = $item->adjust_stock->adjust_type == "1" ? true : false;
                                                    @endphp  
                                                    {{ $item->code }}
                                                    @break
                                            @endswitch
                                        </td>
                                        @if( $positive )
                                        <td>{{ $item->amount }}</td>
                                        <td>-</td>
                                        @else
                                        <td>-</td>
                                        <td>{{ $item->amount }}</td>
                                        @endif
                                        <!-- <td>{{ $item->pending_in }}</td>
                                        <td>{{ $item->pending_out }}</td> -->
                                        <td>{{ $item->amount_in_stock }}</td>
                                        <!-- <td>{{ $item->remark }}</td> -->
                                        <td class=" d-none">
                                            <a href="{{ url('/gaurd-stock/' . $item->id) }}" title="View GaurdStock"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                            <a href="{{ url('/gaurd-stock/' . $item->id . '/edit') }}" title="Edit GaurdStock"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                                            <form method="POST" action="{{ url('/gaurd-stock' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete GaurdStock" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
