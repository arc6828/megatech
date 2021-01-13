@extends('layouts/argon-dashboard/theme')
@php
    $main = request('type_debt');
    switch($main){
        case "XP" : 
            $main = "ตั้งหนี้คงค้าง";
            break;              
        case "AP" : 
            $main = "ตั้งหนี้";
            break;              
        case "DP" : 
            $main = "ลดหนี้";
            break;         
    }
@endphp

@section('level-0-url', url('finance')."?tab=creditor-tab")
@section('level-0','การเงินเจ้าหนี้')

@section('title', $main )
@section('background-tag','bg-info ')

@section('content')
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <!-- <div class="card-header">Supplierdebt</div> -->
                    <div class="card-body">
                        <!-- <a href="{{ url('/supplier-debt/create') }}" class="btn btn-success btn-sm" title="Add New SupplierDebt">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>

                        <form method="GET" action="{{ url('/supplier-debt') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
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
                        <br/> -->
                        <div class="table-responsive">
                            <table class="table table-sm table-hover text-center table-bordered table-striped" id="table">
                                <thead>
                                    <tr>
                                        <!-- <th>#</th>
                                        <th>Doc No</th>
                                        <th>Date</th>
                                        <th>Supplier Id</th>
                                        <th>Discount</th>
                                        <th>Amount</th>
                                        <th>Vat Percent</th>
                                        <th>Vat</th>
                                        <th>Total Before Vat</th><th>Total</th><th>Tax Type Id</th><th>Completed At</th><th>Tax Category</th><th>Round</th><th>Type Debt</th><th>Debt Duration</th><th>User Id</th><th>Role</th><th>Reference</th><th>Zone Id</th><th>Zone Id</th><th>Cheque Id</th><th>Payment Method</th><th>Actions</th> -->
                                        <th>เลขที่เอกสาร</th>
                                        <th>วันที่เอกสาร</th>
                                        <th>รหัสเจ้าหนี้</th>
                                        <th>ชื่อเจ้าหนี้</th>
                                        <th>ยอดสุทธิ</th>
                                        <th>ยอดหนี้คงเหลือ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($supplierdebt as $item)
                                    <tr>
                                        <!-- <td>{{ $loop->iteration }}</td> -->
                                        <!-- <td>{{ $item->doc_no }}</td>
                                        <td>{{ $item->date }}</td><td>{{ $item->supplier_id }}</td><td>{{ $item->discount }}</td><td>{{ $item->amount }}</td><td>{{ $item->vat_percent }}</td><td>{{ $item->vat }}</td><td>{{ $item->total_before_vat }}</td><td>{{ $item->total }}</td><td>{{ $item->tax_type_id }}</td><td>{{ $item->completed_at }}</td><td>{{ $item->tax_category }}</td><td>{{ $item->round }}</td><td>{{ $item->type_debt }}</td><td>{{ $item->debt_duration }}</td><td>{{ $item->user_id }}</td><td>{{ $item->role }}</td><td>{{ $item->reference }}</td><td>{{ $item->zone_id }}</td><td>{{ $item->zone_id }}</td><td>{{ $item->cheque_id }}</td><td>{{ $item->payment_method }}</td>
                                        <td>
                                            <a href="{{ url('/supplier-debt/' . $item->id) }}" title="View SupplierDebt"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                            <a href="{{ url('/supplier-debt/' . $item->id . '/edit') }}" title="Edit SupplierDebt"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                                            <form method="POST" action="{{ url('/supplier-debt' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete SupplierDebt" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                            </form>
                                        </td> -->
                                        <td>
                                            <a href="{{ url('/finance/supplier-debt/' . $item->id) }}">
                                                {{ $item->doc_no }}
                                            </a>
                                        </td>
                                        <td>{{ $item->date }}</td>
                                        <td>
                                            {{ isset($item->supplier_id) ? $item->supplier->supplier_code :'' }}
                                        </td>
                                        <td>
                                            {{ isset($item->supplier_id) ? $item->supplier->company_name :'' }}
                                        </td>
                                        <td>{{ number_format($item->total,2) }}</td>
                                        <td>{{number_format($item->total_debt,2)}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="text-center mt-4">
                            <a href="{{ url('finance/supplier-debt/create') }}?type_debt={{ request('type_debt') }}" class="btn btn-success" title="Add New SupplierDebt">
                                <i class="fa fa-plus" aria-hidden="true"></i> {{ $main }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
    document.addEventListener("DOMContentLoaded", function(event) {
        let table = $('#table').DataTable({          
            // ordering: false,                  
            paging: false,
            info: false,        
            order : [0, 'desc']  
            // searching: false,                
        }); //END DataTable

        //DATA TABLE SCROLL
        let tableCont = document.querySelector('#table');        		
        tableCont.style.cssText  = "margin-top : -1px !important; width:100%;";
        tableCont.parentNode.style.overflow = 'auto';
        tableCont.parentNode.style.maxHeight = '400px';
        tableCont.parentNode.addEventListener('scroll',function (e){
            var scrollTop = this.scrollTop;
            this.querySelector('thead').style.transform = 'translateY(' + scrollTop + 'px) '+'translateZ(' + 100 + 'px)';
            this.querySelector('thead').style.background = "white";
            this.querySelector('thead').style.zIndex = "3000";
            this.querySelector('thead').style.marginBottom = "100px";
            //console.log(scrollTop);
        })
        //END DATA TABLE SCROLL
    });
    </script>
@endsection
