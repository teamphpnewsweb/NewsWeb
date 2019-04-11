<?php
$title = $news->Title;
?>
@extends('layout.layout')
@section('content')
<div class="col-md-12 col-sm-12 row">
    <div class="col-md-12 col-sm-12 row">
        <div class="col-md-12 col-sm-12 row">
            <div class="col-md-10 col-sm-10">
                <h3 class="text-title-news">{{ $news->Title }}</h3>
            </div>
            <div class="col-md-2 col-sm-2">
                <div class="fb-like" data-href="http://localhost:1000/newsweb/news/{{ $news->id }}" data-width="50" data-layout="standard" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>
            </div>
        </div>
        <hr />
        <div class="col-md-12 col-sm-12 row" style="border-bottom: solid 1px #C3C3C3">
            <div class="col-md-3 col-sm-8 row text-date-news">{{ $news->CreateAt }}</div>
        </div>
        <div class="col-md-12 col-sm-12 row">
            <h4 class="text-decription-news">{{ $news->Decription }}</h4>
        </div>
        <div class="col-md-12 col-sm-12 row text-content-news">
            {{ $news->Content }}
        </div>
    </div>
    <hr />
    <div class="col-md-12 col-sm-12 row">
        <div id="fb-root">
            <div class="fb-comments" data-href="http://localhost:1000/newsweb/news/{{ $news->id }}" data-numposts="10" data-colorscheme="dark"
            data-width="100%"></div>
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
                    <a href="/newsweb/news/{{ $n->id }}" class="ADT-a-tag">
                        <div class="col-md-12 col-sm-12 row" style="text-align: center">
                            <img class="img-news-detail" src="/newsweb/storage/app/{{ $n->Image }}">
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
    <div>
        <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v3.2"></script>
        <script src="/newsweb/public/js/facebook.js"></script>
    </div>
    @endsection