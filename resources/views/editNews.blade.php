<?php
$title = "Sửa bài báo";
?>
@extends('layout.layout')
@section('content')
@if($news != null)
<div class="col-md-12">
    <h3 class="col-md-12" style="text-align: center">{{$title}}</h3>
    <hr>
    <form action="{{ route('editNews') }}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <input name="id" type="hidden" value="{{$news->id}}">
        <input name='img_old' type="hidden" value="{{$news->Image}}">
        <div class="col-md-12">
            <div class="col-md-12">
                <label class="col-md-2 control-label">Tiêu đề</label>
                <div class="col-md-10 form-group">
                    <input id="title" name="title" type="text" class="form-control" data-val="true" data-val-required="Vui lòng nhập tiêu đề" value="{{ isset($news) ? $news->Title : ''}}">
                    <span class="text-danger field-validation-valid" data-valmsg-for="title" data-valmsg-replace="true"></span>
                </div>
            </div>
            <div class="col-md-12">
                <label class="col-md-2 control-label">Tóm tắt</label>
                <div class="col-md-10 form-group">
                    <input id="decription" name="decription" type="text" class="form-control" data-val="true" data-val-required="Vui lòng nhập tiêu đề" value="{{ isset($news) ? $news->Decription : ''}}">
                    <span class="text-danger field-validation-valid" data-valmsg-for="decription" data-valmsg-replace="true"></span>
                </div>
            </div>
            <div class="col-md-12">
                <label class="col-md-2 control-label">Loại tin tức</label>
                <div class="col-md-10 form-group">
                    <select id="category" name="category" class="form-control" style="text-align: center" data-val="true" data-val-required="Vui lòng chọn loại tin tức">
                        <option value="" selected>--Loại tin--</option>
                        @foreach($categories as $category)
                        @if(isset($news) && $news->CateId == $category->id)
                        <option value="{{$category->id}}" selected>{{ $category->Name }}</option>
                        @else
                        <option value="{{$category->id}}">{{ $category->Name }}</option>
                        @endif
                        @endforeach
                    </select>
                    <span class="text-danger field-validation-valid" data-valmsg-for="category" data-valmsg-replace="true"></span>
                </div>
            </div>
            <div class="col-md-12">
                <label class="col-md-2 control-label">Ảnh đại diện</label>
                <div class="col-md-10 form-group">
                    <input id="image" name="image" type="file" accept=".jpg, .jpeg, .png, .bmp, .gif">
                </div>
            </div>
            <div class="col-md-12">
                <label class="col-md-12 control-label">Nội dung bài viết</label>
                <div class="col-md-12">
                    <textarea id="content" name="content" data-val="true" data-val-required="Vui lòng nhập nội dung bài viết" minlength="1">{{ isset($news) ? $news->Content : '' }}</textarea>
                </div>
                <div class="col-md-12">
                    <span class="text-danger field-validation-valid" data-valmsg-for="content" data-valmsg-replace="true">{{ isset($error) ? $error : '' }}</span>
                </div>
            </div>
            <div class="col-md-12" style="text-align: center; padding: 10px;">
                <div class="col-md-3">
                    <button class="btn btn-primary">Sửa bài viết</button>
                </div>
                <div class="col-md-3">
                    <a class="btn btn-default" href="{{ route('admin') }}">Quay lại<a>
                </div>
            </div>
        </div>
    </form>
</div>
<div>
    <script src="{{route('home')}}/public/ckeditor/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('content');
    </script>
</div>
@else
<div class="col-md-12" style="text-align: center;">
    <label style="font-size: 48px">Không tìm thấy bài viết</label>
    <br>
    <a href="{{route('admin')}}">Quay lại</a>
</div>
@endif
@endsection