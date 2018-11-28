<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Psy\Exception\ErrorException;

class MemberController extends Controller
{
    //
    public function addMsg(){
        return view('msg/add');
    }

    public function saveMsg(){
        $content = request()->get('content');
        $touser_id = request()->get('to_user');
        if($touser_id == request()->user()->id){
            return json_encode(['status'=>0,'msg'=>'亲，给自己发私信？直接默念也是可以滴！']);
        }
        try{
            $id = DB::table('msg')->insertGetId([
                'from_user_id'=>request()->user()->id,
                'to_user_id'=>$touser_id,
                'content'=>$content,
                'send_time'=>time()
            ]);
        }catch (ErrorException $e){
            return json_encode(['status'=>0,'msg'=>'服务器忙，请稍后重试']);
        }

        if($id > 0){
            return json_encode(['status'=>1,'msg'=>'发送成功！']);
        }else{
            return json_encode(['status'=>0,'msg'=>'服务器忙，请稍后重试']);
        }
    }

    public function msgList(){
        return view('msg/list',[
            'msgs'=>[]
        ]);
    }

    public function getMsgList(){
        $p = request()->get('p',1);
        $size = request()->get('size',15);
        try{
            $msgs = DB::table('msg as m')
                ->select('m.*','u.name')
                ->join('user as u','u.id','=','m.from_user_id')
                ->where('m.to_user_id',request()->user()->id)
                ->skip(($p-1)*$size)
                ->take($size)
                ->orderBy('m.id','desc')
                ->get();
        }catch (ErrorException $e){
            return json_encode(['status'=>0,'msg'=>'服务器忙，请稍后重试']);
        }
        if(count($msgs) > 0){
            return json_encode([
                'status'=>1,
                'data'=>$msgs,
                'msg'=>''
            ]);
        }else{
            return json_encode([
                'status'=>0,
                'msg'=>'暂时木有啦！'
            ]);
        }

    }
}
