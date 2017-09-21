<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \Illuminate\Support\Facades\Input;
use \App\Http\Model\Config;
use Illuminate\Support\Facades\Validator;
class ConfigController extends Controller
{
    //get,admin/category  導航列表
    public function index(){
        $config = Config::orderBY('conf_order','DESC')->paginate(10);
       
        return view('admin.config.index')->with('data',$config);
    }
    
     //get,admin/category  新增文章
    public function create(){
        
        return view('admin.config.add');
    }
    
    //POST,admin/category  新增導航提交
    public function store(){
        
        if($input = Input::except('_token')){   //除了_token以外，其他值都取得
           
            $rules = array(
              'conf_url'=>'required', 
              'conf_name'=>'required', 
            );
            $message = array(
              'conf_url.required' => '地址不可為空',
              'conf_name.required' => '名稱不可為空',
              
            );   
            $validator = Validator::make($input,$rules,$message);
            if($validator->passes()){
                $re = Config::create($input);
                if($re){
                    return redirect('admin/config');
                }else{
                    return back()->with('error','資料錯誤，請稍後嘗試');
                }
               
            }else{
                return back()->withErrors($validator);
            }
            
            //dd($intput);
        }
        
    }
    
    public function edit($conf_id){
       $field = Config::find($conf_id);
       
       return view('admin.config.edit', compact('field'));
    }
    
    //put,admin/config   admin/config/{config}       更新連結 
    public function update($conf_id){
        $input = (Input::except('_token','_method'));
       
            $rules = array(
              'conf_url'=>'required', 
              'conf_name'=>'required', 
            );
            $message = array(
              'conf_url.required' => '地址不可為空',
              'conf_name.required' => '名稱不可為空',
              
            );   
            
        $validator = Validator::make($input,$rules,$message);
        if($validator->passes()){ 
            $re = Config::where('conf_id',$conf_id)->update($input);
            if($re){
                 return redirect('admin/config');
            }else{
                return back()->with('error','資料錯誤，請稍後嘗試');
            }
        }else{
                return back()->withErrors($validator);
               
        }    

    }
    
    //DELETE                 刪除分類
    public function destroy($conf_id){
        $re = Config::where('conf_id',$conf_id)->delete();
        
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
        $conf = Config::find($input['conf_id']);
        $conf->conf_order = $input['conf_order'];
        $re = $conf->update();
        
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
