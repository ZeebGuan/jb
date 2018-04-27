<SCRIPT LANGUAGE=javascript>
    function logout() {
        var msg = "确定要退出登录吗？";
        if (confirm(msg)==true){
            window.top.location.href="{{URL('logout')}}";
        }else{
            return false;
        }
    }
</SCRIPT>
@if(\App\Http\Controllers\FunctionController::siteinfo('station')=="0")
    <script language=javascript>window.top.location.href='{{URL('update')}}';</script>";}
@endif
@if(Request::getRequestUri()!='/info-pwd')
    @if(\App\Http\Controllers\FunctionController::ispwdedit(Session::get('id'),1)!="1" || \App\Http\Controllers\FunctionController::ispwdedit(Session::get('id'),0)!="1")
        <div id="mess" style="display: block">
            <div class="con">
                <br><br><br>
                <b style="color: #ff0000; font-size: 18px;">温馨提示</b><br><br><br>
                @if(\App\Http\Controllers\FunctionController::ispwdedit(Session::get('id'),1)=="2")
                    为了您的账号安全，请您修改您的 <font color="#ff0000">登陆密码</font> 及 <font color="#ff0000">二级密码</font>。<br><br><br><br>
                @elseif(\App\Http\Controllers\FunctionController::ispwdedit(Session::get('id'),1)=="1")
                    @if(\App\Http\Controllers\FunctionController::ispwdedit(Session::get('id'),0)=="0")
                        为了您的账号安全，请您修改您的 <font color="#ff0000">二级密码</font>。<br><br><br>
                    @endif
                @else
                    @if(\App\Http\Controllers\FunctionController::ispwdedit(Session::get('id'),0)=="0")
                        为了您的账号安全，请您修改您的 <font color="#ff0000">登陆密码</font> 及 <font color="#ff0000">二级密码</font>。<br><br><br>
                    @elseif(\App\Http\Controllers\FunctionController::ispwdedit(Session::get('id'),0)=="1")
                        为了您的账号安全，请您修改您的 <font color="#ff0000">登陆密码</font>。<br><br><br>
                    @endif
                @endif
                <a href="{{URL('info-pwd')}}"><font style="background: #dedede; color:#000000; padding: 10px;">前往修改</font></a> <br><br><br>
            </div>
        </div>
    @endif
@endif
<div id="top">
    <div class="nav">
        <ul class="dropdown">
            <li><a href="{{URL('gonggao')}}"
            @if(Request::getRequestUri()=='/gonggao')
                style='background:url({{asset('images/icon_03.png')}}) no-repeat center bottom;'
            @endif
             >系统公告</a></li>
            <li><a href="{{URL('xiaoxi')}}"
            @if(Request::getRequestUri()=='/xiaoxi')
                style='background:url({{asset('images/icon_03.png')}}) no-repeat center bottom;'
            @endif
                >系统消息</a></li>
            <li><a href="{{URL('siteinfo')}}"
                   @if(Request::getRequestUri()=='/siteinfo')
                   style='background:url({{asset('images/icon_03.png')}}) no-repeat center bottom;'
                   @endif
            >系统设置</a></li>
            <li><a href="{{URL('baodan-index')}}"
                   @if(Request::getRequestUri()=='/baodan-index')
                   style='background:url({{asset('images/icon_03.png')}}) no-repeat center bottom;'
                        @endif
                >会员注册</a></li>
            <li><a href="javascript:;" onclick="javascript:return logout()" target="_top">退出登录</a></li>
            <li><a href="http://www16.53kf.com/webCompany.php?arg=10150588&style=1&language=cn&charset=GBK&kflist=off&kf=&zdkf_type=1&referer=http%3A%2F%2Fwww.mrgzcy.com%2Fmain&keyword=http%3A%2F%2Fwww.mrgzcy.com%2Findex.html&tfrom=1&tpl=crystal_blue&uid=356c92e5de13d89c01336826e9c9117d&timeStamp=1488428859495&ucust_id=" target="_blank">客服中心</a></li>
            <li><a href="{{URL('shop')}}" target="_blank">众筹平台</a></li>
        </ul>
    </div>
    <div class="search">
        <form>
            <input name="keyword" class="text" id="keyword" onfocus="if(this.value=='Search here...'){this.value='';}" onblur="if(this.value==''){this.value='Search here...';}" type="text" value="Search here...">
            <input type="submit" value="" class="sub" />
        </form>
    </div>
</div>
<script language="javascript" src="{{ asset('js/nav.js') }}"></script>
<script type='text/javascript' src='http://tb.53kf.com/kf.php?arg=10150588&style=1'></script>
