@extends('layout.master')
@section('title','经典星空')
@section('description','经典星空，蕴藏无尽语录，记载璀璨人生，一字一句皆经典，一分沉吟传天下，泽被后世永流传...')
@section('keywords','经典 星空 无尽 语录 璀璨 人生 字 句 沉吟 天下 流传 后世')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/demo.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/font-awesome.min.css') }}" />
    <!--必要样式-->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/component.css') }}">
    <script type="text/javascript" src="{{ asset('js/modernizr.custom.js') }}"></script>
@endsection
@section('container')
    <div id="grid-gallery" class="grid-gallery">
        <section class="grid-wrap">
            <ul class="grid" style="position: relative;">
                <li class="grid-sizer" style="position: absolute; left: 0px; top: 0px;"></li><!-- for Masonry column width -->
                @foreach($cards as $k=>$item)
                <li style="position: absolute; left: {{ $k*268 }}px; top: 0px;">
                    <figure>
                        <figcaption>
                            <h3>@if($item->like_count >= 100)<span class="red">经典</span>@endif语录——<span class="weibai">{{ $item->name }}</span></h3>
                            <p>{{ str_limit($item->content,50) }}</p>
                        </figcaption>
                    </figure>
                </li>
                @endforeach
            </ul>
        </section><!-- // grid-wrap -->
        <section class="slideshow">
            <ul>
                @foreach($cards as $k=>$item)
                <li>
                    <figure>
                        <div class="info-top">
                            <h3> @if($item->like_count >= 100)<span class="blue">经典永流传</span> @endif <a class="like layui-btn layui-btn-warm" style="cursor: pointer;" data-id="{{ $item->id }}" data-like="{{ $item->like_count }}">为Ta点赞（{{ $item->like_count }}）</a> <button class="sendmsg layui-btn layui-btn-normal" style="cursor: pointer;" data-userid="{{ $item->user_id }}" data-username="{{ $item->name }}">私信Ta</button></h3>
                        </div>
                        <figcaption>
                            <p>{{ $item->content }}</p>
                        </figcaption>
                        <div class="info-bottom">
                            <p>——{{ $item->name }}</p>
                        </div>
                        <br/>
                        <input type="hidden" id="touser" value="">
                        {{--<img src="/img/1(1).png" alt="img{{ $k }}">--}}
                    </figure>
                </li>
                @endforeach
            </ul>
            <nav>
                <span class="icon nav-prev"></span>
                <span class="icon nav-next"></span>
                <span class="icon nav-close"></span>
            </nav>
            <div class="info-keys icon">Navigate with arrow keys</div>
        </section><!-- // slideshow -->
    </div><!-- // grid-gallery -->
@endsection
@section('js')
    <script type="text/javascript" src="{{ asset('js/imagesloaded.pkgd.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/masonry.pkgd.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/classie.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/cbpGridGallery.js') }}"></script>
    <script type="text/javascript">
        new CBPGridGallery(document.getElementById('grid-gallery'));
    </script>
    <script src="{{ asset('js/layer.js') }}"></script>
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $("#grid-gallery").on("click",".like",function(){
            var id=$(this).attr('data-id');
            var like_count = parseInt($(this).attr('data-like'));
            var like_count_a = parseInt($(this).attr('data-like'))+1;
            var obj = $(this);
            obj.html('为Ta点赞（'+parseInt(like_count_a)+'）');
            $.ajax({
                url:'/card/like',
                type:'post',
                data:'card_id='+id,
                async : true, //默认为true 异步
                error:function(){
                    //alert('error');
                },
                success:function(data){
                    data = JSON.parse(data);
                    layer.msg(data.msg);
                    if(data.status != 1){
                        obj.html('为Ta点赞（'+parseInt(like_count)+'）');
                    }
                }
            });
        });


        $("#grid-gallery").on("click",".sendmsg",function(){
            var docW = window.screen.width;
            if(docW < 1920){
                var layerW = '80%';
                var layerH = '70%';
            }else{
                var layerW = '500px';
                var layerH = '500px';
            }
            var id=$(this).attr('data-userid');
            $("#touser").val(id);
            var name = $(this).attr('data-username');
            //iframe窗
            layer.open({
                type: 2,
                title: false,
                closeBtn: 0, //不显示关闭按钮
                shade: [0],
                area: ['40px', '30px'],
                offset: 'rb', //右下角弹出
                time: 2000, //2秒后自动关闭
                anim: 2,
                content: ['/msg/add', 'no'], //iframe的url，no代表不显示滚动条
                end: function(){ //此处用于演示
                    layer.open({
                        type: 2,
                        title: '私信：'+name,
                        shadeClose: true,
                        shade: false,
                        maxmin: true, //开启最大化最小化按钮
                        area: [layerW, layerH],
                        content: '/msg/add'
                    });
                }
            });
        });

    </script>
@endsection
