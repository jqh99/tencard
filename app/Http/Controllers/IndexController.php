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
        $cards = DB::table('card as c')
            ->select('c.*','u.name')
            ->join('user as u','u.id','=','c.user_id')
            ->orderBy('c.id','desc')->get();
        return view('welcome',[
            'cards'=>$cards
        ]);
    }

    public function about(){
        return view('html/about');
    }
}
