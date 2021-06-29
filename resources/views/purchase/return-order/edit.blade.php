@extends('layouts/argon-dashboard/theme')

@section('level-0-url', url('purchase'))
@section('level-0', 'การซื้อ')

@section('level-1-url', url('purchase/return-order'))
@section('level-1', 'ใบส่งคืนสินค้า')

    @if ($mode == 'edit')
        @section('level-2-url', url('purchase/return-order/' . $returnorder->id))
        @section('level-2', 'รายละเอียด')
        @endif


        @section('title', $mode == 'edit' ? 'แก้ไข' : 'รายละเอียด')

        @section('background-tag', 'bg-success')

        @section('content')
            <div class="container">
                <div class="row">

                    <div class="col-md-12">
                        <div class="">

                            @if ($errors->any())
                                <ul class="alert alert-danger">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            @endif
                            <form class="d-none" action="{{ url('/purchase/return-order/' . $returnorder->id) }}/cancel"
                                id="form-cancel" method="POST" onsubmit="return confirm('Do you confirm to void?')">
                                {{ csrf_field() }}
                                {{ method_field('PATCH') }}
                                <button type="submit" class="btn btn-success " id="form-cancel-submit"
                                    style="width:150px;">Save</button>
                            </form>
                            <form class="d-none" action="{{ url('/') }}/purchase/return-order/{{ $returnorder->id }}/approve"
                                id="form-approve" method="POST" onsubmit="return confirm('ต้องการอนุมัติ ใบส่งสินค้าคืน ?')">
                                {{ csrf_field() }}
                                {{ method_field('PUT') }}
                                <button type="submit" class="btn btn-success " id="form-approve-submit"
                                    style="width:150px;">Save</button>
                            </form>
                            <form method="POST" action="{{ url('/purchase/return-order/' . $returnorder->id) }}"
                                accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                                {{ method_field('PATCH') }}
                                {{ csrf_field() }}

                                @include ('purchase.return-order.form', ['formMode' => 'edit'])

                            </form>

                        </div>
                    </div>
                </div>
            </div>
        @endsection
