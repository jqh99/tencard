@extends('layout.master')
@section('title','关于经典星空')
@section('description','经典星空，蕴藏无尽语录，记载璀璨人生，一字一句皆经典，一分沉吟传天下，泽被后世永流传...')
@section('keywords','关于 规则 介绍 经典 星空 无尽 语录 璀璨 人生 字 句 沉吟 天下 流传 后世')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/demo.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/font-awesome.min.css') }}" />
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet" type="text/css" media="all">
    <!--必要样式-->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/component.css') }}">
    <script type="text/javascript" src="{{ asset('js/modernizr.custom.js') }}"></script>
@endsection
@section('container')
   <div class="container about">
       <h3>关于——</h3>
       <p>1、星空经典网，是一个简单的文字分享和交流网站，功能简单且完全免费。</p>
       <p>2、目前所有功能包括，注册，登录，私信，回信，创我经典，点赞经典。</p>
       <p>3、经典在精不在多，所以每个用户，最多只能同时展现十大经典语录。</p>
       <p>4、星空经典网，主在用文字，用心，交流，需要的是沉淀。所以，私信功能极为简单，若觉得沟通不便，可互留联系方式，使用其它沟通工具或渠道。</p>
       <p>5、星空经典网，希望能成为互联网中，即便不伟大也要有些个性的一员。为此，小生衷心希望，所有成为星空经典网的用户，都能真正听着自己的心，一字一句，创造出永恒的经典。</p>
       <p>6、世界太大，人生苦短，终究难以经历所有精彩和不精彩。所以，您可以在此，稍稍品尝一下众多经典。若能让您稍有余味，小生心中便觉喜悦。</p>
       <p>7、世界在变，人生在变，经典也可能随之而变。所以，您不用担心，您的经典不经典。不经典，未尝不是一种永恒的经典。</p>
       <p>8、待续...</p>
   </div>
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
