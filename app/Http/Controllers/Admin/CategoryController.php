<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use \Illuminate\Support\Facades\Input;
use \App\Http\Model\Category;
use Illuminate\Support\Facades\Validator;
class CategoryController extends CommonController
{
    //get,admin/category  分類列表
    public function index(){
        
       $categorys = (New \App\Http\Model\Category)->tree();
        
        return view('admin.category.index')->with('data',$categorys);
    }
    
 
    

    
   //get,admin/category  新增分類
    public function create(){
        
        $categorys = Category::where('cate_pid','0')->get();
        return view('admin.category.add', compact('categorys'));
    }
  
        
    //POST,admin/category  新增分類提交
    public function store(){
        
         if($input = Input::except('_token')){
           
            $rules = array(
              'cate_name'=>'required', 
              
            );
            $message = array(
              'cate_name.required' => '分類名稱不可為空',
              
            );
            
           $validator = Validator::make($input,$rules,$message);
            if($validator->passes()){
                $re = Category::create($input);
                if($re){
                    return redirect('admin/category');
                }else{
                    
                }
               
            }else{
                return back()->withErrors($validator);
               
            }
            
            //dd($intput);
        }
        
    }
    
    
        //get,admin/category  顯示單個分類
    public function show(){
        
    }
    
      //get,admin/category     編輯分類
    public function edit(){
        
    }
    
    //put,admin/category      更新分類  
    public function update(){
        
    }
     //DELETE                 刪除分類
    public function destroy(){
        
    }   

    
    public function changeOrder() {
       $input = Input::all();
        $cate = Category::find($input['cate_id']);
        $cate->cate_order = $input['cate_order'];
        $re = $cate->update();
        
        if($re){
            $data = [
                'status'=> 0,
                'msg'=>'排序設定成功',
            ];
        }else{
            $data = [
                'status'=> 1,
                'msg'=>'排序設定失敗',
            ];
        }
        
        return $data;
        //dd($input);
    }
}
