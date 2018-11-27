<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;

class CardController extends Controller
{
    //
    public function addCard(){
        return view('card/add');
    }

    public function saveCard(){
        $content = request()->get('content');
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
        $cards = DB::table('card')->where('user_id',request()->user()->id)->orderBy('id','desc')->get();
        return view('card/list',[
            'cards'=>$cards
        ]);
    }
}
