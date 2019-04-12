@extends('layout.layout')
@section('content')
<form method="post" class="form-horizontal" role="form" novalidate="novalidate">
{{ csrf_field() }}
<div class="col-md-12 col-sm-12">
    <div class="form-group">
        <label class="col-md-2 control-label">Tài khoản</label>
        <div class="col-md-10 col-sm-12">
            <input name="email" id="email" type="email" value="{{ isset($email) ? $email : '' }}" class="form-control valid" data-val="true" data-val-email="Email không hợp lệ" data-val-required="Vui lòng nhập email" aria-invalid="false">
            <span class="text-danger field-validation-valid" data-valmsg-for="email" data-valmsg-replace="true"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 col-sm-12 control-label">Mật khẩu</label>
        <div class="col-md-10 col-sm-12">
            <input name="password" id="password" type="password" value="{{ isset($password) ? $password : '' }}" class="form-control valid" data-val="true" data-val-required="Vui lòng nhập mật khẩu" aria-describedby="Password-error" aria-invalid="false">
            <span class="text-danger field-validation-valid" data-valmsg-for="password" data-valmsg-replace="true"></span>
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-offset-2 col-md-10">
            <input type="submit" value="Đăng nhập" class="btn btn-default">
        </div>
    </div>
</div>
</form>
@endsection