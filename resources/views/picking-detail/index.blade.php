@extends('layouts/argon-dashboard/theme')

@section('title','Pickingdetail')

@section('content')
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Pickingdetail</div>
                    <div class="card-body">
                        <a href="{{ url('/picking-detail/create') }}" class="btn btn-success btn-sm" title="Add New PickingDetail">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>

                        <form method="GET" action="{{ url('/picking-detail') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
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
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th><th>Product Id</th><th>Amount</th><th>Approved Amount</th><th>Iv Amount</th><th>Before Approved Amount</th><th>Discount Price</th><th>Order Id</th><th>Order Detail Status Id</th><th>Invoice Code</th><th>Danger Price</th><th>Picking Code</th><th>Sale Status Id</th><th>Quotation Code</th><th>Delivery Duration</th><th>Sales Picking Detail Id</th><th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($pickingdetail as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->product_id }}</td><td>{{ $item->amount }}</td><td>{{ $item->approved_amount }}</td><td>{{ $item->iv_amount }}</td><td>{{ $item->before_approved_amount }}</td><td>{{ $item->discount_price }}</td><td>{{ $item->order_id }}</td><td>{{ $item->order_detail_status_id }}</td><td>{{ $item->invoice_code }}</td><td>{{ $item->danger_price }}</td><td>{{ $item->picking_code }}</td><td>{{ $item->sale_status_id }}</td><td>{{ $item->quotation_code }}</td><td>{{ $item->delivery_duration }}</td><td>{{ $item->sales_picking_detail_id }}</td>
                                        <td>
                                            <a href="{{ url('/picking-detail/' . $item->id) }}" title="View PickingDetail"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                            <a href="{{ url('/picking-detail/' . $item->id . '/edit') }}" title="Edit PickingDetail"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                                            <form method="POST" action="{{ url('/picking-detail' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete PickingDetail" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $pickingdetail->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
