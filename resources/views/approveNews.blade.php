<?php
$title = 'Duyệt - '.$news->Title;
?>
@extends('layout.layout')
@section('content')
<div class="col-md-12 col-sm-12 row">
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
        </div>
        <div class="col-md-12 col-sm-12 row">
            <h4 class="text-decription-news">{{ $news->Decription }}</h4>
        </div>
        <div class="col-md-12 col-sm-12 row text-content-news">
            {{ $news->Content }}
        </div>
        <div class="col-md-12" style="text-align: center; padding: 10px;">
            <form method="post" action="{{route('approveNewsPost')}}">
                {{csrf_field()}}
                <input type="hidden" name="id" value="{{$news->id}}">
                <input id="result" name="result" type="hidden" checked style="display: none">
                <input class="btn btn-success" type="submit" value="Duyệt" onclick="check('true')">
                <input class="btn btn-danger" type="submit" value="Không hợp lệ" onclick="check('false')">
            </form>
        </div>
    </div>
    <script>
        check(result) {
            document.getElementById('result').value = result;
        }
    </script>
    @endsection