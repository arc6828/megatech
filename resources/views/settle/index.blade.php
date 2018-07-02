@extends('template/template-1')
@section('content')
<h2 style="text-align: center;">ตั้งหนี้ลูกหนี้</h2>
<div class="container">
	<a href="{{ url('/') }}/settle/create" class="btn btn-primary btn-lg glyphicon glyphicon-plus">
ตั้งหนี้ลูกหนี้
</a>
</div>
@endsection