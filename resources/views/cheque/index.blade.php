@extends('layouts/argon-dashboard/theme')
@php
    $main = request('cheque_type_code');
    switch($main){
        case "cheque-in" : 
            $main = "ทะเบียนเช็ครับ";
            break;              
        case "cheque-out" : 
            $main = "ทะเบียนเช็คจ่าย";
            break;        
        case "" : 
            $main = "ทั้งหมด";
            break;        
    }
@endphp

@section('level-0-url', url('finance')."?tab=cheque-tab")
@section('level-0','การเงินเช็ค')

@section('title', $main )

@section('background-tag','bg-info ')

@section('content')
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <!-- <div class="card-header">@yield('title')</div> -->
                    <div class="card-body">
                        <!-- <a href="{{ url('/finance') }}?tab=cheque-tab" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>                        
                        <a href="{{ url('/finance/cheque/create') }}?cheque_type_code={{request('cheque_type_code')}}" class="btn btn-success btn-sm" title="Add New Cheque">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>

                        <form method="GET" action="{{ url('/finance/cheque') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
                            <div class="input-group input-group-sm">
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
                                        <!-- <th class="d-none">Cheque Type</th> -->
                                        <th>วันที่ออกเช็ค</th>
                                        <th>เลขที่เช็ค</th>
                                        <th>ยอดเงิน</th>
                                        
                                        <th>บัญชีธนาคาร</th>
                                        <th>สถานะ</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($cheque as $item)
                                    <tr>
                                        <!-- <td class="d-none">{{ $item->cheque_type_code }}</td>                                  -->
                                        <td>{{ $item->cheque_date }}</td>
                                        <td>{{ $item->cheque_no }}</td>       
                                        <td>{{ $item->total }}</td>   
                                        <td>{{ $item->bank_account->name }} {{ $item->bank_account->branch }}</td>
                                        <td>{{ $item->status }}</td>

                                        
                                        <td>
                                            @if($item->status =="pending")
                                            <form method="POST" action="{{ url('/finance/cheque/' . $item->id) }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data" style="display:inline">
                                                {{ method_field('PATCH') }}
                                                {{ csrf_field() }}
                                                <input type="hidden" name="status" value="success">
                                                <input type="hidden" name="cheque_type_code" value="{{ request('cheque_type_code') }}">
                                                
                                                <button class="btn btn-success btn-sm">ผ่านเช็ค</button>
                                            </form>
                                            <form method="POST" action="{{ url('/finance/cheque/' . $item->id) }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data" style="display:inline">
                                                {{ method_field('PATCH') }}
                                                {{ csrf_field() }}
                                                <input type="hidden" name="status" value="fail">
                                                <input type="hidden" name="cheque_type_code" value="{{ request('cheque_type_code') }}">
                                                <button class="btn btn-warning btn-sm">ยกเลิกเช็ค</button>
                                            </form>
                                            
                                            @endif
                                        </td>
                                        
                                        <!-- <td class="d-none">
                                            <a href="{{ url('/finance/cheque/' . $item->id) }}" title="View Cheque"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                            <a href="{{ url('/finance/cheque/' . $item->id . '/edit') }}" title="Edit Cheque"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                                            <form method="POST" action="{{ url('/finance/cheque' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete Cheque" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                            </form>
                                        </td> -->
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="text-center mt-4">
                            <a href="{{ url('/finance/cheque/create') }}?cheque_type_code={{request('cheque_type_code')}}" class="btn btn-success" title="Add New Cheque">
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
