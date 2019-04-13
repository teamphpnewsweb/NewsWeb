@extends('layout.layout')
@section('content')
<div class="col-md-12">
    <div class="col-md-12">
        <form method="post">
            {{ csrf_field()}}
        <label class="col-md-2 control-label">Tên loại tin</label>
        <div class="col-md-10">
                <input id="name" name="name" data-val="true" data-val-required="Vui lòng nhập tên loại tin">
                <span class="text-danger field-validation-valid" data-valmsg-for="name" data-valmsg-replace="true"></span>
        </div>
        <div class="col-md-12" style="text-align: center; padding: 5px;">
            <input type="submit" value="Tạo loại tin" class="btn btn-success"/>
        </div>
        </form>
    </div>
</div>
@endsection