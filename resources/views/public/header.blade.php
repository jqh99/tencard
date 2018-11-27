<div class="head">
        <a href="/">经典星空</a>
    @if(request()->user())
        欢迎,{{ request()->user()->name }}
        <a href="/card/list">我之经典</a>
        <a href="/auth/logout">退出</a>

    @else
        <a href="/auth/register">注册</a>
        <a href="/auth/login">登录</a>
    @endif
</div>
