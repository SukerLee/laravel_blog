@extends('layouts.admin')
@section('content')
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">首頁</a> &raquo; 網站設置管理
    </div>
    <!--面包屑导航 结束-->

	<!--结果集标题与导航组件 开始-->
	<div class="result_wrap">
        <div class="result_title">
            <h3>新增網站設置</h3>
        @if(count($errors)>0)
            <div class="mark">
            @if(is_object($errors))
            @foreach($errors->all() as $error) 
                 <p>{{$error}}</p>      
            @endforeach
            @else 
                 <p>{{$errors}}</p>
            @endif
            </div>  
       @endif
        </div>
         <div class="result_content">
                <div class="short_wrap">
                    <a href="{{url('admin/config/create')}}"><i class="fa fa-plus"></i>新增網站設置</a>
                    <a href="{{url('admin/config/')}}"><i class="fa fa-recycle"></i>全部網站設置</a>
                </div>
            </div>
    </div>
    <!--结果集标题与导航组件 结束-->
  
    <div class="result_wrap">
        <form action="{{url('admin/config/'.$field->conf_id)}}" method="post">
            {{method_field('PUT')}}
            {{csrf_field()}}
            <table class="add_tab">
                <tbody>


                    
                    <tr>
                        <th><i class="require">*</i>標題：</th>
                        <td>
                            <input type="text" class="lg" name="conf_title" value="{{$field->conf_title}}">
                        </td>
                    </tr>
                     
                    <tr>
                        <th><i class="require">*</i>名稱：</th>
                        <td>
                            <input type="text" class="lg" name="conf_name" value="{{$field->conf_name}}">
                        </td>
                    </tr>
                     <tr>
                        <th><i class="require">*</i>類型：</th>
                        <td>
                            <input type="radio" name="field_type" value="input" @if($field->field_type == 'input') checked @endif onchange="showTr()">input　
                            <input type="radio" name="field_type" value="textarea" @if($field->field_type == 'textarea') checked @endif  onchange="showTr()"> textarea　　     
                            <input type="radio" name="field_type" value="radio" @if($field->field_type == 'radio') checked @endif  onchange="showTr()">radio　　     
                            <span><i class="fa fa-exclamation-circle yellow"></i>類型：text textarea radio </span>
                        </td>
                     </tr>
                     
                    <tr class="field_value">
                        <th><i class="require">*</i>類型值：</th>
                        <td>
                            <input type="text" class="lg" name="field_value" value="{{$field->field_value}}">
                            <span><i class="fa fa-exclamation-circle yellow"></i>只有在radio情況下才需要設置，格式 1|開啟,0|關閉 </span>
                        </td>
                    </tr>
                     <tr>
                        <th>說明：</th>
                        <td>
                            <textarea name="conf_tips">{{$field->conf_tips}}"</textarea>
                          
                        </td>
                    </tr>
                    <tr>
                        <th>排序：</th>
                        <td>
                            <input type="text" class="sm" name="conf_order" value="{{$field->conf_order}}">
                            <span><i class="fa fa-exclamation-circle yellow"></i>排序數字越大越往前</span>
                        </td>
                    </tr>
 
                    <tr>
                        <th></th>
                        <td>
                            <input type="submit" value="提交">
                            <input type="button" class="back" onclick="history.go(-1)" value="返回">
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>
    <script>
    showTr();
    function showTr(){
        var type = $('input[name=field_type]:checked').val();
        if(type == 'radio'){
            $('.field_value').show();
        }else{
            $('.field_value').hide();
        }
    }
    </script>
@endsection