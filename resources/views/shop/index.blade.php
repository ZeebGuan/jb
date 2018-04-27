<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>{{$sitename}}</title>
    <meta name="Keywords" content="{{$keyword}}">
    <meta name="description" content="{{$description}}" />
    <link rel="shortcut icon" href="/favicon.ico" />
    <link href="{{asset('css/shop-style.css')}}" rel="stylesheet" type="text/css">
    <script language="javascript" src="{{asset('js/jquery.js')}}"></script>
    <script language="javascript" src="{{asset('js/nav.js')}}"></script>
</head>

<body>
@include('shop.top')
<div class="clear"></div>
<div id="banner"></div>
<div class="clear"></div>
<div id="nav-zc">
    <div class="nav-zc">明日众筹</div>
</div>
<div class="clear"></div>
<div id="zc-content">
    <div class="zc-content">
        @foreach($zhongchou as $e)
        <div class="list">
            <div class="img"><img src="{{$e->pic}}" /></div>
            <div class="right">
                <div class="jindu"><span style="width:{{\App\Http\Controllers\FunctionController::zhongchou($e->id,3)}}%"></span></div>
                <div class="info">
                    <li><font color="#ed7e5f">{{\App\Http\Controllers\FunctionController::zhongchou($e->id,1)}}/{{$e->totel}}</font>众筹创益币</li>
                    <li><font>{{\App\Http\Controllers\FunctionController::zhongchou($e->id,2)}}</font>支持数</li>
                    <li><font>{{\App\Http\Controllers\FunctionController::zhongchou($e->id,3)}}%</font>众筹进度</li>
                </div>
                <div class="gengtou"><a href="{{URL('shop/zhongchou-detail/'.$e->id)}}">我要跟投</a></div>
                <div class="intro">
                    <a href="{{URL('shop/zhongchou-detail/'.$e->id)}}">{{$e->title}}</a>
                    {{\App\Http\Controllers\FunctionController::mysubstr(strip_tags($e->intro),0,130)}}
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
<div class="clear"></div>
<div id="nav-sd">
    <div class="nav-sd">会员商店</div>
</div>
<div class="clear"></div>
<div id="sd-content">
    <div class="sd-content">
        <div class="shangcheng">
            {{-- */$i=1;/* --}}
            @foreach($shangpin as $e)
                @if($i%4==0)
                    <li class='nobg'>
                @else
                    <li>
                @endif
                        <div class="top"></div>
                        <img src="{{$e->pic}}" width="250" height="216" onclick="window.location.href='{{URL('shop/shop-detail/'.$e->id)}}'" />
                        <a href="{{URL('shop/shop-detail/'.$e->id)}}"> {{\App\Http\Controllers\FunctionController::mysubstr($e->title,0,32)}}</a>
                        <p>创益金币:{{$e->jinbijiage}}</p> <font>创益银币:{{$e->yinbijiage}}</font>
                        <span onclick="window.location.href='{{URL('shop/shop-detail/'.$e->id)}}'">兑换</span>
                    </li>
                {{-- */$i++;/* --}}
            @endforeach
        </div>
    </div>
</div>
<div class="clear"></div>
@include('shop.foot')
</body>
</html>