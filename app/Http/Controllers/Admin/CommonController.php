<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommonController extends Controller
{
   //上傳圖片
   public function upload(){
      $file =  \Illuminate\Support\Facades\Input::file('Filedata');
     

        if($file -> isValid()){
            
        $realPath = $file -> getRealPath();  //臨時文件的絕對路徑
        $entension = $file -> getClientOriginalExtension();  //上傳檔案的副檔名
        $newName = date('YmdHis').mt_rand(100,999).".".$entension;
        $path = $file -> move(base_path().'/uploads/',$newName);
        
        $filepath = 'uploads/'.$newName;
        return $filepath;
 
        }       
   }
}
