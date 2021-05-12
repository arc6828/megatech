@extends('layouts/argon-dashboard/theme')

@section('title', 'อื่นๆ')

@section('breadcrumb-menu')
    <a href="{{ url('/') }}/activity/create" class="hide btn pull-right hidden-sm-down btn-success">
        <i class="fa fa-plus"></i> New Activity
    </a>
@endsection

@section('content')
    <div class="card">
        <div class="card-block">
            <div class="row text-center">
                <div class="col-6 col-md-4 ">
                    <a class="btn btn-outline-primary my-3" href="{{ url('/') }}/">
                        <div class="px-4"><span class="round round-primary my-2">ร</span></i></div>
                        <div><br>เริ่มระบบ</div>
                    </a>
                </div>
                <div class="col-6 col-md-4 ">
                    <a class="btn btn-outline-primary my-3" href="{{ url('/') }}/">
                        <div class="px-4"><span class="round round-primary my-2">ก</span></div>
                        <div>กำหนดรหัส<br>ผ่านระบบ</div>
                    </a>
                </div>
                <div class="col-6 col-md-4 ">
                    <a class="btn btn-outline-primary my-3" href="#">
                        <div class="px-4"><span class="round round-primary my-2">ข</span></i></div>
                        <div>กราฟ / ข้อมูล<br>ผู้บริหาร</div>
                    </a>
                </div>
                <div class="col-6 col-md-4 ">
                    <a class="btn btn-outline-primary my-3" href="#">
                        <div class="px-4"><span class="round round-primary my-2">ส</span></i></div>
                        <div>สำรอง<br>แฟ้มข้อมูล</div>
                    </a>
                </div>
                <div class="col-6 col-md-4 ">
                    <a class="btn btn-outline-primary my-3" href="#">
                        <div class="px-4"><span class="round round-primary my-2">ด</span></div>
                        <div>ดึงสำรอง<br>แฟ้มข้อมูล</div>
                    </a>
                </div>
                <div class="col-6 col-md-4 ">
                    <a class="btn btn-outline-primary my-3" href="{{ url('/') }}/">
                        <div class="px-4"><span class="round round-primary my-2">ป</span></div>
                        <div>ปิดรายการ<br>สิ้นปี</div>
                    </a>
                </div>
                <div class="col-6 col-md-4 ">
                    <a class="btn btn-outline-primary my-3" href="{{ url('/') }}/">
                        <div class="px-4"><span class="round round-primary my-2">ส</span></div>
                        <div>สร้าง / <br>ออกแบบฟอร์ม</div>
                    </a>
                </div>
                <div class="col-6 col-md-4 ">
                    <a class="btn btn-outline-primary my-3" href="{{ url('/') }}/">
                        <div class="px-4"><span class="round round-primary my-2">ค</span></div>
                        <div>คำนวณ<br>ต้นทุน</div>
                    </a>
                </div>
                <div class="col-6 col-md-4 ">
                    <a class="btn btn-outline-primary my-3" href="{{ url('/') }}/">
                        <div class="px-4"><span class="round round-primary my-2">ก</span></div>
                        <div>กระทบ<br>ตัวเลขใหม่</div>
                    </a>
                </div>
                <div class="col-6 col-md-4 ">
                    <a class="btn btn-outline-primary my-3" href="{{ url('/company') }}/">
                        <div class="px-4"><span class="round round-primary my-2">บ</span></div>
                        <div>ข้อมูลบริษัท<br></div>
                    </a>
                </div>
                <div class="col-6 col-md-4 ">
                    <a class="btn btn-outline-primary my-3" href="{{ url('/numberun') }}/">
                        <div class="px-4"><span class="round round-primary my-2">ต</span></div>
                        <div>ตั้งค่าเลขรันเอกสาร<br></div>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
