<?php
$title = 'Duyệt - ' . $news->Title;
?>
@extends('layout.layout')
@section('content')
<div class="col-md-12 col-sm-12 row img-content">
    <div class="col-md-12 col-sm-12 row">
        <div class="col-md-12 col-sm-12 row">
            <div class="col-md-12 col-sm-10">
                <div class="col-md-3">
                    <img class="col-md-12" src="{{route('home')}}/storage/app/{{$news->Image}}">
                </div>
                <h3 class="col-md-9 text-title-news">{{ $news->Title }}</h3>
            </div>
        </div>
        <hr />
        <div class="col-md-12 col-sm-12 row" style="border-bottom: solid 1px #C3C3C3">
            <div class="col-md-3 col-sm-8 row text-date-news">Ngày viết: {{ $news->CreateAt }}</div>
            <div class="col-md-offset-6 col-md-3">Loại tin: {{$news->CategoryName}}</div>
        </div>
        <div class="col-md-12 col-sm-12 row">
            <h4 class="text-decription-news" style="font-size: 20px; text-align: justify;">{{ $news->Decription }}</h4>
        </div>
        <div class="col-md-12 col-sm-12 row text-content-news" style="font-size: 20px; text-align: justify;">
            {!! $news->Content !!}
        </div>
        <div class="col-md-12">
            <hr>
        </div>
        <div class="col-md-12" style="text-align: center; padding: 10px;">
            <div class="col-md-12" style="font-size: 36px; font-weight: bold">
                Ghi chú
            </div>
            <div class="col-md-12" style="text-align: initial">
                {!! $news->Comment !!}
            </div>
            <div class="col-md-12">
                <hr>
            </div>
            <div class="col-md-12" style="padding: 10px; text-align: center;">
                <a class="btn btn-primary" href="{{route('editNews')}}/{{$news->id}}">Sửa</a>
                <a class="col-md-offset-1 btn btn-default" href="{{route('admin')}}">Quay lại</a>
            </div>
        </div>
    </div>
</div>
@endsection