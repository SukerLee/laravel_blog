@extends('layouts.admin')
@section('content')
    <!--头部 开始-->
	<div class="top_box">
		<div class="top_left">
			<div class="logo">後台管理模板</div>
			<ul>
                            <li><a target="_blank" href="{{url('/')}}" class="active">首頁</a></li>
                            <li><a target="main" href="{{url('admin/info')}}">管理頁</a></li>
			</ul>
		</div>
		<div class="top_right">
			<ul>
				<li>管理員：admin</li>
				<li><a href="<?= url('admin/pass')?>" target="main">修改密碼</a></li>
				<li><a href="<?= url('admin/logout')?>">退出</a></li>
			</ul>
		</div>
	</div>
	<!--头部 结束-->
<!--左侧导航 开始-->
	<div class="menu_box">
		<ul>
            <li>
            	<h3><i class="fa fa-fw fa-clipboard"></i>內容管理</h3>
                <ul class="sub_menu">
                    <li><a href="{{url('admin/category')}}" target="main"><i class="fa fa-fw fa-list-ul"></i>分類列表</a></li>
                    <li><a href="{{url('admin/article')}}" target="main"><i class="fa fa-fw fa-list-ul"></i>文章列表</a></li>
                    <li><a href="{{url('admin/links')}}" target="main"><i class="fa fa-fw fa-list-ul"></i>連結列表</a></li>
                </ul>
            </li>
            <li>
            	<h3><i class="fa fa-fw fa-cog"></i>系統設置</h3>
                <ul class="sub_menu">
                    <li><a href="{{url('admin/navs')}}" target="main"><i class="fa fa-fw fa-navicon"></i>首頁導航</a></li>
                    <li><a href="{{url('admin/config')}}" target="main"><i class="fa fa-fw fa-cubes"></i>網站設置</a></li>
                </ul>
            </li>
<!--            <li>
            	<h3><i class="fa fa-fw fa-thumb-tack"></i>工具导航</h3>
                <ul class="sub_menu">
                    <li><a href="http://www.yeahzan.com/fa/facss.html" target="main"><i class="fa fa-fw fa-font"></i>图标调用</a></li>
                    <li><a href="http://hemin.cn/jq/cheatsheet.html" target="main"><i class="fa fa-fw fa-chain"></i>Jquery手册</a></li>
                    <li><a href="http://tool.c7sky.com/webcolor/" target="main"><i class="fa fa-fw fa-tachometer"></i>配色板</a></li>
                    <li><a href="element.html" target="main"><i class="fa fa-fw fa-tags"></i>其他组件</a></li>
                </ul>
            </li>-->
        </ul>
	</div>
	<!--左侧导航 结束-->

	<!--主体部分 开始-->
	<div class="main_box">
		<iframe src="{{url('admin/info')}}" frameborder="0" width="100%" height="100%" name="main"></iframe> 
	</div>
	<!--主体部分 结束-->

	<!--底部 开始-->
	<div class="bottom_box">
		CopyRight © <?= date('Y')?>. Powered By <a href=""></a>.
	</div>
	<!--底部 结束-->
@endsection

	

	