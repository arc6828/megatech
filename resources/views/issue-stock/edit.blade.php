@extends('layouts/argon-dashboard/theme')

@section('level-0-url', url('inventory'))
@section('level-0','คงคลัง')

@section('level-1-url', url('issue-stock'))
@section('level-1','เบิกของไปผลิต')

@if( $mode == "edit" )
  @section('level-2-url', url('issue-stock/'.$issuestock->id ))
  @section('level-2','รายละเอียด')
@endif


@section('title', $mode == "edit" ? 'แก้ไข' : 'รายละเอียด')

@section('background-tag','bg-yellow')

@section('content')
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-12">
                <!-- <div class="card">
                    <div class="card-header">Edit IssueStock #{{ $issuestock->id }}</div>
                    <div class="card-body">
                        <a href="{{ url('/issue-stock') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />
                        <br /> -->

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        <form method="POST" action="{{ url('/issue-stock/' . $issuestock->id) }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            {{ csrf_field() }}

                            @include ('issue-stock.form', ['formMode' => 'edit'])

                        </form>

                    <!-- </div>
                </div> -->
            </div>
        </div>
    </div>
@endsection
