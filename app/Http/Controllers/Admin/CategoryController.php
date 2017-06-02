<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

class CategoryController extends CommonController
{
    //get,admin/category  分類列表
    public function index(){
        
       $categorys = (New \App\Http\Model\Category)->tree();
        
        return view('admin.category.index')->with('data',$categorys);
    }
    
 
    
    
    //POST,admin/category 
    public function store(){
        
    }
    
        //get,admin/category  新增分類
    public function create(){
        
    }
    
    
        //get,admin/category  顯示單個分類
    public function show(){
        
    }
    
    //put,admin/category      更新分類  
    public function update(){
        
    }
     //DELETE                 刪除分類
    public function destroy(){
        
    }   
     //get,admin/category     編輯分類
    public function edit(){
        
    }
    
    public function changeOrder($param) {
        echo "555";
        
    }
}
