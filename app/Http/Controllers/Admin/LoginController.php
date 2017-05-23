<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use \Illuminate\Support\Facades\Input;
use \Crypt;

require_once 'resources/org/code/Code.class.php';

class LoginController extends CommonController
{
   public function login(){
     $input = Input::all(); 
     
     if($input){   
         $code = New \Code;
         $_code = $code->get();
        if(strtoupper($input['code']) != $_code){
               
            return back()->with('msg','驗證碼錯誤');
        }else{
             $user = \App\Http\Model\User::first();
                echo $input['user_name']; die;
               if($user->user_name == $input['user_name'] && Crypt::decrypt($user->user_pass) == $input['user_pass'])
               {

               }else{
                    return back()->with('msg','帳號或密碼錯誤');
               }
        }
       
     }else{
       
         
     }  
     return view('admin.login');
       
   }
   
   public function code() {
       $code = New \Code;
       
       $code->make();
   }
   
   public function crypt() {
      $str = '123456';
      $_str = 'eyJpdiI6Imw0NDYwRksza0tSaDFEWlZsNHl6OVE9PSIsInZhbHVlIjoiSEVpM1VCTmRXWXprV0QrVnJnYXJDdz09IiwibWFjIjoiODlhZDBiMTEwNzlhODczMWE5ZjNhMGFlZjJhYTE3OGEyYzAwYzUyYWVjZmE1NTQ2MzZiNWM1NWI4N2NlMjU4NSJ9
';
      echo Crypt::encrypt($str);
      echo "<br>";
      echo Crypt::decrypt($_str);
      
   }
   
   public function getcode() {
       $code = New \Code;

       
       echo $code->get();
   }
}
