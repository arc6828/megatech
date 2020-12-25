@extends('layouts/argon-dashboard/theme')

@section('level-0-url', url('finance')."?tab=debtor-tab")
@section('level-0','การเงิน')

@section('title',  'รับชำระเงิน'  )

@section('background-tag','bg-info ')

@section('content')
    <div class="container-fluid">
        <div class="row"> 
            <div class="col-md-12">
                <div class="card mb-4">
                    <!-- <div class="card-header">@yield('title')</div> -->
                    <div class="card-body">
                        <!-- <a href="{{ url('/finance') }}?tab=debtor-tab" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a> -->
                        
                        

                        <!-- <form method="GET" action="{{ url('/finance/customer-payment') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
                            <div class="input-group input-group-sm">
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
                            <table class="table table-sm table-hover text-center table-bordered table-striped" id="table">
                                <thead>
                                    <tr>
                                        <th>เลขที่เอกสาร</th>
                                        <th>วันที่</th>                                        
                                        <th>รหัสลูกค้า</th>
                                        <th>ลูกค้า</th>
                                        <th>ยอดรวมรับชำระหนี้</th>
                                        <th>สถานะ</th>
                                        <!-- <th>Actions</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($customerpayment as $item)
                                    <tr>
                                        <td>
                                            <a href="{{ url('/finance/customer-payment/' . $item->id) }}" title="รายละเอียด">
                                                {{ $item->doc_no }}
                                            </a>
                                        </td>
                                        <td>{{ $item->created_at }}</td>                                              
                                        <td>{{ $item->customer->customer_code }}</td> 
                                        <td>{{ $item->customer->company_name }}</td>
                                        <td>{{ number_format($item->payment_total,2) }}</td>                             
                                        <td>                                            
                                            <span class="badge badge-pill badge-success">Yes</span>                                                    
                                        </td>
                                        <!-- <td>
                                            <a href="{{ url('/finance/customer-payment/' . $item->id) }}" title="View CustomerPayment"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                            <a href="{{ url('/finance/customer-payment/' . $item->id . '/edit') }}" title="Edit CustomerPayment"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                                            <form method="POST" action="{{ url('/finance/customer-payment' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete CustomerPayment" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                            </form>
                                        </td> -->
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="text-center mt-4">
                            <a href="{{ url('/finance/customer-payment/create') }}" class="btn btn-success " title="Add New CustomerPayment">
                                <i class="fa fa-plus" aria-hidden="true"></i> รับชำระเงิน
                            </a>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
    document.addEventListener("DOMContentLoaded", function(event) {
        var table = $('#table').DataTable({          
            ordering: false,                  
            paging: false,
            info: false,          
            // searching: false,                
        }); //END DataTable
    });
    </script>
@endsection
