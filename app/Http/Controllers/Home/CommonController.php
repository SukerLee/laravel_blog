<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use  \App\Http\Model\Navs;

class CommonController extends Controller
{
    public function __construct() {
        $navs = Navs::all();
        \Illuminate\Support\Facades\View::share('navs',$navs);
    }
}
