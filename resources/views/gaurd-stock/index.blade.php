@extends('layouts/argon-dashboard/theme')

@section('content')
    <div class="container">
        <div class="row  justify-content-center">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Gaurdstock</div>
                    <div class="card-body">
                        <a href="{{ url('/gaurd-stock/create') }}" class="btn btn-success btn-sm" title="Add New GaurdStock">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>

                        <form method="GET" action="{{ url('/gaurd-stock') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
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
                                        <th>#</th>
                                        <th>Product Id</th>
                                        <th>Code</th><th>Amount</th><th>Stock</th><th>ค้างรับ</th><th>ค้างส่ง</th><th>Remark</th><th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($gaurdstock as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td><a href="{{ url('/') }}/product/{{ $item->product_id }}/edit">{{ $item->product->product_code }}</a></td>
                                        <td>
                                            @switch($item->type)
                                                @case("sales_order")
                                                    <a href="{{ url('/') }}/sales/order/{{ $item->sales_order->order_id }}/edit">{{ $item->sales_order->order_code }}</a>
                                                    @break
                                                @case("sales_invoice")
                                                    <a href="{{ url('/') }}/product/{{ $item->product_id }}/edit">{{ $item->product->product_code }}</a>
                                                    @break
                                                @case("purchase_order")
                                                    <a href="{{ url('/') }}/product/{{ $item->product_id }}/edit">{{ $item->product->product_code }}</a>
                                                    @break
                                                @case("purchase_recieve")
                                                    <a href="{{ url('/') }}/product/{{ $item->product_id }}/edit">{{ $item->product->product_code }}</a>
                                                    @break
                                            @endswitch
                                        </td>
                                        <td>{{ $item->amount }}</td><td>{{ $item->amount_in_stock }}</td><td>{{ $item->pending_in }}</td><td>{{ $item->pending_out }}</td><td>{{ $item->remark }}</td>
                                        <td>
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
                            <div class="pagination-wrapper"> {!! $gaurdstock->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
