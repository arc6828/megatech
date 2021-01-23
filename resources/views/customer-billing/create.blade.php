@extends('layouts/argon-dashboard/theme')

@section('level-0-url', url('finance')."?tab=debtor-tab")
@section('level-0','การเงิน')

@section('level-1-url', url('finance/customer-billing'))
@section('level-1','ใบวางบิล')

@section('title',  'สร้าง'  )

@section('background-tag','bg-info ')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <!-- <div class="card mb-4"> -->
                    <!-- <div class="card-header">@yield('title')</div> -->
                    <!-- <div class="card-body"> -->
                        <!-- <a href="{{ url('/finance/customer-billing') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />
                        <br /> -->

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                        <script>
                            function validateCheckbox(){
                                checked = $("input[type=checkbox]:checked").length;
                                var clean = true;
                                if(checked == 0) {
                                    alert("กรุณาเลือกอย่างน้อย 1 รายการ");
                                    clean = false;
                                }
                                return clean;
                            }

                        </script>

                        <form method="POST" action="{{ url('/finance/customer-billing') }}?end_date={{ request('end_date') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data" onsubmit="return validateCheckbox();">
                            {{ csrf_field() }}



                            @include ('customer-billing.form', ['formMode' => 'create'])

                            

                        </form>

                    <!-- </div>
                </div> -->
                
                
            </div>
        </div>
    </div>
@endsection
