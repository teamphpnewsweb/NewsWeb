<?php
$title = "Tạo nhân viên";
?>
@extends('layout.layout')
@section('content')
<div class="col-md-12">
    <h3 class="col-md-12" style="text-align: center">{{$title}}</h3>
    <div class="col-md-12">
        <div class="col-md-12">
            <form method="post">
                {{csrf_field()}}
                <div class="col-md-12">
                    <div class="col-md-12">
                        <label class="col-md-2 control-label">Họ và tên</label>
                        <div class="col-md-10 form-group">
                            <input class="form-control" type="text" id="fullName" name="fullName" data-val="true" data-val-required="Vui lòng nhập họ và tên">
                            <span class="text-danger field-validation-valid" data-valmsg-for="fullName" data-valmsg-replace="true"></span>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label class="col-md-2 control-label">Vị trí</label>
                        <div class="col-md-10 form-group">
                            <select class="form-control" name="role" id="role" data-val="true" data-val-required="Vui lòng chọn chức vụ">
                                <option value="" selected>--Vị trí--</option>
                                @foreach($roles as $role)
                                    @if(isset($admin) && $admin->Role->id == $role->id)
                                        <option value="{{ $role->id }}" selected>{{ $role->Name }}</option>
                                    @else
                                    <option value="{{ $role->id }}">{{ $role->Name }}</option>
                                    @endif
                                @endforeach
                            </select>
                            <span class="text-danger field-validation-valid" data-valmsg-for="role" data-valmsg-replace="true"></span>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label class="col-md-2 control-label">Email</label>
                        <div class="col-md-10 form-group">
                            <input class="form-control" type="email" id="email" name="email" data-val-required="Vui lòng nhập email" data-val="true">
                            <span class="text-danger field-validation-valid" data-valmsg-for="email" data-valmsg-replace="true"></span>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label class="col-md-2 control-label">Mật khẩu</label>
                        <div class="col-md-10 form-group">
                            <input class="form-control" type="password" id="password" name="password" data-val="true" data-val-required="Vui lòng nhập mật khẩu">
                            <span class="text-danger field-validation-valid" data-valmsg-for="password" data-valmsg-replace="true"></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-12" style="text-align: center; padding: 10px;">
                    <button type="submit" class="btn btn-success">Tạo nhân viên</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection