@extends('layouts/argon-dashboard/theme')

@section('level-0-url', url('sales'))
@section('level-0','การขาย')

@section('title','ใบรับคืนสินค้า')

@section('background-tag','bg-warning')

@section('content')
<div class="container">
    <div class="row">

        <div class="col-md-12">
            <div class="card">
                <!-- <div class="card-header">Returninvoice</div> -->
                <div class="card-body">
                    <!-- <a href="{{ url('/sales/return-invoice/create') }}" class="btn btn-success btn-sm" title="Add New ReturnInvoice">
                        <i class="fa fa-plus" aria-hidden="true"></i> Add New
                    </a> -->

                    <!-- <form method="GET" action="{{ url('/sales/return-invoice') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
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
                                    <!-- <th>#</th> -->
                                    <th>เอกสารเลขที่</th>
                                    <th>วันที่</th>                                        
                                    <th>รหัสลูกค้า</th>                              
                                    <th>ชื่อบริษัท</th>
                                    <th>ยอดรวม</th>
                                    <th>พนักงาน</th>
                                    <th>สถานะ</th>
                                    <th>รหัส IV</th>
                                    <!-- <th>Tax Type Id</th> -->
                                    <!-- <th>Remark</th>
                                    <th>Total Before Vat</th>
                                    <th>Vat</th>
                                    <th>Vat Percent</th> -->
                                    <!-- <th>Revision</th> -->
                                    <!-- <th>Actions</th> -->
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($returninvoice as $item)
                                <tr>
                                    <!-- <td>{{ $loop->iteration }}</td> -->
                                    <td>
                                        <a class="" href="{{ url('/sales/return-invoice/' . $item->id . '') }}" title="Edit ReturnInvoice">
                                            {{ $item->code }}
                                        </a>
                                    </td>
                                    <td>{{ date_format(date_create(explode(" ",$item->created_at)[0] ), "d-m-Y") }}</td>
                                    <td>{{ $item->customer->customer_code }}</td>
                                    <td>{{ $item->customer->company_name }}</td>
                                    <td>{{ number_format($item->total_after_vat,2) }}</td>
                                    <td>{{ $item->staff->short_name }}</td>
                                    <td>
                                        @switch($item->sales_status_id)
                                            @case("-1")
                                                <span class="badge badge-pill badge-secondary">Void</span>
                                                @break
                                            @default
                                                <span class="badge badge-pill badge-success">Yes</span>								
                                                @break
                                        @endswitch
                                    </td>

                                    <td>{{ $item->invoice_code }}</td>
                                    <!-- <td>{{ $item->tax_type_id }}</td> -->
                                    <!-- <td>{{ $item->remark }}</td>
                                    <td>{{ $item->total_before_vat }}</td>
                                    <td>{{ $item->vat }}</td>
                                    <td>{{ $item->vat_percent }}</td> -->
                                    <!-- <td>{{ $item->revision }}</td> -->
                                    <!-- <td>
                                        <a href="{{ url('/sales/return-invoice/' . $item->id) }}" title="View ReturnInvoice"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                        <a href="{{ url('/sales/return-invoice/' . $item->id . '/edit') }}" title="Edit ReturnInvoice"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                                        <form method="POST" action="{{ url('/sales/return-invoice' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                            {{ method_field('DELETE') }}
                                            {{ csrf_field() }}
                                            <button type="submit" class="btn btn-danger btn-sm" title="Delete ReturnInvoice" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                        </form>
                                    </td> -->
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        
                    </div>

                    <div class="mt-4 text-center">
                        <a class="btn btn-outline-success " href="{{ url('sales') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> back</a>
                        <a href="{{ url('/sales/return-invoice/create') }}" class="btn btn-success " title="Add New ReturnInvoice">
                            <i class="fa fa-plus" aria-hidden="true"></i> เพิ่มใบรับคืนสินค้า
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<script>
document.addEventListener("DOMContentLoaded", function(event) {
    
    $('#table').DataTable({
        paging : false ,
        info : false,
        order : [ 0, 'desc' ],
    });
    //DATA TABLE SCROLL
    var tableCont = document.querySelector('#table');			
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
}); //END CONTENT LOADED

</script>
@endsection
