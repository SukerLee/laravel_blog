<?php

namespace App\Http\Controllers\Home;
use  \App\Http\Model\Navs;
use  \App\Http\Model\Article;
use  \App\Http\Model\Links;
use \App\Http\Model\Category;
class IndexController extends CommonController
{
    public function index(){
        //點擊數量最高的文章6篇
        $hot = Article::orderBy('art_view','DESC')->take(5)->get();
        
        //圖文列表(分頁):5
        $data = Article::orderBy('art_time','DESC')->paginate(5);
       
        //最新文章:8
        $new = Article::orderBy('art_view','DESC')->take(8)->get();
        
        //外連連結
        $links = Links::orderBy('link_order','DESC')->get();

        return view('home.index', compact('data','links'));
    }
    
    public function cate($cate_id){
       $field =  \App\Http\Model\Category::find($cate_id);
       
        //查看次數增加
        Category::where('cate_id',$cate_id)->increment('cate_view');
       
       //圖文列表(分頁):4
       $data = Article::where('cate_id',$cate_id)->orderBy('art_time','DESC')->paginate(4);
       
       //當前分類的次分類
       $submenu = Category::where('cate_pid',$cate_id)->get();
       
       return view('home.list', compact('field','data','submenu'));
    }
    
    public function article($art_id){
        $field = Article::where('art_id',$art_id)->join('category','article.cate_id','=','category.cate_id')->first();
        
        //查看次數增加
        Article::where('art_id',$art_id)->increment('art_view');
        
        $article['pre'] = Article::where('art_id','<',$art_id)->orderBy('art_id','desc')->first();
        $article['next'] = Article::where('art_id','>',$art_id)->orderBy('art_id','asc')->first();
        $data = Article::where('cate_id',$field->cate_id)->take(6)->get();
        //dd($article);
        return view('home.news', compact('field','article','data'));
    }
}
