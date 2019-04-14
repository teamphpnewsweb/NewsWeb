@extends('layout.layout')

@section('content')
@if(isset($pagrams['CreateNews']) && $pagrams['CreateNews'])
<div class="col-md-12">
    <a href="{{ route('createNews') }}">Thêm bài viết</a>
</div>
<!-- Bài viết chưa xét duyệt -->
<div class="col-md-12">
    <div class="col-md-12">
        <label class="col-md-12 col-sm-12">Bài viết chưa xét duyệt</label>
        <div style="width: 100%; max-height: 250px; overflow: auto">
        <table style="width: 100%;">
            <tr class="ADT-row-color">
                <th style="width: 100px; text-align: center">
                    STT
                </th>
                <th style="text-align: center">
                    Bài viết
                </th>
                <th style="text-align: center">
                    Tóm tắt
                </th>
                <th style="width: 10%">

                </th>
            </tr>
            @foreach($pagrams['NewsesWaiting'] as $news)
            <tr {!! $loop->index % 2 == 0 ? '' : 'style="background-color: #D8D8D8"' !!}>
                <td style="text-align: center">
                    {{ $loop->index + 1 }}
                </td>
                <td style="padding: 10px; text-align: justify">
                    {{ $news->Title }}
                </td>
                <td style="padding: 10px; text-align: justify">
                    {{ $news->Decription}}
                </td>
                <td style="text-align: center">
                    <a href="{{route('editNews')}}/{{$news->id}}">Sửa</a>
                </td>
            </tr>
            @endforeach
        </table>
        </div>
    </div>
</div>
<div class="col-md-12">
<hr>
</div>
<!-- Bài viết đã xét duyệt -->
<div class="col-md-12">
    <div class="col-md-12">
        <label class="col-md-12 col-sm-12">Bài viết đã xét duyệt</label>
        <div style="width: 100%; overflow: auto; max-height: 250px;">
        <table style="width: 100%;">
            <tr class="ADT-row-color">
                <th style="width: 100px; text-align: center;">
                    STT
                </th>
                <th style="text-align: center">
                    Bài viết
                </th>
                <th style="text-align: center">
                    Tóm tắt
                </th>
                <th style="width: 15%; text-align: center">
                    Người xét duyệt
                </th>
                <th style="width: 10%; text-align: center">
                    Kết quả
                </th>
                <th style="width: 10%">
                </th>
            </tr>
            @foreach($pagrams['NewsesApproved'] as $news)
            <tr {!! $loop->index % 2 == 0 ? '' : 'style="background-color: #D8D8D8"' !!}>
                <td style="text-align: center">
                    {{ $loop->index + 1 }}
                </td>
                <td style="padding: 10px; text-align: justify">
                    {{ $news->Title }}
                </td>
                <td style="padding: 10px; text-align: justify">
                    {{ $news->Decription}}
                </td>
                <td style="text-align: center">
                    {{ $news->ApprovedName }}
                </td>
                <td style="text-align: center">
                    {{ $news->Approved ? 'Hợp lệ' : 'Không hợp lệ' }}
                </td>
                <td style="text-align: center">
                    <a href="{{route('reviewNews',['id' => $news->id])}}">Xem chi tiết</a> | 
                    <a href="{{route('editNews')}}/{{$news->id}}">Sửa</a>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
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
<!-- Bài viết chưa xét duyệt -->
<div class="col-md-12">
    <div class="col-md-12" style="max-height: 250px; overflow: auto;">
    <table style="width: 100%;">
            <tr class="ADT-row-color">
                <th style="width: 100px; text-align: center">
                    STT
                </th>
                <th style="text-align: center; width: 20%;">
                    Bài viết
                </th>
                <th style="text-align: center; width: 15%">
                    Người viết
                </th>
                <th style="text-align: center; width: 15%">
                    Thời điểm viết
                </th>
                <th style="text-align: center;">
                    Tóm tắt
                </th>
                <th style="width: 5%">
                </th>
            </tr>
            @foreach($pagrams['approveNewses'] as $news)
            <tr {!! $loop->index % 2 == 0 ? '' : 'style="background-color: #D8D8D8"' !!}>
                <td style="text-align: center">
                    {{ $loop->index + 1 }}
                </td>
                <td style="text-align: justify; padding: 10px;">
                    {{ $news->Title }}
                </td>
                <td style="text-align: center">
                    {{ $news->AdminName }}
                </td>
                <td style="text-align: center">
                    {{ $news->CreateAt }}
                </td>
                <td style="padding: 10px; text-align: justify">
                    {{ $news->Decription}}
                </td>
                <td>
                    <a href="{{route('approveNews',['id' => $news->id])}}">Duyệt</a>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
<div class="col-md-12">
<hr>
</div>
<div class="col-md-12" style="text-align: center">
    <h3>Các bài viết đã duyệt</h3>
</div>
<!-- Bài viết đã xét duyệt -->
<div class="col-md-12">
    <div class="col-md-12" style="max-height: 250px; overflow: auto;">
    <table style="width: 100%;">
            <tr class="ADT-row-color">
                <th style="width: 100px; text-align: center">
                    STT
                </th>
                <th style="width: 20%; text-align: center">
                    Bài viết
                </th>
                <th style="width: 15%; text-align: center">
                    Người viết
                </th>
                <th style="width: 15%; text-align: center;">
                    Thời điểm viết
                </th>
                <th style="text-align: center">
                    Tóm tắt
                </th>
                <th style="width: 10%; text-align: center">
                    Kết quả
                </th>
                <th>
                    
                </th>
            </tr>
            @foreach($pagrams['ApprovedNewses'] as $news)
            <tr {!! $loop->index % 2 == 0 ? '' : 'style="background-color: #D8D8D8"' !!}>
                <td style="text-align: center;">
                    {{ $loop->index + 1 }}
                </td>
                <td style="padding: 10px; text-align: justify">
                    {{ $news->Title }}
                </td>
                <td style="text-align: center">
                    {{ $news->AdminName }}
                </td>
                <td style="text-align: center;">
                    {{ $news->CreateAt }}
                </td>
                <td style="padding: 10px; text-align: justify">
                    {{ $news->Decription}}
                </td>
                <td style="text-align: center">
                    {{$news->Approved ? 'Hợp lệ' : 'Không hợp lệ'}}
                </td>
                <td>
                <a href="{{route('approveNews',['id' => $news->id])}}">Duyệt lại</a>
                </td>
            </tr>
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
    <div class="col-md-12" style="max-height: 550px; overflow: auto;">
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
            <tr {!! $loop->index % 2 == 0 ? '' : 'style="background-color: #D8D8D8"' !!}>
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
            @endforeach
        </table>
    </div>
</div>
@endif
@endsection