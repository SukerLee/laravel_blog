<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'category';
    protected $primaryKey = 'cate_id';
    protected $field_name = 'cate_name';
    public $timestamps = false;
    protected $guarded = [];




    public function tree(){
            $categorys = $this->orderBy('cate_order','desc')->get();
            return $this->getTree($categorys,'cate_name','cate_id','cate_pid');
    }


    public function getTree($data,$field_name,$field_id='id',$field_pid,$pid=0){
        
         $arr = array();
         foreach($data as $k => $v){
             if($v->$field_pid == $pid){
                 $data[$k]['_'.$field_name] = $v->$field_name;
                 
                 $arr[] = $data[$k];
                 foreach($data as $m => $n){
                     if($n->$field_pid == $v->$field_id)
                     {
                         $data[$m]['_'.$field_name] = "┣".$n->$field_name;
                         $arr[] = $data[$m];
                     }
                 }
             }
                 
         }
         return $arr;
    }
}
