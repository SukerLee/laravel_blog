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
                    return back()->with('error','資料錯誤，請稍後嘗試');
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
    
      //get,admin/category   admin/category/{category}/edit   編輯分類
    public function edit($cate_id){
       $categorys = Category::where('cate_pid','0')->get();
       $field = Category::find($cate_id);
       
       return view('admin.category.edit', compact('field','categorys'));
    }
    
    //put,admin/category   admin/category/{category}       更新分類  
    public function update($cate_id){
        $input = (Input::except('_token','_method'));
       
        $rules = array(
              'cate_name'=>'required', 
              
            );
            $message = array(
              'cate_name.required' => '分類名稱不可為空',
              
            );
            
        $validator = Validator::make($input,$rules,$message);
        if($validator->passes()){ 
            $re = Category::where('cate_id',$cate_id)->update($input);
            if($re){
                 return redirect('admin/category');
            }else{
                return back()->with('error','資料錯誤，請稍後嘗試');
            }
        }else{
                return back()->withErrors($validator);
               
        }    

    }
     //DELETE                 刪除分類
    public function destroy($cate_id){
        $re = Category::where('cate_id',$cate_id)->delete();
        Category::where('cate_pid',$cate_id)->update(['cate_pid'=>0]);
        
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
