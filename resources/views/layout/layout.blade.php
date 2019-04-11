<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="/newsweb/public/css/bootstrap.css" rel="stylesheet">
    <link href="/newsweb/public/css/site.css" rel="stylesheet">
    <link href="/newsweb/public/css/ADT_site.css" rel="stylesheet">
    
    <title>{{ isset($title) ? $title : 'Web site tin tức' }}</title>
</head>
<body style="margin-top: 60px;">
    <div class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <!-- <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button> -->
                <a class="navbar-brand" href="/newsweb">News</a>
            </div>
            <!-- <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li><a href="/thlab3">Trang chủ</a></li>
                    <li><a href="/thlab3">Trang chủ</a></li>
                    <li><a href="/thlab3">Trang chủ</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                @if(session('') == null) 
                        <li><a href="/thlab3/customer/register" id="registerLink">Đăng ký</a></li>
                        <li><a href="/thlab3/customer/login" id="loginLink">Đăng nhập</a></li>
                    @else
                        <li><a href="/thlab3/customer/card">Giỏ hàng</a></li>
                        <li><a href="/thlab3/customer/detail" id="customerLink">{{ 'Xin chào ' . session('customer')->FullName }}</a></li>
                        <li><a href="/thlab3/customer/logout" id="logoutLink">Đăng xuất</a></li>
                    @endif
                </ul>
            </div> -->
        </div>
    </div>
    <div class="container body-content">
        @yield('content')
    </div>
    <hr />
        <div class="col-md-12 col-sm-12 row">
            <footer>
            <p>&copy; News website- PHP - 2019</p>
            </footer>
        </div>
    </div>
    <div>
        <script src="/newsweb/public/js/jquery-3.3.1.js"></script>
        <script src="/newsweb/public/js/bootstrap.js"></script>
        <script src="/newsweb/public/js/jquery.validate.js"></script>
        <script src="/newsweb/public/js/jquery.validate.unobtrusive.js"></script>
        <script src="/newsweb/public/js/card.js"></script>
    </div>
</body>
</html>