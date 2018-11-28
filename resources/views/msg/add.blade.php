@extends('layout.master_f')
@section('title','发送私信')
@section('description','经典星空，蕴藏无尽语录，记载璀璨人生，一字一句皆经典，一分沉吟传天下，泽被后世永流传...')
@section('keywords','经典 星空 无尽 语录 璀璨 人生 字 句 沉吟 天下 流传 后世')
@section('css')
    <link rel="stylesheet" media="screen" href="{{ asset('css/stylecard.css') }}">
@endsection
@section('container')
    <div class="login-01">
        <form method="post" action="/msg/add">
            {!! csrf_field() !!}
            <input type="hidden" id="to_user" name="to_user" />
            <ul>
                <li class="second">
                    <a href="javascript:;" class=" icon msg"></a>
                    <textarea name="content" required="required"></textarea>
                    <div class="clear"></div>
                </li>
            </ul>
            <input class="send" type="button" value="发送">
            <div class="clear"></div>
        </form>
    </div>
@endsection
@section('js')
    <script src="{{ asset('js/layer.js') }}"></script>
    <script type="text/javascript">
        $(function () {
            $("#to_user").val(parent.$("#touser").val());
            $('.send').click(function () {
                $.ajax({
                    url:'/msg/add',
                    type:'post',
                    data:$("form").serialize(),
                    async : true, //默认为true 异步
                    error:function(){
                        //alert('error');
                    },
                    success:function(data){
                        // data = JSON.parse(data);
                        layer.msg(data.msg, { shift: -1 }, function () {
                            if(data.status == 1){
                                var index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引
                                parent.layer.close(index); //再执行关闭
                            }
                        });

                    }
                });
            });
        });
    </script>
@endsection
