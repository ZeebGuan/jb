@if(\App\Http\Controllers\FunctionController::siteinfo('station')=="0")
<script language=javascript>window.top.location.href='{{URL('update')}}';</script>";}
@endif
<div id="top">
    <div class="top">
        <div class="logo"><a href="{{URL('shop')}}"></a></div>
        <div class="nav">
            <li class="icon1"><a href="{{URL('shop/zhongchou')}}">明日众筹</a></li>
            <li class="icon2"><a href="{{URL('shop/shop')}}">会员商店</a></li>
            <li class="icon3"><a href="http://www.mrgzcy.com/" target="_blank">创益平台</a></li>
            <li class="icon4"><a href="{{URL('shop/center')}}">会员中心</a></li>
        </div>
    </div>
</div>