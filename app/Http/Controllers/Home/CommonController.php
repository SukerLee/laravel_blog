<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use  \App\Http\Model\Navs;
use App\Http\Model\Article;

class CommonController extends Controller
{
    public function __construct() {
        $navs = Navs::orderBy('nav_order','DESC')->get();
        
        //點擊數量最高的文章6篇
        $hot = Article::orderBy('art_view','DESC')->take(5)->get();
       
        //最新文章:8
        $new = Article::orderBy('art_view','DESC')->take(8)->get();
        
        \Illuminate\Support\Facades\View::share('navs',$navs);
        \Illuminate\Support\Facades\View::share('hot',$hot);
        \Illuminate\Support\Facades\View::share('new',$new);
    }
}
