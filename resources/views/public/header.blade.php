<div class="head">
    @if(request()->user())
        <a href="/auth/logout">退出</a>
        <span> | </span>
        <span>{{ request()->user()->name }}</span>


    @else
        <a href="/auth/login">登录</a>
        <span> | </span>
        <a href="/auth/register">注册</a>

    @endif

</div>
<div class="nav">
    <ul>
        <li>
            <a href="/" @if(request()->path() == '/') class="actived" @endif>经典星空</a>
        </li>
        <li>
            <a href="/card/list" @if(strstr(request()->path(), 'card/list') || strstr(request()->path(), 'card/add')) class="actived" @endif>我的经典</a>
        </li>
        <li>
            <a href="/msg/list" @if(strstr(request()->path(), 'msg/list') || strstr(request()->path(), 'msg/detail')) class="actived" @endif>我的私信</a>
        </li>
        <li>
            <a href="/about" @if(strstr(request()->path(), 'about')) class="actived" @endif>关于</a>
        </li>
    </ul>
    <img src="/img/more_black.jpg" />
</div>
