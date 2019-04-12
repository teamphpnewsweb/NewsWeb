<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{route('home')}}/public/css/bootstrap.css" rel="stylesheet">
    <link href="{{route('home')}}/public/css/site.css" rel="stylesheet">
    <link href="{{route('home')}}/public/css/ADT_site.css" rel="stylesheet">
    
    <title>{{ isset($title) ? $title : 'Web site tin tức' }}</title>
</head>
<body style="margin-top: 10px;">
    <div class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
            @if(session('admin') != null)
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                @endif
                <a class="navbar-brand" href="{{route('home')}}">News</a>
            </div>
            <div class="navbar-collapse collapse">
                @if(session('admin') != null)
                    <ul class="nav navbar-nav">
                        <li><a href="{{route('admin')}}">Quản lý</a></li>
                    </ul>
                @endif
                <ul class="nav navbar-nav navbar-right">
                @if(session('admin') != null) 
                        <li><a id="customerLink">{{ 'Xin chào ' . session('admin')->FullName }}</a></li>
                        <li><a href="{{route('logout')}}" id="logoutLink">Đăng xuất</a></li>
                    @endif
                </ul>
            </div>
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
        <script src="{{route('home')}}/public/js/jquery-3.3.1.js"></script>
        <script src="{{route('home')}}/public/js/bootstrap.js"></script>
        <script src="{{route('home')}}/public/js/jquery.validate.js"></script>
        <script src="{{route('home')}}/public/js/jquery.validate.unobtrusive.js"></script>
        <script src="{{route('home')}}/public/js/card.js"></script>
    </div>
</body>
</html>