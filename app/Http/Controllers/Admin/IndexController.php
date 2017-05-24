<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use \App\Http\Model\User;


class IndexController extends CommonController
{
    
    public function index() {
     echo "1213";   
     $pdo = DB::connection()->getPdo();
     //dd($pdo);
     
     return view('admin.index');
    }
    
    
    public function info() {
     
     return view('admin.info');
    }
    
    //更改密碼    
    public function pass() {
       
        
        if($input = Input::all()){
            $rules = array(
              'password'=>'required|between:6,20|confirmed', 
              
            );
            $message = array(
              'password.required' => '新密碼不可為空',
              'password.between' => '新密碼必須在6到20位之間',
              'password.confirmed' => '新密碼與確認密碼不同',  
            );
            
           $validator = Validator::make($input,$rules,$message);
            if($validator->passes()){
                
               $user = User::first();
               $_password = \Crypt::decrypt($user->user_pass);
               //echo $_password;
               
               
               
            }else{
                return back()->withErrors($validator);
               
            }
            
            //dd($intput);
        }else{ 

        return view('admin.pass');
        }
    }
}
