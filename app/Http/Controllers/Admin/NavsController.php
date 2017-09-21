<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \Illuminate\Support\Facades\Input;
use \App\Http\Model\Navs;
use Illuminate\Support\Facades\Validator;
class NavsController extends Controller
{
    //get,admin/category  導航列表
    public function index(){
        $navs = Navs::orderBY('nav_order','DESC')->paginate(10);
       
        return view('admin.navs.index')->with('data',$navs);
    }
    
     //get,admin/category  新增文章
    public function create(){
        
        return view('admin.navs.add');
    }
    
    //POST,admin/category  新增導航提交
    public function store(){
        
        if($input = Input::except('_token')){   //除了_token以外，其他值都取得
           
            $rules = array(
              'nav_url'=>'required', 
              'nav_name'=>'required', 
            );
            $message = array(
              'nav_url.required' => '地址不可為空',
              'nav_name.required' => '名稱不可為空',
              
            );   
            $validator = Validator::make($input,$rules,$message);
            if($validator->passes()){
                $re = Navs::create($input);
                if($re){
                    return redirect('admin/navs');
                }else{
                    return back()->with('error','資料錯誤，請稍後嘗試');
                }
               
            }else{
                return back()->withErrors($validator);
            }
            
            //dd($intput);
        }
        
    }
    
    public function edit($nav_id){
       $field = Navs::find($nav_id);
       
       return view('admin.navs.edit', compact('field'));
    }
    
    //put,admin/navs   admin/navs/{navs}       更新連結 
    public function update($nav_id){
        $input = (Input::except('_token','_method'));
       
            $rules = array(
              'nav_url'=>'required', 
              'nav_name'=>'required', 
            );
            $message = array(
              'nav_url.required' => '地址不可為空',
              'nav_name.required' => '名稱不可為空',
              
            );   
            
        $validator = Validator::make($input,$rules,$message);
        if($validator->passes()){ 
            $re = Navs::where('nav_id',$nav_id)->update($input);
            if($re){
                 return redirect('admin/navs');
            }else{
                return back()->with('error','資料錯誤，請稍後嘗試');
            }
        }else{
                return back()->withErrors($validator);
               
        }    

    }
    
    //DELETE                 刪除分類
    public function destroy($nav_id){
        $re = Navs::where('nav_id',$nav_id)->delete();
        
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
        $nav = Navs::find($input['nav_id']);
        $nav->nav_order = $input['nav_order'];
        $re = $nav->update();
        
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
