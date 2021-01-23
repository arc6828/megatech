@extends('layouts/argon-dashboard/theme')

@section('title','ProductDetail '.$productdetail->id)

@section('content')
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">ProductDetail {{ $productdetail->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/product-detail') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/product-detail/' . $productdetail->id . '/edit') }}" title="Edit ProductDetail"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('productdetail' . '/' . $productdetail->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete ProductDetail" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $productdetail->id }}</td>
                                    </tr>
                                    <tr><th> Final Product Id </th><td> {{ $productdetail->final_product_id }} </td></tr><tr><th> Detail Product Id </th><td> {{ $productdetail->detail_product_id }} </td></tr><tr><th> Amount </th><td> {{ $productdetail->amount }} </td></tr><tr><th> Remark </th><td> {{ $productdetail->remark }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
