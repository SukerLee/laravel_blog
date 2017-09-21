@extends('layouts.admin')
@section('content')
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">首頁</a> &raquo; 文章管理
    </div>
    <!--面包屑导航 结束-->

	<!--结果集标题与导航组件 开始-->
	<div class="result_wrap">
        <div class="result_title">
            <h3>新增文章</h3>
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
                    <a href="{{url('admin/article/create')}}"><i class="fa fa-plus"></i>新增文章</a>
                    <a href="{{url('admin/article/')}}"><i class="fa fa-recycle"></i>全部文章</a>
                </div>
            </div>
    </div>
    <!--结果集标题与导航组件 结束-->
  
    <div class="result_wrap">
        <form action="{{url('admin/article/'.$field->art_id)}}" method="post">
            <input type="hidden" name="_method" value="put">
            {{csrf_field()}}
            <table class="add_tab">
                <tbody>
                    <tr>
                        <th width="120">分類：</th>
                        <td>
                            <select name="cate_id">
                                @foreach($categorys as $c)
                                <option value="{{$c->cate_id}}" @if($field->cate_id == $c->cate_id) selected @endif >{{$c->_cate_name}}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
<!--                    <tr>
                        <th><i class="require">*</i>分類名稱：</th>
                        <td>
                            <input type="text" name="cate_name">
                            <span><i class="fa fa-exclamation-circle yellow"></i>分類名稱必填</span>
                        </td>
                    </tr>-->
                    
                    <tr>
                        <th><i class="require">*</i>文章標題：</th>
                        <td>
                            <input type="text" class="lg" name="art_title" value="{{$field->art_title}}">
                        </td>
                    </tr>
                     
                    <tr>
                        <th>編輯：</th>
                        <td>
                            <input type="text" class="lg" name="art_editor" value="{{$field->art_editor}}">
                        </td>
                    </tr>
                    
<!--                    <tr>
                        <th>圖片：</th>
                        <td>
                            <img src="" id="art_thumb_img" style="max-width: 350px; max-height: 100px;">
                        </td>
                    </tr>-->
                    
                     <tr>
                        <th>文章縮圖：</th>
  
                        <td>
                            <img src="/{{$field->art_thumb}}" id="art_thumb_img" style="max-width: 350px; max-height: 100px;"><br>
                            <input type="hidden" class="lg" name="art_thumb" value="{{$field->art_thumb}}">
                           <input id="file_upload" name="file_upload" type="file" multiple="true">
      
                        </td>
                    </tr>
                    
                    <tr>
                        <th>關鍵字：</th>
                        <td>
                            <textarea name="art_keywords">{{$field->art_keywords}}</textarea>
                        </td>
                    </tr>
                    
                    <tr>
                        <th>描述：</th>
                        <td>
                            <textarea name="art_description">{{$field->art_description}}</textarea>
                        </td>
                    </tr>
                    
                   
                    <tr>
                        <th><i class="require">*</i>文章內容：</th>
                        <td>
                            <textarea name="art_content" class="editer">{!! $field->art_content !!}</textarea>
                        </td>
                    </tr> 
                   
                    
<!--                    <tr>
                        <th><i class="require">*</i>排序：</th>
                        <td>
                            <input type="text" class="sm" name="cate_order">
                            <span><i class="fa fa-exclamation-circle yellow"></i>排序數字越大越往前</span>
                        </td>
                    </tr>-->
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

@endsection