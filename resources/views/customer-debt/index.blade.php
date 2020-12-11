@extends('layouts/argon-dashboard/theme')
@php
    $main = request('type_debt');
    switch($main){
        case "XR" : 
            $main = "ตั้งหนี้คงค้าง";
            break;              
        case "AP" : 
            $main = "ตั้งหนี้ลูกหนี้";
            break;              
        case "DP" : 
            $main = "ลดหนี้ลูกหนี้";
            break;         
    }
@endphp

@section('level-0-url', url('finance')."?tab=debtor-tab")
@section('level-0','การเงิน-'.$main)

@section('title', $main )
@section('background-tag','bg-info ')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <!-- <div class="card-header"> {{ request('type_debt') }} </div> -->
                    <div class="card-body">
                        <!-- <a href="{{ url('/finance') }}?tab=debtor-tab" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                       
                        <a href="{{ url('/finance/customer-debt/create') }}?type_debt={{ request('type_debt') }}" class="btn btn-success btn-sm" title="Add New CustomerDebt">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a> -->

                        <!-- <form method="GET" action="{{ url('/finance/customer-debt') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
                            <div class="input-group input-group-sm">
                                <input type="text" class="form-control " name="search" placeholder="Search..." value="{{ request('search') }}">
                                <span class="input-group-append">
                                    <button class="btn btn-secondary " type="submit">
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
                                        <th>เลขที่เอกสาร</th>
                                        <th>วันที่เอกสาร</th>
                                        <th>รหัสลูกค้า</th>
                                        <th>ชื่อลูกค้า</th>
                                        <th>ยอดสุทธิ</th>
                                        <th>ยอดหนี้คงเหลือ</th>
                                        
                                        <th class="d-none">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($customerdebt as $item)
                                    <tr>
                                        <td>
                                            <a href="{{ url('/finance/customer-debt/' . $item->id) }}">{{ $item->doc_no }}</a>
                                        </td>
                                        <td>{{ $item->date }}</td>
                                        <td>
                                            {{ isset($item->customer_id) ? $item->customer->customer_code :'' }}
                                        </td>
                                        <td>
                                            {{ isset($item->customer_id) ? $item->customer->company_name :'' }}
                                        </td>
                                        <td>{{ number_format($item->total,2) }}</td>
                                        <td>{{number_format($item->total_debt,2)}}</td>
                                        <td class="d-none">
                                            <a href="{{ url('/finance/customer-debt/' . $item->id) }}" title="View CustomerDebt"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                            <a href="{{ url('/finance/customer-debt/' . $item->id . '/edit') }}" title="Edit CustomerDebt"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                                            <form method="POST" action="{{ url('/finance/customer-debt' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete CustomerDebt" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="text-center mt-4">
                            <a href="{{ url('/finance/customer-debt/create') }}?type_debt={{ request('type_debt') }}" class="btn btn-success btn-sm" title="Add New CustomerDebt">
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
