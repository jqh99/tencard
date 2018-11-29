@extends('layout.master')
@section('title','登录经典星空')
@section('description','经典星空，蕴藏无尽语录，记载璀璨人生，一字一句皆经典，一分沉吟传天下，泽被后世永流传...')
@section('keywords','经典 星空 无尽 语录 璀璨 人生 字 句 沉吟 天下 流传 后世')
@section('css')
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet" type="text/css" media="all">
@endsection
@section('container')
    <div class="container">
        <div class="login">
        <div class="login-top">
            登录
        </div>
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        <form id="loginForm" method="POST" action="/auth/login">
            {!! csrf_field() !!}
        <div class="login-center clearfix">
            <div class="login-center-img"><img src="{{ asset('img/name.png') }}"/></div>
            <div class="login-center-input">
                <input type="text" name="username" value="{{ old('username') }}" placeholder="请输入您的用户名" onfocus="this.placeholder=''" onblur="this.placeholder='请输入您的用户名'"/>
                <div class="login-center-input-text">用户名</div>
            </div>
        </div>
        <div class="login-center clearfix">
            <div class="login-center-img"><img src="{{ asset('img/password.png') }}"/></div>
            <div class="login-center-input">
                <input type="password" name="password" value="" placeholder="请输入您的密码" onfocus="this.placeholder=''" onblur="this.placeholder='请输入您的密码'"/>
                <div class="login-center-input-text">密码</div>
            </div>
        </div>
        <div style="text-align: center">
            <button type="submit" class="login-button">登录</button>
        </div>
        </form>
    </div>
    </div>
    <div class="sk-rotating-plane"></div>
@endsection
@section('js')
    <script type="text/javascript">
        function hasClass(elem, cls) {
            cls = cls || '';
            if (cls.replace(/\s/g, '').length == 0) return false; //当cls没有参数时，返回false
            return new RegExp(' ' + cls + ' ').test(' ' + elem.className + ' ');
        }

        function addClass(ele, cls) {
            if (!hasClass(ele, cls)) {
                ele.className = ele.className == '' ? cls : ele.className + ' ' + cls;
            }
        }

        function removeClass(ele, cls) {
            if (hasClass(ele, cls)) {
                var newClass = ' ' + ele.className.replace(/[\t\r\n]/g, '') + ' ';
                while (newClass.indexOf(' ' + cls + ' ') >= 0) {
                    newClass = newClass.replace(' ' + cls + ' ', ' ');
                }
                ele.className = newClass.replace(/^\s+|\s+$/g, '');
            }
        }
        document.querySelector(".login-button").onclick = function(){
            addClass(document.querySelector(".login"), "active")
            document.getElementById('loginForm').submit()
            setTimeout(function(){
                addClass(document.querySelector(".sk-rotating-plane"), "active")
                document.querySelector(".login").style.display = "none"
            },800)
            // setTimeout(function(){
            //     removeClass(document.querySelector(".login"), "active")
            //     removeClass(document.querySelector(".sk-rotating-plane"), "active")
            //     document.querySelector(".login").style.display = "block"
            //     // alert("登录成功")
            //
            // },5000)
        }
    </script>
@endsection
