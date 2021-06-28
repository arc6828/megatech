@extends('layouts/argon-dashboard/theme')

@section('level-0-url', url('inventory'))
@section('level-0', 'คงคลัง')

@section('level-1-url', url('product'))
@section('level-1', 'แฟ้มหลักสินค้า')


@section('level-2-url', url('product/' . $product->product_id . ''))
@section('level-2', $product->product_code)

@section('title', 'Gaurd Stock')

@section('content')
    <div class="container-fluid">
        <div class="row  justify-content-center">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="float-right">
                            <a class="px-4"
                                href="{{ url('gaurd-stock') }}?product_id={{ $product->product_id }}&since={{ date('Y-m-d') }}">วันนี้</a>
                            <a class="px-4"
                                href="{{ url('gaurd-stock') }}?product_id={{ $product->product_id }}&since={{ date('Y-m-d', strtotime('-7 days')) }}">7
                                วัน</a>
                            <a class="px-4"
                                href="{{ url('gaurd-stock') }}?product_id={{ $product->product_id }}&since={{ date('Y-m-d', strtotime('-31 days')) }}">30
                                วัน</a>
                            <a class="px-4"
                                href="{{ url('gaurd-stock') }}?product_id={{ $product->product_id }}&since={{ date('Y-m-d', strtotime('-366 days')) }}">365
                                วัน</a>
                        </div>
                        <h2>Gaurd Stock ตั้งแต่วันที่ {{ $product->date_default }}</h2>
                        <div class="table-responsive">
                            <table class="table table-sm table-hover text-center table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>วันที่</th>
                                        <th>รหัสสินค้า</th>
                                        <th>รหัสเอกสาร</th>
                                        <th>รับเข้า</th>
                                        <th>ส่งออก</th>
                                        <th>สุทธิ</th>
                                        <th class=" d-none">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th></th>
                                        <th>{{ $product->date_default }}</th>
                                        <th>{{ $product->product_code }}</th>
                                        <th> ยอดยกมา </th>
                                        <th>-</th>
                                        <th>-</th>
                                        <th>{{ number_format($product->amount_in_stock_default) }}</th>
                                    </tr>

                                    @foreach ($gaurdstock as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->created_at }}</td>

                                            <td>{{ $item->product->product_code }}</td>
                                            @php
                                                $positive = true;
                                            @endphp
                                           <td>
                                            @switch($item->type)
                                                @case("sales_invoice")
                                                @case("sales_invoice_cancel")
                                                     {{ $item->code }}      
                                                    @if($item->type != "sales_invoice")
                                                        <span class="text-danger"> (VOID)</span>
                                                    @endif   
                                                    @php 
                                                        $positive = $item->type == "sales_invoice" ? false : true;
                                                    @endphp                                             
                                                    @break
                                                {{-- @case("sales_dt_create")
                                                    @php 
                                                        $positive = false;
                                                    @endphp  
                                                    {{ $item->code }}         
                                                    @break
                                                @case("sales_dt_cancel")
                                                    @php 
                                                        $positive = true;
                                                    @endphp  
                                                    {{ $item->code }}         
                                                    @break
                                                @case("sales_dt_void")
                                                    @php 
                                                        $positive = true;
                                                    @endphp  
                                                    {{ isset($item->delivery_temporary)? $item->delivery_temporary->delivery_temporary_code : $item->code }}
                                                    @break --}}
                                                @case("purchase_receive")                                                                                           
                                                @case("purchase_receive_cancel")   
                                                     {{ $item->code }}      
                                                    @if($item->type != "purchase_receive")
                                                        <span class="text-danger"> (VOID)</span>
                                                    @endif   
                                                    @php 
                                                        $positive = $item->type == "purchase_receive" ? false : true;
                                                    @endphp                                             
                                                    @break                                                                                      
                                                    {{-- @php 
                                                        $positive = $item->type == "purchase_receive" ? true : false;
                                                    @endphp
                                                     {{ $item->code }}      
                                                    @if($item->type != "purchase_receive")
                                                        <span class="text-danger"> (VOID)</span>
                                                    @endif 
                                                    @break
                                                     --}}
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
                                                 @case("purchase_dt_create")
                                                    @php 
                                                        $positive = true;
                                                    @endphp  
                                                    {{ $item->code }}         
                                                    @break
                                                @case("purchase_dt_cancel")
                                                    @php 
                                                        $positive = false;
                                                    @endphp  
                                                    {{ isset($item->receive_temporary)? $item->receive_temporary->purchase_receive_code : $item->code }}
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
                                          <td>+{{ $item->amount }}</td>
                                          <td>-</td>
                                        @else
                                          <td>-</td>
                                          <td>{{ $item->amount }}</td>
                                        @endif
                                            <td>{{ number_format($item->amount_in_stock) }}</td>
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
