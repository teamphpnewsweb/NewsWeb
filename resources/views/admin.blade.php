@extends('layout.layout')

@section('content')
@if(isset($pagrams['CreateNews']) && $pagrams['CreateNews'])
<div class="col-md-12">
    <div class="col-md-3">
        <a href="{{ route('createNews') }}">Thêm bài viết</a>
    </div>
    <div class="col-md-12">
        <table style="width: 100%;">
            <tr class="ADT-row-color">
                <th style="width: 100px">
                    STT
                </th>
                <th>
                    Bài viết
                </th>
                <th>
                    Tóm tắt
                </th>
                <th>

                </th>
            </tr>
            @foreach($pagrams['createdNewses'] as $news)
            @if($loop->index % 2 == 0)
            <tr>
                <td>
                    {{ $loop->index + 1 }}
                </td>
                <td>
                    {{ $news->Title }}
                </td>
                <td>
                    {{ $news->Decription}}
                </td>
                <td>
                    <a>Xem chi tiết</a> | <a>Sửa</a>
                </td>
            </tr>
            @else
            <tr style="background-color: #D8D8D8">
                <td>
                    {{ $loop->index + 1 }}
                </td>
                <td>
                    {{ $news->Title }}
                </td>
                <td>
                    {{ $news->Decription}}
                </td>
            </tr>
            @endif
            @endforeach
        </table>
    </div>
</div>
@endif
@if(isset($pagrams['AppoveNews']) && $pagrams['AppoveNews'])
<div class="col-md-12">
    <a href="{{ route('addcategory') }}">Thêm loại tin</a>
</div>
<div class="col-md-12" style="text-align: center">
    <h3>Các bài viết chưa duyệt</h3>
</div>
<div class="col-md-12">
    <div class="col-md-12">
        <table style="width: 100%;">
            <tr class="ADT-row-color">
                <th style="width: 100px">
                    STT
                </th>
                <th>
                    Bài viết
                </th>
                <th>
                    Người viết
                </th>
                <th>
                    Thời điểm viết
                </th>
                <th>
                    Tóm tắt
                </th>
                <th>
                    
                </th>
            </tr>
            @foreach($pagrams['approveNewses'] as $news)
            @if($loop->index % 2 == 0)
            <tr>
                <td>
                    {{ $loop->index + 1 }}
                </td>
                <td>
                    {{ $news->Title }}
                </td>
                <td>
                    {{ $news->AdminName }}
                </td>
                <td>
                    {{ $news->CreateAt }}
                </td>
                <td>
                    {{ $news->Decription}}
                </td>
                <td>
                    <a href="{{route('approveNews',['id' => $news->id])}}">Duyệt</a>
                </td>
            </tr>
            @else
            <tr style="background-color: #D8D8D8">
                <td>
                    {{ $loop->index + 1 }}
                </td>
                <td>
                    {{ $news->Title }}
                </td>
                <td>
                    {{ $news->Decription}}
                </td>
            </tr>
            @endif
            @endforeach
        </table>
    </div>
</div>
@endif
@if(isset($pagrams['CreateAdmin']) && $pagrams['CreateAdmin'])
<div class="col-md-12">
    <div class="col-md-3">
        <a href="{{ route('createAdmin') }}">Thên nhân viên</a>
    </div>
    <div class="col-md-12">
        <table style="width: 100%;">
            <tr class="ADT-row-color">
                <th style="width: 100px">
                    STT
                </th>
                <th>
                    Email
                </th>
                <th>
                    Họ và tên
                </th>
                <th>

                </th>
            </tr>
            @foreach($pagrams['createdAdmin'] as $admin)
            @if($loop->index % 2 == 0)
            <tr>
                <td>
                    {{ $loop->index + 1 }}
                </td>
                <td>
                    {{ $admin->Email }}
                </td>
                <td>
                    {{ $admin->FullName}}
                </td>
                <td>
                    <a>Xem chi tiết</a> | <a>Sửa</a>
                </td>
            </tr>
            @else
            <tr style="background-color: #D8D8D8">
                <td>
                    {{ $loop->index + 1 }}
                </td>
                <td>
                    {{ $admin->Email }}
                </td>
                <td>
                    {{ $admin->FullName}}
                </td>
                <td>
                    <a>Xem chi tiết</a> | <a>Sửa</a>
                </td>
            </tr>
            @endif
            @endforeach
        </table>
    </div>
</div>
@endif
@endsection