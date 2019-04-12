<?php
    $title = "Tạo bài báo";
?>
@extends('layout.layout')
@section('content')
<div class="col-md-12">
    <h3 class="col-md-12" style="text-align: center">{{$title}}</h3>
    <hr>
    <form method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
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
                    <input id="decription" name="decription" type="text" class="form-control" data-val="true" data-val-required="Vui lòng nhập tiêu đề" value="{{ isset($news) ? $news->Title : ''}}">
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
                    <input id="image" name="image" type="file" accept=".jpg, .jpeg, .png, .bmp" data-val="true" data-val-required="Vui lòng chọn một ảnh đại diện">
                    <span class="text-danger field-validation-valid" data-valmsg-for="image" data-valmsg-replace="true"></span>
                </div>
            </div>
            <div class="col-md-12">
                <label class="col-md-12 control-label">Nội dung bài viết</label>
                <div class="col-md-12">
                    <textarea id="content" name="content" data-val="true" data-val-required="Vui lòng nhập nội dung bài viết" minlength="1">{{ isset($news) ? $news->Content : '' }}</textarea>
                </div>
                <div class="col-md-12">
                    <span class="text-danger field-validation-valid" data-valmsg-for="content" data-valmsg-replace="true"></span>
                </div>
            </div>
            <div class="col-md-12" style="text-align: center; padding: 10px;">
                <button class="btn btn-success">Tạo bài viết</button>
            </div>
        </div>
    </form>
    <div>
        <script src="{{route('home')}}/public/ckeditor/ckeditor.js"></script>
        <script>
            CKEDITOR.replace('content');
        </script>
    </div>
    @endsection