@extends('layout.master')
@section('title','我之经典我人生')
@section('description','经典星空，蕴藏无尽语录，记载璀璨人生，一字一句皆经典，一分沉吟传天下，泽被后世永流传...')
@section('keywords','经典 星空 无尽 语录 璀璨 人生 字 句 沉吟 天下 流传 后世')
@section('css')
    <link rel="stylesheet" media="screen" href="{{ asset('css/stylecard.css') }}">
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet" type="text/css" media="all">
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <!-- Custom Theme files -->
    <link href="{{ asset('css/stylelist.css') }}" rel="stylesheet" type="text/css" media="all">

@endsection
@section('container')
    @if($count < 10)
    <div class="container">
        <div class="legend">
            <a class="layui-btn layui-btn-warm" href="/card/add">创我经典</a>
        </div>
    </div>
    @endif
    <!--info-grid start here-->
    <div class="info-grid wow bounce animated" data-wow-delay="0.1s" style="visibility: visible; animation-delay: 0.1s; animation-name: bounce;">
        <div class="container">
            <div class="info-grid-main">
                @foreach($cards as $item)
                <div class="col-md-4 info-grids-cr wow bounceIn animated" data-wow-delay="0.4s" style="visibility: visible; animation-delay: 0.4s; animation-name: bounceIn;">
                    <div class="info-top">
                        <h3>
                            <span style="color:red">获赞数（{{ $item->like_count }}）</span>
                            <button class="delcard layui-btn layui-btn-sm layui-btn-primary" data-id="{{ $item->id }}">
                                <i class="layui-icon">&#xe640;</i>
                            </button>
                        </h3>
                    </div>
                    <div class="info-bott">
                        {{--<img src="/images/c1.jpg" alt="">--}}
                        <p>{{ $item->content }}</p>
                        <h5 style="text-align: right">——{{ request()->user()->name }}</h5>
                    </div>
                    <div class="infogrid-bwn">
                        <p class="weibai">经典那一霎：{{ date('Y-m-d H:i:s',$item->create_time) }}</p>
                    </div>
                    <br/>
                    {{--<div class="gd-tl-tip"> </div>--}}
                </div>
                @endforeach
                <div class="clearfix"> </div>
            </div>
        </div>
    </div>
    <!--info-grid end here-->
@endsection
@section('js')
<script type="text/javascript">
    $(function () {
       $('.delcard').click(function () {
           if(confirm('确定要删除吗？')){
               var id=$(this).attr('data-id');
               location.href='/card/delete/'+id;
           }
       });
    });
</script>
@endsection
