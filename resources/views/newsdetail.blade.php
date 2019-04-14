<?php
$title = $news->Title;
?>
@extends('layout.layout')
@section('content')
<div class="col-md-12 col-sm-12 row">
    <div class="col-md-12 col-sm-12 row">
        <div class="col-md-12 col-sm-12 row">
            <h3 class="text-title-news">{{ $news->Title }}</h3>
        </div>
        <hr />
        <div class="col-md-12 col-sm-12 row" style="border-bottom: solid 1px #C3C3C3">
            <div class="col-md-3 col-sm-8 row text-date-news">{{ $news->CreateAt }}</div>
        </div>
        <div class="col-md-12 col-sm-12 row">
            <h4 class="text-decription-news" style="font-size: 20px; text-align: justify;">{{ $news->Decription }}</h4>
        </div>
        <div class="col-md-12 col-sm-12 row text-content-news img-content" style="font-size: 20px; text-align: justify;">
            {!! $news->Content !!}
        </div>
    </div>
    <div class="col-md-12" style="padding: 0px ;width: 100%; height: 100;">
        <hr />
    </div>
    <div class="col-md-12 col-sm-12">
        <!-- <div class="col-md-offset-1 col-md-11 col-sm-12">
            
        </div> -->
        <div class="fb-like" data-href="{{route('newsdetail', ['id' => $news->id])}}" data-layout="standard" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>
        <!-- <div class="col-md-12 col-sm-12"> -->
            <!-- <span class="fb-comments-count"></span> Bình luận -->
            <div class="fb-comments" data-numposts="10" data-width="100%"></div>
        <!-- </div> -->
        </div>

    </div>
    <div class="col-md-12 col-sm-12 row">
        <label class="col-md-12 col-sm-12 row" style="background-color: #7a7a7a; color: white;">
            Tin tức liên quan
        </label>
        <div class="col-md-12 col-sm-12 row">
            @foreach($newses as $n)
            <div class="col-md-3 col-sm-6">
                <div class="thumbnail block-dis thumbnail-custom">
                    <a href="{{route('newsdetail',['id' => $n->id])}}" class="ADT-a-tag">
                        <div style="width: 100%;">
                            <img class="img-news-detail" style="border-radius: 4px" src="{{route('home')}}/storage/app/{{ $n->Image }}">
                        </div>
                        <div class="col-md-12 col-sm-12 row">
                            <label class="text-title-rel-news">{{ $n->Title }}<label>
                        </div>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <!-- <div>
        <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v3.2"></script>
        <script src="/newsweb/public/js/facebook.js"></script>
    </div> -->
    @endsection