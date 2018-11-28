<div class="head">
    @if(request()->user())
        欢迎,{{ request()->user()->name }}
        <a href="/auth/logout">退出</a>

    @else
        <a href="/auth/register">注册</a>
        <a href="/auth/login">登录</a>
    @endif

</div>
<div class="nav">
    <ul>
        <li>
            <a href="/" class="actived">经典星空</a>
        </li>
        <li>
            <a href="/card/list">我的经典</a>
        </li>
        <li>
            <a href="/msg/list">我的私信</a>
        </li>
    </ul>
    <img src="/img/more_black.jpg" />
</div>
