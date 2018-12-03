@extends('layout.master')
@section('title','我之私信')
@section('description','私信 经典星空，蕴藏无尽语录，记载璀璨人生，一字一句皆经典，一分沉吟传天下，泽被后世永流传...')
@section('keywords','私信 经典 星空 无尽 语录 璀璨 人生 字 句 沉吟 天下 流传 后世')
@section('css')
    <link rel="stylesheet" media="screen" href="{{ asset('css/stylecard.css') }}">
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet" type="text/css" media="all">
    <link rel="stylesheet" type="text/css" href="{{ asset('layui/css/layui.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('layui/css/layui.mobile.css') }}" />
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <!-- Custom Theme files -->
    <link href="{{ asset('css/stylelist.css') }}" rel="stylesheet" type="text/css" media="all">

@endsection
@section('container')
    <div class="container">
        <div class="detail_legend"><button class="sendmsg layui-btn layui-btn-normal"  data-username="{{ $from_user_name }}">回信Ta</button></div>
    </div>
    <!--info-grid start here-->
    <div class="info-grid wow bounce animated" data-wow-delay="0.1s" style="visibility: visible; animation-delay: 0.1s; animation-name: bounce;">
        <div class="container" id="msgs">
            <div style="text-align: center;margin: 10px auto;"><button class="more layui-btn layui-btn-xs layui-btn-radius">查看更多</button></div>
            <div class="info-grid-main msgsbg">

                <div class="clearfix"> </div>
            </div>
            <input type="hidden" id="touser" value="{{ $from_user_id }}">
            <input type="hidden" id="user" value="{{ request()->user()->id }}">
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ asset('js/layer.js') }}" charset="utf-8"></script>
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var page = 0;//分页页码
        $(function () {
            page = 1;
            ajaxRead();
        });

        // $(window).bind('scroll', function () {//监控滚动条 到最底部时请求数据
        //     var scrollTop = $(this).scrollTop();    //滚动条距离顶部的高度
        //     var scrollHeight = $(document).height();   //当前页面的总高度
        //     var clientHeight = $(this).height();    //当前可视的页面高度
        //     if(scrollTop + clientHeight >= scrollHeight - 50){   //距离顶部+当前高度 >=文档总高度 即代表滑动到底部 注：-50 上拉加载更灵敏
        //         //加载数据
        //         page++;
        //         ajaxRead();
        //     }
        // });
        $(".more").click(function () {
            page++;
            ajaxRead();
        });
        //请求数据
        function ajaxRead() {
            var html = "";
            var tmp_html = "";
            var url = "/msg/getdetaillist";
            var from_user_id = $("#touser").val();
            var user_id = $("#user").val();
            var data = {'p': page,'size':10,'from_user_id':from_user_id};
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
                            if(item.from_user_id == from_user_id){
                                tmp_html += '<div class="part">';
                                tmp_html += '<h5 class="l_h">'+item.name+'['+item.date+']</h5>';
                                tmp_html += '<div class="l_c">'+ item.content +'</div>';
                                tmp_html += '<div class="clearfix"> </div>';
                                tmp_html += '</div>';
                            }else{
                                tmp_html += '<div class="part">';
                                tmp_html += '<h5 class="r_h">我['+item.date+']</h5>';
                                tmp_html += '<div class="r_c">'+ item.content +'</div>';
                                tmp_html += '<div class="clearfix"> </div>';
                                tmp_html += '</div>';
                            }
                            $(".info-grid-main").prepend($(tmp_html));
                            // html = tmp_html+html;
                            tmp_html="";

                        });
                        // $(".info-grid-main").prepend($(html));//写入页面
                    }
                },
            });
        }

        $(".sendmsg").click(function(){
            var docW = window.screen.width;
            if(docW < 1920){
                var layerW = '80%';
                var layerH = '45%';
            }else{
                var layerW = '500px';
                var layerH = '350px';
            }
            var id = $("#touser").val();
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
                        title: '回信：'+name,
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
