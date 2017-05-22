<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

require_once 'resources/org/code/Code.class.php';

class LoginController extends CommonController
{
   public function login(){
       
     return view('admin.login');
       
   }
   
   public function code() {
       $code = New \Code;
       
       $code->make();
   }
   
   public function getcode() {
       $code = New \Code;
       
       //$code->make();
       
       echo $code->get();
   }
}
