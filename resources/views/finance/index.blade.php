@extends('layouts/argon-dashboard/theme')

@section('title','การเงิน')

@section('breadcrumb-menu')
<a href="{{ url('/') }}/activity/create" class="hide btn pull-right hidden-sm-down btn-success">
  <i class="fa fa-plus"></i> New Activity
</a>
@endsection

@section('content')
<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="debtor-tab" data-toggle="tab" href="#debtor" role="tab" aria-controls="debtor" aria-selected="true">ลูกหนี้</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="creditor-tab" data-toggle="tab" href="#creditor" role="tab" aria-controls="creditor" aria-selected="false">เจ้าหนี้</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="bank-tab" data-toggle="tab" href="#bank" role="tab" aria-controls="bank" aria-selected="false">ธนาคาร</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="cheque-tab" data-toggle="tab" href="#cheque" role="tab" aria-controls="cheque" aria-selected="false">เช็ค</a>
  </li>
</ul>
<div class="tab-content" id="tabContent">
  <div class="tab-pane fade show active" id="debtor" role="tabpanel" aria-labelledby="debtor-tab">
    @include('finance/menu/debtor')
  </div>
  <div class="tab-pane fade" id="creditor" role="tabpanel" aria-labelledby="creditor-tab">
    @include('finance/menu/creditor')
  </div>
  <div class="tab-pane fade" id="bank" role="tabpanel" aria-labelledby="bank-tab">
    @include('finance/menu/bank')
  </div>
  <div class="tab-pane fade" id="cheque" role="tabpanel" aria-labelledby="cheque-tab">
    @include('finance/menu/cheque')
  </div>
</div>
@endsection
@section('script')

<script>
  $(function () {
    $("#{{ request('tab') }}").tab('show')
  })
</script>
@endsection
