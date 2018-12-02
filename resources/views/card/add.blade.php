@extends('layout.master')
@section('title','记录我之经典')
@section('description','经典星空，蕴藏无尽语录，记载璀璨人生，一字一句皆经典，一分沉吟传天下，泽被后世永流传...')
@section('keywords','经典 星空 无尽 语录 璀璨 人生 字 句 沉吟 天下 流传 后世')
@section('css')
    <link rel="stylesheet" media="screen" href="{{ asset('css/stylecard.css') }}">
    <style type="text/css">
        body{background: none;}
    </style>
@endsection
@section('container')
    <div class="container">
        <div class="legend">
            <a class="layui-btn layui-btn-warm" href="javascript:;">创我经典</a>
        </div>
    </div>
    <div class="login-01" style="padding-top: 15px;">
        <form method="post" action="/card/add">
            {!! csrf_field() !!}
            <ul>
                <li class="second">
                    <a href="javascript:;" class=" icon user"></a><textarea name="content"></textarea>
                    <div class="clear"></div>
                </li>
            </ul>
            <input type="submit" value="创建">
            <div class="clear"></div>
        </form>
    </div>
@endsection
@section('js')

@endsection
