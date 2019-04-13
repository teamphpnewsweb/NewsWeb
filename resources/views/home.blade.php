<?php
$title = 'Trang tin tức';
?>
@extends('layout.layout')
@section('content')
<div class="col-md-12 col-sm-12 row">
    @foreach($categories as $category)
    <div class="col-md-12 col-sm-12 row">
        <div class="col-md-12 col-sm-12 row ADT-row-color ADT-cate-color">
            <a class="ADT-a-tag" href="{{route('category',['id' => $category->id])}}">{{ $category->Name }}</a>
        </div>
        @if($category->Newses != null)
        <div class="col-md-8 col-sm-6" style="padding: 10px; border-right: solid 1px #C3C3C3">
            <a href="{{route('newsdetail',['id' => $category->Newses[0]->id])}}" style="width: 100%">
                <div class="col-md-4 col-sm-6 ">
                    <img class="img-news-detail" src="{{route('home')}}/storage/app/{{ $category->Newses[0]->Image }}">
                </div>
                <div class="col-md-8 col-sm-6 row">
                    <div class="col-md-12 col-sm-12 row text-title-news" style="height: 60px;
                                                                                line-height: 30px;
                                                                                overflow: hidden;
                                                                                font-size: 25px;">
                        {{ $category->Newses[0]->Title }}
                    </div>
                    <div class="col-md-12 col-sm-12 row text-decription-news" style="height: 120px;
                                                                                    line-height: 20px;
                                                                                    margin-bottom: 0px;
                                                                                    overflow: hidden;
                                                                                    color: gray;">
                        {{ $category->Newses[0]->Decription }}
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-4 col-sm-6" style="height: 200px;overflow-y: auto; overflow-x: hidden;">
            <?php $count = count($category->Newses); ?>
            @for($i = 1; $i < $count; $i++)
            <div class="col-md-12 col-sm-12 row thumbnail" style="margin: 5px;
                                                                                                padding: 5px;">
                <a style="font-size: 16px;" href="{{route('newsdetail', ['id' => $category->Newses[$i]->id])}}">
                    <div class="col-md-12 col-sm-12 row">
                        <div class="col-md-6 col-sm-7">
                            <img style="height: 100px; width: 100%;" src="{{route('home')}}/storage/app/{{ $category->Newses[$i]->Image }}" />
                        </div>
                        <div class="col-md-6 col-sm-5">
                            <div class="col-md-12 col-sm-12">
                                {{ $category->Newses[$i]->Title }}
                            </div>
                        </div>
                    </div>
                </a>
        </div>
        @endfor
        </div>
    </div>
    @endif
</div>
@endforeach
</div>
@endsection