<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>{{$sitename}}</title>
    <meta name="Keywords" content="{{$keyword}}">
    <meta name="description" content="{{$description}}" />
    <link rel="stylesheet" href="{{asset('admin/css/index.css')}}" type="text/css" media="screen" />
    <script type="text/javascript" src="{{asset('admin/js/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('admin/js/tendina.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('admin/js/common.js')}}"></script>
    <script language="javascript">
        function logout()
        {
            if (confirm("您确定要退出控制面板吗？"))
                top.location = "{{URL('jb_admin/logout')}}";
            return false;
        }
    </script>
</head>
<body>
<!--顶部-->
<div class="top">
    <div style="float: left"><span style="font-size: 16px;line-height: 45px;padding-left: 20px;color: #fff">{{$sitename}}</span></div>
    <div id="ad_setting" class="ad_setting">
        <a class="ad_setting_a" href="javascript:; ">{{$admin}}</a>
        <ul class="dropdown-menu-uu" style="display: none" id="ad_setting_ul">
            <li class="ad_setting_ul_li"> <a href="{{URL('5538830c29f8a8e4/editpwd/'.$adminid)}}" target="menuFrame"><i class="icon-user glyph-icon"></i>修改密码</a> </li>
            <li class="ad_setting_ul_li"> <a href="javascript:;" onclick="logout()"><i class="icon-signout glyph-icon"></i> <span class="font-bold">退出</span> </a> </li>
        </ul>
        <img class="use_xl" src="{{asset('images/right_menu.png')}}" />
    </div>
</div>
<!--顶部结束-->
<!--菜单-->
<div class="left-menu">
    <ul id="menu">
        {!! $nav !!}

    </ul>
</div>

<!--菜单右边的iframe页面-->
<div id="right-content" class="right-content">
    <div class="content">
        <div id="page_content">
            <iframe id="menuFrame" name="menuFrame" src="{{URL('jb_admin/main')}}" style="overflow:visible;"
                    scrolling="yes" frameborder="no" width="100%" height="100%"></iframe>
        </div>
    </div>
</div>
</body>
</html>