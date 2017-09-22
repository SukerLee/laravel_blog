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
        foreach ($config as $k=>$v){
            switch ($v->field_type){
            case 'input':
                $config[$k]->_html = '<input type="text" class="lg" name="conf_content[]" value="'.$v->conf_content.'">';
                break;
            case 'textarea':
                $config[$k]->_html = '<textarea class="lg" name="conf_content[]">'.$v->conf_content.'</textarea>';
                break;
            case 'radio':
                $arr = explode(',',  $v->field_value);
                $str = "";
                foreach ($arr as $key => $val){
                    $_arr = explode('|', $val);
                    $c = ($v->conf_content == $_arr[0])?'checked':'';
                    $str .= '<input type="radio" name="conf_content[]" value="'.$_arr[0].'" '.$c.' >'.$_arr[1].'　';
                }
                $config[$k]->_html = $str;
                break;
            }
        }
        
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
              'conf_name'=>'required', 
              'conf_title'=>'required', 
            );
            $message = array(
              'conf_name.required' => '名稱不可為空',
              'conf_title.required' => '標題不可為空',
              
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
              'conf_name'=>'required', 
              'conf_title'=>'required', 
            );
            $message = array(
              'conf_name.required' => '名稱不可為空',
              'conf_title.required' => '標題不可為空',
              
            );    
        $validator = Validator::make($input,$rules,$message);
        if($validator->passes()){ 
            $re = Config::where('conf_id',$conf_id)->update($input);
            if($re){
                 $this->putFile();
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
            $this->putFile();
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
    
    //把設定寫入檔案
    public function putFile() {
//        echo \Illuminate\Support\Facades\Config::get('web.web_title');
        $config = Config::pluck('conf_content','conf_name')->all();
        $path = base_path().'/config/web.php';
        $str = '<?php return '.var_export($config,true).' ; ';
        file_put_contents($path,$str);

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
    
    public function changeContent() {
        $input = Input::all();
        foreach($input['conf_id'] as $k=>$v){
            Config::where('conf_id',$v)->update(['conf_content'=>$input['conf_content'][$k]]);
        }
        //dd($input);
        $this->putFile();
          return back()->with('errors','網站設置更新成功！');
    }

}
