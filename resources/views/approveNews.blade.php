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
            <div class="col-md-3">Người viết: {{ $news->AdminName }}</div>
            <div class="col-md-offset-3 col-md-3">Loại tin: {{$news->CategoryName}}</div>
        </div>
        <div class="col-md-12 col-sm-12 row">
            <h4 class="text-decription-news" style="font-size: 20px; text-align: justify;">{{ $news->Decription }}</h4>
        </div>
        <div class="col-md-12 col-sm-12 row text-content-news" style="font-size: 20px; text-align: justify;">
            {!! $news->Content !!}
        </div>
        <div class="col-md-12" style="text-align: center; padding: 10px;">
            <form method="post" action="{{route('approveNewsPost')}}">
                {{csrf_field()}}
                <div class="col-md-12">
                    <textarea name="comment">{{ $news->Comment }}</textarea>
                </div>
                <div class="col-md-12">
                    <input type="hidden" name="id" value="{{$news->id}}">
                    <input id="result" name="result" type="hidden" value="false" style="display: none">
                    <input class="btn btn-success" type="submit" value="Duyệt" onclick="check('true')">
                    <input class="btn btn-danger" type="submit" value="Không hợp lệ" onclick="check('false')">
                </div>
            </form>
        </div>
    </div>
</div>
    <script src="{{route('home')}}/public/ckeditor/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('comment');
        function check(result) {
            document.getElementById('result').value = result;
        }
    </script>
    @endsection