<?php
$title = $category->Name;
?>
@extends('layout.layout')
@section('content')
<div class="col-md-12 col-sm-12 row img-content">
    <div class="col-md-12 col-sm-12 row ADT-row-color">
        <label>{{ $category->Name }}</label>
    </div>
    <div class="col-md-12 col-sm-12">
        @foreach($category->Newses as $news)
        <div class="col-md-12 col-sm-12 row " style="padding: 10px">
            <div class=" col-md-12 col-sm-12 thumbnail" style="display: block; margin: 5px;">
                <a class="ADT-a-tag" href="{{route('newsdetail',['id' => $news->id])}}">
                <div class="col-md-4 col-sm-6" style="text-align: center">
                    <img style="height: 200px" src="{{route('home')}}/storage/app/{{ $news->Image }}">
                </div>
                <div class="col-md-8 col-sm-6">
                    <div class="col-md-12 col-sm-12 row">
                        <h4 style="height: 50px; line-height: 25px; overflow: hidden; color: black">{{ $news->Title }}</h4>
                    </div>
                    <div class="col-md-12 col-sm-12 row" style="max-height: 100px; line-height: 25px; overflow: hidden; color: black;">
                        {{ $news->Decription }}
                    </div>
                </div>
                </a>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection