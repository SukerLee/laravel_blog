@extends('layouts.admin')
@section('content')
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">首頁</a> &raquo; 全部文章
    </div>
    <!--面包屑导航 结束-->

<!--	结果页快捷搜索框 开始
	<div class="search_wrap">
        <form action="" method="post">
            <table class="search_tab">
                <tr>
                    <th width="120">选择分类:</th>
                    <td>
                        <select onchange="javascript:location.href=this.value;">
                            <option value="">全部</option>
                            <option value="http://www.baidu.com">百度</option>
                            <option value="http://www.sina.com">新浪</option>
                        </select>
                    </td>
                    <th width="70">关键字:</th>
                    <td><input type="text" name="keywords" placeholder="关键字"></td>
                    <td><input type="submit" name="sub" value="查询"></td>
                </tr>
            </table>
        </form>
    </div>
    结果页快捷搜索框 结束-->

    <!--搜索结果页面 列表 开始-->
    <form action="#" method="post">
        <div class="result_wrap">
            <div class="result_title">
            <h3>文章列表</h3>
            </div>
            <!--快捷导航 开始-->
            <div class="result_content">
                <div class="short_wrap">
                    <a href="{{url('admin/article/create')}}"><i class="fa fa-plus"></i>新增文章</a>
                    <a href="{{url('admin/article/')}}"><i class="fa fa-recycle"></i>全部文章</a>
                </div>
            </div>
            <!--快捷导航 结束-->
        </div>

        <div class="result_wrap">
            <div class="result_content">
                <table class="list_tab">
                    <tr>
<!--                        <th class="tc" width="5%"><input type="checkbox" name=""></th>-->
                        <th class="tc" width="5%">ID</th>
                       
                        <th>標題</th>
                        <th>編輯</th>
                        <th>敘述</th>
                        <th>點擊</th>
                        <th>發佈時間</th>
                        <th>操作</th>
                    </tr>
                   @foreach($data as $v)
                    <tr>
<!--                        <td class="tc"><input type="checkbox" name="id[]" value="59"></td>-->

                        <td class="tc">{{$v->art_id}}</td>
                        
                        
                         <td>
                            {{$v->art_title}}</a>
                        </td>
                        <td>
                            {{$v->art_editor}}</a>
                        </td>
                        <td>
                            {{$v->art_description}}</a>
                        </td>
                        <td>
                            {{$v->art_view}}</a>
                        </td>
                        <td>
                            {{$v->art_time}}</a>
                        </td>
                     
                        <td>
                            <a href="{{url('admin/article/'.$v->art_id.'/edit')}}">修改</a>
                            <a href="#" onclick="delArt({{$v->art_id}})">删除</a>
                        </td>
                    </tr>
                    @endforeach
                </table>


<!--<div class="page_nav">
<div>
<a class="first" href="/wysls/index.php/Admin/Tag/index/p/1.html">第一页</a> 
<a class="prev" href="/wysls/index.php/Admin/Tag/index/p/7.html">上一页</a> 
<a class="num" href="/wysls/index.php/Admin/Tag/index/p/6.html">6</a>
<a class="num" href="/wysls/index.php/Admin/Tag/index/p/7.html">7</a>
<span class="current">8</span>
<a class="num" href="/wysls/index.php/Admin/Tag/index/p/9.html">9</a>
<a class="num" href="/wysls/index.php/Admin/Tag/index/p/10.html">10</a> 
<a class="next" href="/wysls/index.php/Admin/Tag/index/p/9.html">下一页</a> 
<a class="end" href="/wysls/index.php/Admin/Tag/index/p/11.html">最后一页</a> 
<span class="rows">11 条记录</span>
</div>
</div>-->



                <div class="page_list">
                   {{$data->links()}}
                </div>
            </div>
        </div>
    </form>
    <!--搜索结果页面 列表 结束-->
    <script>
        function changeOrder(obj,cate_id){
            var cate_order = $(obj).val();

            $.post( "{{url('admin/cate/changeorder')}}",{'_token':'{{csrf_token()}}','cate_id':cate_id,'cate_order':cate_order },function(data) {

                if(data.status == 0){
                     layer.msg(data.msg, {icon: 6});
                }else{
                     layer.msg(data.msg, {icon: 5});
                }
            });
        }
        
        function delArt(art_id){
            layer.confirm('您確定要刪除該筆資料?', {
              btn: ['確定','取消'] //按钮
            }, function(){
//              layer.msg('的确很重要', {icon: 1});
                $.post("{{url('admin/article')}}/"+art_id,{'_token':'{{csrf_token()}}','_method':'delete'},function(data){
                    if(data.status == 0){
                         location.reload();
                          layer.msg(data.msg, {icon: 6});  
                    }else{
                          layer.msg(data.msg, {icon: 5});  
                    }
    
                })
            }, function(){
//              layer.msg('也可以这样', {
//                time: 20000, //20s后自动关闭
//                btn: ['明白了', '知道了']
//              });
            });
        }
    </script> 
    <style>
    .result_content ul li span {
        font-size: 15px;
        padding: 6px 12px;
    }
    </style>
@endsection