@extends('layouts/argon-dashboard/theme')

@section('title','PickingDetail '.$pickingdetail->id)

@section('content')
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">PickingDetail {{ $pickingdetail->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/picking-detail') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/picking-detail/' . $pickingdetail->id . '/edit') }}" title="Edit PickingDetail"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('pickingdetail' . '/' . $pickingdetail->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete PickingDetail" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $pickingdetail->id }}</td>
                                    </tr>
                                    <tr><th> Product Id </th><td> {{ $pickingdetail->product_id }} </td></tr><tr><th> Amount </th><td> {{ $pickingdetail->amount }} </td></tr><tr><th> Approved Amount </th><td> {{ $pickingdetail->approved_amount }} </td></tr><tr><th> Iv Amount </th><td> {{ $pickingdetail->iv_amount }} </td></tr><tr><th> Before Approved Amount </th><td> {{ $pickingdetail->before_approved_amount }} </td></tr><tr><th> Discount Price </th><td> {{ $pickingdetail->discount_price }} </td></tr><tr><th> Order Id </th><td> {{ $pickingdetail->order_id }} </td></tr><tr><th> Order Code </th><td> {{ $pickingdetail->order_code }} </td></tr><tr><th> Order Detail Status Id </th><td> {{ $pickingdetail->order_detail_status_id }} </td></tr><tr><th> Invoice Code </th><td> {{ $pickingdetail->invoice_code }} </td></tr><tr><th> Danger Price </th><td> {{ $pickingdetail->danger_price }} </td></tr><tr><th> Picking Code </th><td> {{ $pickingdetail->picking_code }} </td></tr><tr><th> Sale Status Id </th><td> {{ $pickingdetail->sale_status_id }} </td></tr><tr><th> Quotation Code </th><td> {{ $pickingdetail->quotation_code }} </td></tr><tr><th> Delivery Duration </th><td> {{ $pickingdetail->delivery_duration }} </td></tr><tr><th> Sales Picking Detail Id </th><td> {{ $pickingdetail->sales_picking_detail_id }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
