<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;

class IndexController extends Controller
{
    //
    public function index(){
//        $cards = DB::table('card as c')
//            ->select('c.*','u.name')
//            ->join('user as u','u.id','=','c.user_id')
//            ->orderBy('c.id','desc')->get();
        return view('welcome',[
//            'cards'=>$cards
        ]);
    }

    public function getIndexList(){
        $p = request()->get('p',1);
        $size = request()->get('size',15);

        try{
            $cards = DB::table('card as c')
                ->select('c.*','u.name')
                ->join('user as u','u.id','=','c.user_id')
                ->orderBy('c.id','desc')
                ->skip(($p-1)*$size)
                ->take($size)
                ->get();
            foreach ($cards as $k=>$v){
                $cards[$k]->short_content = str_limit($v->content,50);
            }

        }catch (QueryException $e){
            return json_encode(['status'=>0,'msg'=>'服务器忙，请稍后重试']);
        }
        if(count($cards) > 0){
            return json_encode([
                'status'=>1,
                'data'=>$cards,
                'msg'=>''
            ]);
        }else{
            return json_encode([
                'status'=>0,
                'msg'=>'暂时木有啦！'
            ]);
        }
    }

    public function about(){
        return view('html/about');
    }
}
