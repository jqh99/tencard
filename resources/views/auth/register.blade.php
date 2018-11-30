@extends('layout.master')
@section('title','注册经典星空')
@section('description','经典星空，蕴藏无尽语录，记载璀璨人生，一字一句皆经典，一分沉吟传天下，泽被后世永流传...')
@section('keywords','经典 星空 无尽 语录 璀璨 人生 字 句 沉吟 天下 流传 后世')
@section('css')

@endsection
@section('container')
    <div class="container">
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="login" style="height: 580px;">
            <div class="login-top">
                注册
            </div>

            <form id="loginForm" method="POST" action="/auth/register" onsubmit="fanzhuan();">
                {!! csrf_field() !!}
                <div class="login-center clearfix">
                    <div class="login-center-img"><img src="{{ asset('img/name.png') }}"/></div>
                    <div class="login-center-input">
                        <input type="text" name="username" value="{{ old('username') }}" required="required" placeholder="请输入您的用户名" onfocus="this.placeholder=''" onblur="this.placeholder='请输入您的用户名'"/>
                        <div class="login-center-input-text">用户名</div>
                    </div>
                </div>
                <div class="login-center clearfix">
                    <div class="login-center-img"><img src="{{ asset('img/name.png') }}"/></div>
                    <div class="login-center-input">
                        <input type="text" name="name" value="{{ old('name') }}" required="required" placeholder="请输入您的昵称" onfocus="this.placeholder=''" onblur="this.placeholder='请输入您的昵称'"/>
                        <div class="login-center-input-text">昵称</div>
                    </div>
                </div>
                <div class="login-center clearfix">
                    <div class="login-center-img"><img src="{{ asset('img/password.png') }}"/></div>
                    <div class="login-center-input">
                        <input type="password" name="password" value="" required="required" placeholder="请输入您的密码" onfocus="this.placeholder=''" onblur="this.placeholder='请输入您的密码'"/>
                        <div class="login-center-input-text">密码</div>
                    </div>
                </div>
                <div class="login-center clearfix">
                    <div class="login-center-img"><img src="{{ asset('img/password.png') }}"/></div>
                    <div class="login-center-input">
                        <input type="password" name="password_confirmation"value="" required="required" placeholder="请输入确认密码" onfocus="this.placeholder=''" onblur="this.placeholder='请输入确认密码'"/>
                        <div class="login-center-input-text">确认密码</div>
                    </div>
                </div>
                <div style="text-align: center">
                    <input type="submit" class="login-button" value="注册" />
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
        function fanzhuan() {
                addClass(document.querySelector(".login"), "active")
                setTimeout(function(){
                    addClass(document.querySelector(".sk-rotating-plane"), "active")
                    document.querySelector(".login").style.display = "none"
                },800)
        }
        // document.querySelector(".login-button").onclick = function(){
        //     addClass(document.querySelector(".login"), "active")
        //     document.getElementById('loginForm').submit()
        //     setTimeout(function(){
        //         addClass(document.querySelector(".sk-rotating-plane"), "active")
        //         document.querySelector(".login").style.display = "none"
        //     },800)
            // setTimeout(function(){
            //     removeClass(document.querySelector(".login"), "active")
            //     removeClass(document.querySelector(".sk-rotating-plane"), "active")
            //     document.querySelector(".login").style.display = "block"
            //     // alert("登录成功")
            //
            // },5000)
        // }
    </script>
@endsection
