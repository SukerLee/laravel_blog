<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use \Illuminate\Support\Facades\Input;
use \App\Http\Model\Article;
use Illuminate\Support\Facades\Validator;

class ArticleController extends CommonController
{
    //get,admin/category  文章列表
    public function index(){
        $articles = Article::orderBY('art_id','desc')->paginate(10);
       // dd($articles->links());
         $categorys = (New \App\Http\Model\Category)->tree();
        return view('admin.article.index')->with('data',$articles);
    }
     //get,admin/category  新增文章
    public function create(){
        
        $categorys = (New \App\Http\Model\Category)->tree();
        //$categorys = [];
        return view('admin.article.add', compact('categorys'));
    }
    
    //POST,admin/category  新增分類提交
    public function store(){
        
        if($input = Input::except('_token')){   //除了_token以外，其他值都取得
           $input['art_time'] = date("Y-m-d H:i:s", time());
         // dd($input);
          // $input['art_content'] = htmlspecialchars($input['art_content']);
            $rules = array(
              'art_title'=>'required', 
              'art_content'=>'required', 
            );
            $message = array(
              'art_title.required' => '文章名稱不可為空',
              'art_content.required' => '文章內容不可為空',
            );   
            $validator = Validator::make($input,$rules,$message);
            if($validator->passes()){
                $re = Article::create($input);
                if($re){
                    return redirect('admin/article');
                }else{
                    return back()->with('error','資料錯誤，請稍後嘗試');
                }
               
            }else{
                return back()->withErrors($validator);
            }
            
          
            
            
            //dd($intput);
        }
        
        
    }
    //get,admin/article   admin/article/{article}/edit   編輯文章
    public function edit($art_id){
        $categorys = (New \App\Http\Model\Category)->tree();
        $field = Article::find($art_id);
       
       return view('admin.article.edit', compact('field','categorys'));
 
    }
    //put,admin/article   admin/article/{article}      更新文章  
    public function update($art_id){
        $input = (Input::except('_token','_method'));
       
        $rules = array(
              'art_title'=>'required', 
              'art_content'=>'required', 
            );
            $message = array(
              'art_title.required' => '文章名稱不可為空',
              'art_content.required' => '文章內容不可為空',
            );
            
        $validator = Validator::make($input,$rules,$message);
        if($validator->passes()){ 
            $re = Article::where('art_id',$art_id)->update($input);
            if($re){
                 return redirect('admin/article');
            }else{
                return back()->with('error','資料錯誤，請稍後嘗試');
            }
        }else{
                return back()->withErrors($validator);
               
        }    

    }
    //DELETE                           刪除文章
    public function destroy($art_id){
        $re = Article::where('art_id',$art_id)->delete();
        
        if($re){
            $data = ['status'=>0,
                'msg' => '資料刪除成功',
                ]; 
        }else{
              $data = ['status'=>1,
                'msg' => '資料刪除失敗',
                ]; 
        }
        return $data;
    }   
}
