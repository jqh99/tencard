<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title') - 文字世界，一人一生十经典</title>
    <meta name="description" content="@yield('description')">
    <meta name="keywords" content="@yield('keywords')">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link rel="stylesheet" media="screen" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/reset.css') }}"/>
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
@section('js')

@show
</body>
</html>