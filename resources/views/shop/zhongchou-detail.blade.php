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
    <script language="javascript">
        function jianum()
        {
            var num=document.getElementById("jine").value;
            document.getElementById("jine").value=parseInt(num)+1;
        }
        function jiannum()
        {
            var num=document.getElementById("jine").value;
            document.getElementById("jine").value=parseInt(num)-1;
        }
    </script>
    <script src="{{asset('js/ZoomPic.js')}}"></script>
</head>

<body>
@include('shop.top')
<div class="clear"></div>
<div id="content">
    <div class="content">
        <div class="c-title"><p>{{$data[0]->title}}</p></div>
        <div class="c-top">
            <div id="focus_Box" style="margin-left:60px; margin-right:40px;">
                <span class="prev">&nbsp;</span>
                <span class="next">&nbsp;</span>
                <ul>
                    @foreach($pic as $e)
                        <li><a href="javascript:;"><img src="http://www.mrgzcy.com{{trim($e->pic)}}"></a></li>
                    @endforeach
                </ul>
            </div>
            <div class="right">
                <div class="jindu"><span style="width:{{\App\Http\Controllers\FunctionController::zhongchou($data[0]->id,3)}}%"></span></div>
                <div class="baifenbi">众筹进度 <p>最大限购：{{$data[0]->xiangou}}份</p><font>{{\App\Http\Controllers\FunctionController::zhongchou($data[0]->id,3)}}%</font></div>
                <form name="form1" class="css" method="post" action="{{URL('shop/check-toubiao/'.$id)}}">
                    <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                    <div class="gentou">
                        <span>跟投份额：</span>
                        <input type="button" name="jian" value="" class="button" onclick="jiannum()" />
                        <input type="text" name="jine" id="jine" value="1" class="input" nullmsg="请输入跟投份数！" datatype="n" />
                        <input type="button" name="jia" value="" class="button" onclick="jianum()" />
                    </div>
                    <input type="submit" value="我要跟投" class="sumbit" />
                </form>
                <div class="info">
                    <li style="width:113px;">众筹创益币<br />{{\App\Http\Controllers\FunctionController::zhongchou($data[0]->id,1)}}/{{$data[0]->totel}}</li>
                    <li style="width:113px;">每份所需金币<br />{{$data[0]->jinbi}}</li>
                    <li style="width:113px;">每份所需银币<br />{{$data[0]->yinbi}}</li>
                </div>
                <div class="cs">发起方： {{$data[0]->faqi}}</div>
            </div>
        </div>
        <div class="x-nav">
            <a href="{{URL('shop/zhongchou-detail/'.$id)}}?type=0" @if($type=='0') class="hover" @endif>项目概况</a>
            <a href="{{URL('shop/zhongchou-detail/'.$id)}}?type=1" @if($type=='1') class="hover" @endif>众筹方案</a>
            <a href="{{URL('shop/zhongchou-detail/'.$id)}}?type=2" @if($type=='2') class="hover" @endif>认筹情况</a>
        </div>
        <div class="c-con">
            @if($type=='0')
            <div class="c-con-con">{!! $data[0]->intro !!}</div>
            @elseif($type=='1')
            <div class="c-con-con">{!!$data[0]->fangan !!}</div>
            @else
            <div class="c-con-con">
                <table width="100%" border="0" style="text-align:center; line-height:50px;" cellpadding="0" cellspacing="0">
                    <tr bgcolor="#dedede">
                        <td>序号</td>
                        <td>会员帐号</td>
                        <td>认筹份数</td>
                        <td>认筹创益币</td>
                        <td>认筹时间</td>
                        <td>类型</td>
                    </tr>
                    @foreach($zcdata as $e)
                        <tr>
                            <td>{{$count--}}</td>
                            <td>***{{substr($e->user,3)}}</td>
                            <td>{{$e->num}}</td>
                            <td>{{$e->jine}}</td>
                            <td>{{$e->shijian}}</td>
                            @if($e->type=='1')
                                <td><font color='#ff0000'>创益金币</font> </td>
                            @else
                                <td><font color='#0000ff'>创益银币</font> </td>
                            @endif

                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="5">{{$zcdata->appends(['type'=>$type])->links()}}</td>
                    </tr>
                </table>

            </div>
            @endif
        </div>
    </div>
</div>
<div class="clear"></div>
@include('shop.foot')
<script type="text/javascript">
    $(".css").Validform({
        tiptype:1,
    });
</script>
</body>
</html>