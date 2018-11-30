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
    <!--info-grid start here-->
    <div class="info-grid wow bounce animated" data-wow-delay="0.1s" style="visibility: visible; animation-delay: 0.1s; animation-name: bounce;">
        <div class="container" id="msgs">
            <div class="info-grid-main">

                <div class="clearfix"> </div>
            </div>
            <input type="hidden" id="touser" value="">
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

        $(window).bind('scroll', function () {//监控滚动条 到最底部时请求数据
            if ($(document).scrollTop() == $(document).height() - $(window).height()) {
                page++;
                ajaxRead();
            }
        });

        //请求数据
        function ajaxRead() {
            var html = "";
            var url = "/msg/getlist";
            var data = {'p': page,'size':15};
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
                            html += '<div class="col-md-4 info-grids-cr wow bounceIn animated" data-wow-delay="0.4s" style="visibility: visible; animation-delay: 0.4s; animation-name: bounceIn;">';
                            html += '<div class="info-bott">';
                            html += '<h5 style="text-align: left;">来自：'+item.name+'</h5>';
                            html += '<p>'+ item.content +'</p>';
                            html += '<a class="layui-btn layui-btn-normal" href="/msg/detail/'+item.from_user_id+'">查看</a>';
                            html += '</div>';
                            html += '<br/>';
                            html += '</div>';
                        });
                        $(".info-grid-main").append($(html));//写入页面
                    }
                },
            });
        }
    </script>
@endsection
