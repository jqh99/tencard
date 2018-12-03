<?php

namespace App\Http\Controllers;

use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Auth;

class CardController extends Controller
{
    //
    public function addCard(){
        return view('card/add');
    }

    public function saveCard(){
        $content = request()->get('content');
        $count = DB::table('card')->where('user_id',request()->user()->id)->count();
        if($count >=10){
            echo '<script>alert("经典在精不在多，所以，每个用户限定十大经典！");location.href="/card/list";</script>';
            die;
        }
        $id = DB::table('card')->insertGetId([
           'user_id'=>request()->user()->id,
           'content'=>$content,
           'theme_id'=>request()->get('theme',1),
           'create_time'=>time()
        ]);
        if($id > 0){
            return redirect('card/list');
        }else{
            return redirect('card/add');
        }
    }

    public function cardList(){
        $count = DB::table('card')->where('user_id',request()->user()->id)->count();
        $cards = DB::table('card')->where('user_id',request()->user()->id)->orderBy('id','desc')->get();
        return view('card/list',[
            'cards'=>$cards,
            'count'=>$count
        ]);
    }

    public function likeCard(){
        if (!Auth::check()) {
            return json_encode([
                'status'=>0,
                "msg"=>"请您先登录！"
            ]);
        }
        $id = request()->get('card_id');
        $is_like = DB::table('card_to_like_user')
            ->where('user_id',request()->user()->id)
            ->where('card_id',$id)
            ->count();
        if($is_like>0){
            return json_encode([
               'status'=>0,
               "msg"=>"您已经为Ta的这份经典，贡献过宝贵力量！"
            ]);
        }else{
            try{
                DB::transaction(function () use($id){

                    DB::table('card')->where('id',$id)->increment('like_count');
                    DB::table('card_to_like_user')->insert([
                        'user_id'=>request()->user()->id,
                        'card_id'=>$id
                    ]);
                });

            }catch (QueryException $e){
                return json_encode([
                    'status'=>0,
                    "msg"=>"服务器忙，请稍后重试！"
                ]);
            }
            return json_encode([
                'status'=>1,
                "msg"=>"恭喜您，为经典流传，再次贡献了一份宝贵力量！"
            ]);

        }
    }

    public function cardDel($id){
        try{
            DB::transaction(function () use($id){

                DB::table('card')->where('id',$id)->where('user_id',request()->user()->id)->delete();
                DB::table('card_to_like_user')->where('card_id',$id)->delete();
            });

        }catch (QueryException $e){

        }
        return redirect('/card/list');
    }
}
