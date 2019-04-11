<?php
$title = 'Trang tin tức';
?>
@extends('layout.layout')
@section('content')
<div class="col-md-12 col-sm-12 row">
    @foreach($categories as $category)
    <div class="col-md-12 col-sm-12 row">
        <div class="col-md-12 col-sm-12 row ADT-row-color ADT-cate-color">
            <label>{{ $category->Name }}</label>
        </div>
        @if($category->Newses != null)
        <div class="col-md-8 col-sm-6" style="padding: 10px; border-right: solid 1px #C3C3C3">
            <a href="/newsweb/news/{{ $category->Newses[0]->id }}" style="width: 100%">
                <div class="col-md-4 col-sm-6 ">
                    <img class="img-news-detail" src="/newsweb/storage/app/{{ $category->Newses[0]->Image }}">
                </div>
                <div class="col-md-8 col-sm-6 row">
                    <div class="col-md-12 col-sm-12 row text-title-news" style="height: 50px; line-height: 50px; overflow: hidden; font-size: 30px;">
                        {{ $category->Newses[0]->Title }}
                    </div>
                    <div class="col-md-12 col-sm-12 row text-decription-news" style="height: 130px; margin-bottom: 0px;">
                        {{ $category->Newses[0]->Decription }}
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-4 col-sm-6" style="overflow-y: auto; overflow-x: hidden;">
            <?php $count = count($category->Newses); ?>
            @for($i = 1; $i < $count; $i++)
            <a href="/newsweb/news/{{$category->Newses[$i]->id}}">
            <div class="col-md-12 col-sm-12 row">
                <div class="col-md-6 col-sm-7">
                    <img style="height: 100px; width: 100%;" src="/newsweb/storage/app/{{ $category->Newses[$i]->Image }}" />
                </div>
                <div class="col-md-6 col-sm-5">
                    {{ $category->Newses[$i]->Title }}
                </div>
            </div>
            </a>
            @endfor
        </div>
        @endif
    </div>
    @endforeach
</div>
@endsection