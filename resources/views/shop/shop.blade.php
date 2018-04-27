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
<div id="sd-content">
    <div class="sd-content">
        <div class="top-nav"><p>会员商店</p></div>
        <div class="shangcheng" style="margin: 20px 0px;">

            {{-- */$i=1;/* --}}
            @foreach($data as $e)
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
        <div class="page">{{$data->links()}}</div>

    </div>
</div>

<div class="clear"></div>
@include('shop.foot')
</body>
</html>