@extends('layouts/argon-dashboard/theme')
<!-- start nav -->
@section('level-0-url', url('sales'))
@section('level-0', 'การขาย')

@section('title', 'ใบจอง')

@section('background-tag', 'bg-warning')

@section('navbar-menu', '')


@section('breadcrumb-menu', '')


@section('content')

    <div class="card">
        <div class="card-body">
            <div class="mb-4  d-none">
                <a href="{{ url('/sales') }}" title="Back" class="btn btn-warning btn-sm">
                    <i class="fa fa-arrow-left" aria-hidden="true"></i> Back
                </a>
            </div>

            <div class="table-responsive">
                <table class="table table-sm table-hover text-center  table-bordered table-striped " id="table">
                    <thead>
                        <tr>
                            <th class="text-center">เลขที่เอกสาร</th>
                            <th class="text-center">วันที่</th>
                            <th class="text-center">รหัสลูกค้า</th>
                            <th class="text-center">ชื่อบริษัท</th>
                            <th class="text-center">ยอดรวม</th>
                            <th class="text-center">พนักงาน</th>
                            <th class="text-center">สถานะ</th>
                            <th class="text-center d-none">รายละเอียด</th>
                            <th class="text-center d-none">action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($table_order as $row)

                            <tr>
                                <td>
                                    <a href="{{ url('/') }}/sales/order/{{ $row->order_id }}">
                                        {{ $row->order_code }}
                                    </a>
                                </td>
                                <td>
                                    {{ date_format(date_create(explode(' ', $row->datetime)[0]), 'd-m-Y') }}
                                </td>
                                <td>{{ $row->customer_code }}</td>
                                <td><a href2="{{ url('customer') }}/{{ $row->customer_id }}/edit"
                                        target="_blank">{{ $row->company_name }}</a></td>
                                <td class="text-right">{{ number_format($row->total, 2) }}</td>
                                <td><a href2="{{ url('user') }}/{{ $row->user_id }}"
                                        target="_blank">{{ $row->short_name }}</a></td>
                                <td>
                                    @switch($row->sales_status_id)
                                        @case(6)
                                            <span class="badge badge-pill badge-danger">Draft</span>
                                        @break
                                        @case(7)
                                            <span class="badge badge-pill badge-warning">รอเบิกสินค้า</span>
                                        @break
                                        @case(8)
                                        @case(9)
                                            @php
                                                $a = [];
                                                $sum = 0;
                                                $count = 0;
                                                $is_picking = false;
                                                foreach ($row->order_details as $p) {
                                                    if ($p->amount > 0) {
                                                        $a[] = $p->order_detail_status_id;
                                                        $sum += $p->order_detail_status_id;
                                                        $count++;
                                                        if ($p->order_detail_status_id == 1) {
                                                            //PICKING
                                                            $is_picking = true;
                                                        }
                                                    }
                                                }
                                                //echo $count;
                                            @endphp
                                            @if ($is_picking)
                                                <span class="badge badge-pill badge-primary">รอเปิด Invoice</span>
                                            @elseif($count == 0)
                                                <span class="badge badge-pill badge-secondary">Void</span>
                                            @elseif( $sum/$count == 4 )
                                                <span class="badge badge-pill badge-success">Invoice ครบแล้ว</span>
                                            @else
                                                <span class="badge badge-pill badge-warning">รอเบิกสินค้า</span>
                                                <a class="btn btn-sm btn-warning d-none" href="#"
                                                    href2="{{ url('/') }}/sales/order_detail?order_id={{ $row->order_code }}">
                                                    รอการเบิกสินค้า
                                                </a>
                                            @endif

                                        @break
                                    @case(-1)
                                        <span class="badge badge-pill badge-secondary">Void</span>
                                    @break
                                    @default
                                        <span class="badge badge-pill badge-success">Invoice ครบแล้ว</span>
                                    @break
                                    {{-- $row->sales_status_name --}}
                                @endswitch

                            </td>
                            <td class="text-left  d-none">
                                @foreach ($row->order_details as $order_detail)
                                    @switch($order_detail->order_detail_status_id)
                                        @case(1)
                                            <span class="badge badge-pill badge-primary" title="รอเบิกสินค้า">Y</span>
                                        @break
                                        @case(3)
                                            <span class="badge badge-pill badge-warning" title="รอเปิด Invoice">W</span>
                                        @break
                                        @case(4)
                                            <span class="badge badge-pill badge-success" title="Invoice แล้ว">IV</span>
                                        @break
                                    @endswitch
                                @endforeach

                            </td>
                            <td class="d-none">
                                <a href="javascript:void(0)" onclick="onDelete( {{ $row->order_id }} )"
                                    class="text-danger">
                                    <span class="fa fa-trash"></span>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>

        <div class="text-center mt-4">
            <a class="btn btn-outline-success " href="{{ url('/') }}/sales"><i class="fa fa-arrow-left"
                    aria-hidden="true"></i> back</a>
            <a href="{{ url('/') }}/sales/order/create" class="btn btn-success">
                <i class="fa fa-plus"></i> เพิ่มใบจอง
            </a>

        </div>
        <script>
            document.addEventListener("DOMContentLoaded", function(event) {
                $('#table').DataTable({
                    "paging": false,
                    "info": false,
                }).order([0, 'desc']).draw();
                //DATA TABLE SCROLL
                var tableCont = document.querySelector('#table');
                tableCont.style.cssText = "margin-top : -1px !important; width:100%;";
                tableCont.parentNode.style.overflow = 'auto';
                tableCont.parentNode.style.maxHeight = '400px';
                tableCont.parentNode.addEventListener('scroll', function(e) {
                    var scrollTop = this.scrollTop;
                    this.querySelector('thead').style.transform = 'translateY(' + scrollTop + 'px) ' +
                        'translateZ(' + 1000 + 'px)';
                    this.querySelector('thead').style.background = "white";
                    this.querySelector('thead').style.zIndex = "3000";
                    //this.querySelector('thead').style.marginBottom = "200px";
                    console.log(scrollTop);
                })
                //tableCont.parentNode.dispatchEvent(new Event('scroll'));
                //END DATA TABLE SCROLL
            });

        </script>

    </div>
</div>

<div id="outer-form-container" style="display:none;">
    <form action="#" method="POST" id="form_delete">
        {{ csrf_field() }}
        {{ method_field('DELETE') }}
        <button type="submit">Delete</button>
    </form>
    <script>
        function onEdit() {
            console.log("edit", $('#myModal'));
            $('#myModal').on('show');
        }

        function onDelete(id) {
            //--THIS FUNCTION IS USED FOR SUBMIT FORM BY script--//

            //GET FORM BY ID
            var form = document.getElementById("form_delete");
            //CHANGE ACTION TO SPECIFY ID
            form.action = "{{ url('/') }}/sales/order/" + id;
            //SUBMIT
            var want_to_delete = confirm('Are you sure to delete this order ?');
            if (want_to_delete) {
                form.submit();
            }
        }

    </script>
</div>


@endsection
