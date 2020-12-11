@extends('layouts/argon-dashboard/theme')

@include('bank-transaction/lib')

@php
$main = getTransactionCode(request('transaction_code'));   
@endphp

@section('level-0-url', url('finance')."?tab=bank-tab")
@section('level-0','การเงินธนาคาร')

@section('title',$main)

@section('background-tag','bg-info ')

@section('content')
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <!-- <div class="card-header">ธุรกรรมธนาคาร ({{ request('transaction_code') }})</div> -->
                    <div class="card-body">
                        <!-- <a href="{{ url('/finance') }}?tab=bank-tab" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/finance/bank-transaction/create') }}?transaction_code={{ request('transaction_code') }}" class="btn btn-success btn-sm" title="Add New BankTransaction">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>

                        <form method="GET" action="{{ url('/finance/bank-transaction') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
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
                                        <th>#</th>
                                        <th>วันที่</th>
                                        <th>รหัสธนาคาร</th>
                                        <th>ประเภทธุรกรรม</th>
                                        <th>จำนวน</th>
                                        <th>คงเหลือ</th>
                                        <th>พนักงานผู้บันทึก</th>
                                        <!-- <th>Actions</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($banktransaction as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->created_at }}</td>
                                        <td>{{ $item->bank_account->code }}</td>
                                        <td>{{ getTransactionCode($item->transaction_code) }}</td>
                                        <td>{{ $item->amount }}</td>
                                        <td>{{ $item->balance }}</td>
                                        <td>{{ $item->user->short_name }}</td>
                                        <!-- <td>
                                            <a href="{{ url('/finance/bank-transaction/' . $item->id) }}" title="View BankTransaction"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                            <a href="{{ url('/finance/bank-transaction/' . $item->id . '/edit') }}" title="Edit BankTransaction"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                                            <form method="POST" action="{{ url('/finance/bank-transaction' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete BankTransaction" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                            </form>
                                        </td> -->
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            
                        </div>
                        <div class="text-center mt-4">
                            <a href="{{ url('/finance/bank-transaction/create') }}?transaction_code={{ request('transaction_code') }}" class="btn btn-success" title="Add New BankTransaction">
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
            order : [1, 'desc']  
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
