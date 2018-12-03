<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title') - 文字世界，一人一生十经典</title>
    <meta name="description" content="@yield('description')">
    <meta name="keywords" content="@yield('keywords')">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
    <!--使用 viewport meta 标签在手机浏览器上控制布局-->
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1" />
    <!--通过快捷方式打开时全屏显示-->
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <!--隐藏状态栏-->
    <meta name="apple-mobile-web-app-status-bar-style" content="blank" />
    <!--iPhone会将看起来像电话号码的数字添加电话连接，应当关闭-->
    <meta name="format-detection" content="telephone=no" />
    <link rel="stylesheet" media="screen" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/reset.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('layui/css/layui.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('layui/css/layui.mobile.css') }}" />
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet" type="text/css" media="all">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/demo.css') }}">
    @section('css')
    @show
</head>
<body>
<div id="particles-js">
    @include('public/header')
    @section('container')
    @show
    @include('public/footer')
</div>
<script src="{{ asset('js/particles.min.js') }}"></script>
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script>
    $(function() {
        $(".nav ul li").click(function() {//导航点击
            $(".nav ul li a").removeClass("actived");
            $(this).children("a").addClass("actived");
        });
        $("#particles-js").css('min-height',$(window).height()+'px');
    });
    $(".nav img").click(function() {//显示或隐藏下方导航列表
        $(".nav ul").slideToggle(100);
    });

</script>
@section('js')

@show
</body>
</html>