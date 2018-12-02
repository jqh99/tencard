@extends('layout.master')
@section('title','经典星空')
@section('description','经典星空，蕴藏无尽语录，记载璀璨人生，一字一句皆经典，一分沉吟传天下，泽被后世永流传...')
@section('keywords','经典 星空 无尽 语录 璀璨 人生 字 句 沉吟 天下 流传 后世')
@section('css')
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

            </ul>
        </section><!-- // grid-wrap -->
        <section class="slideshow">
            <input type="hidden" id="touser" value="">
            <ul>

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

        var page = 0;//分页页码
        $(function () {
            page = 1;
            ajaxRead();
        });
        $(window).bind('scroll', function () {//监控滚动条 到最底部时请求数据
            if ($(document).scrollTop() == $(document).height() - $(window).height()-5) {
                page++;
                ajaxRead();
            }
        });

        //请求数据
        function ajaxRead() {
            var html = "";
            var html_slide = "";
            var url = "/index/getlist";
            var data = {'p': page,'size':12};
            var index;
            $.ajax({
                type: 'post',
                dataType: 'json',
                url: url,
                data: data,
                beforeSend: function () {
                    //loading层
                    index = layer.load(1, {
                        shade: [0.1, '#fff'], //0.1透明度的白色背景
                        time:500
                    });
                },
                success: function (data) {
                    layer.close(index);
                    // data =JSON.parse(data);
                    if (data.status == 0) {
                        layer.msg(data.msg,{time:500});
                    } else {
                        $.each(data.data, function (i, item) {
                            //遍历传来的数据 拼接html
                            // html += '<li style="position: absolute; left: '+ i*268 +'px; top: 0px;">';
                            html += '<li style="">';
                            html += '<figure>';
                            html += '<figcaption>';
                            html += '<h3>';
                            if(item.like_count >= 100){
                                html += '<span class="red">经典</span>';
                            }
                            html += '语录——<span class="weibai">'+item.name+'</span></h3>';
                            html += '<p>'+item.short_content+'</p>';
                            html += '</figcaption>';
                            html += '</figure>';
                            html += '</li>';
                            html_slide += '<li>';
                            html_slide += '<figure>';
                            html_slide += '<div class="info-top">';
                            html_slide += '<h3>';
                            if(item.like_count >= 100){
                                html_slide += '<span class="blue">经典永流传</span> ';
                            }
                            html_slide += '<a class="like layui-btn layui-btn-warm" style="cursor: pointer;" data-id="'+item.id+'" data-like="'+item.like_count+'">为Ta点赞（'+item.like_count+'）</a> <button class="sendmsg layui-btn layui-btn-normal" style="cursor: pointer;" data-userid="'+item.user_id+'" data-username="'+item.name+'">私信Ta</button></h3>';
                            html_slide += '</div>';
                            html_slide += '<figcaption>';
                            html_slide += '<p>'+item.content+'</p>';
                            html_slide += '</figcaption>';
                            html_slide += '<div class="info-bottom">';
                            html_slide += '<p>——'+item.name+'</p>';
                            html_slide += '</div>';
                            html_slide += '<br/>';
                            html_slide += '</figure>';
                            html_slide += '</li>';
                        });
                        $("ul.grid").append($(html));//写入页面
                        $(".slideshow ul").append($(html_slide));//写入页面
                        new CBPGridGallery(document.getElementById('grid-gallery'));
                    }
                },
            });
        }
    </script>
@endsection
