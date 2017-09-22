<?php

namespace App\Http\Controllers\Home;
use  \App\Http\Model\Navs;
use  \App\Http\Model\Article;
use  \App\Http\Model\Links;
class IndexController extends CommonController
{
    public function index(){
        //點擊數量最高的文章6篇
        $hot = Article::orderBy('art_view','DESC')->take(6)->get();
        
        //圖文列表(分頁):5
        $data = Article::orderBy('art_time','DESC')->paginate(5);
       
        //最新文章:8
        $new = Article::orderBy('art_view','DESC')->take(8)->get();
        
        //外連連結
        $links = Links::orderBy('link_order','DESC')->get();

        return view('home.index', compact('hot','new','data','links'));
    }
    
    public function cate(){

        return view('home.list');
    }
    
    public function article(){

        return view('home.news');
    }
}
