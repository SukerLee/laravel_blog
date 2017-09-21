<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \Illuminate\Support\Facades\Input;
use \App\Http\Model\Links;
use Illuminate\Support\Facades\Validator;
class LinksController extends Controller
{
    //get,admin/category  外連連結列表
    public function index(){
        $links = Links::orderBY('link_order','DESC')->paginate(10);
       // dd($articles->links());
       
        return view('admin.links.index')->with('data',$links);
    }
    
     //get,admin/category  新增文章
    public function create(){
        
        return view('admin.links.add');
    }
    
    //POST,admin/category  新增外連連結提交
    public function store(){
        
        if($input = Input::except('_token')){   //除了_token以外，其他值都取得
           
            $rules = array(
              'link_url'=>'required', 
              'link_name'=>'required', 
            );
            $message = array(
              'link_url.required' => '地址不可為空',
              'link_name.required' => '名稱不可為空',
              
            );   
            $validator = Validator::make($input,$rules,$message);
            if($validator->passes()){
                $re = Links::create($input);
                if($re){
                    return redirect('admin/links');
                }else{
                    return back()->with('error','資料錯誤，請稍後嘗試');
                }
               
            }else{
                return back()->withErrors($validator);
            }
            
            //dd($intput);
        }
        
    }
    
    public function edit($link_id){
       $field = Links::find($link_id);
       
       return view('admin.links.edit', compact('field'));
    }
    
    //put,admin/links   admin/links/{links}       更新連結 
    public function update($link_id){
        $input = (Input::except('_token','_method'));
       
            $rules = array(
              'link_url'=>'required', 
              'link_name'=>'required', 
            );
            $message = array(
              'link_url.required' => '地址不可為空',
              'link_name.required' => '名稱不可為空',
              
            );   
            
        $validator = Validator::make($input,$rules,$message);
        if($validator->passes()){ 
            $re = Links::where('link_id',$link_id)->update($input);
            if($re){
                 return redirect('admin/links');
            }else{
                return back()->with('error','資料錯誤，請稍後嘗試');
            }
        }else{
                return back()->withErrors($validator);
               
        }    

    }
    
    //DELETE                 刪除分類
    public function destroy($link_id){
        $re = Links::where('link_id',$link_id)->delete();
        
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
        $link = Links::find($input['link_id']);
        $link->link_order = $input['link_order'];
        $re = $link->update();
        
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
