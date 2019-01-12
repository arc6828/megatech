@extends('monster-lite/layouts/theme')

@section('title','ตั้งหนี้/ลูกหนี้')

@section('navbar-menu')
<div style="margin:21px;">
	<a href="{{ url('/') }}/finance/settle/create" class="btn pull-right hidden-sm-down btn-success btn-sm">
		<i class="fa fa-plus"></i> เพิ่มลูกค้า
	</a>
<div>
@endsection

@section('content')


@endsection