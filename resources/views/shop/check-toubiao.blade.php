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
            document.getElementById("shuliang").value=parseInt(num)+1;
            document.getElementById("totelj").innerHTML=(parseInt(num)+1)*{{$data[0]->jinbi}};
            document.getElementById("totely").innerHTML=(parseInt(num)+1)*{{$data[0]->yinbi}};
        }
        function jiannum()
        {
            var num=document.getElementById("jine").value;
            if(num<=1)
            {
                document.getElementById("jine").value=1;
                alert("最少投标1份");
                document.getElementById("shuliang").value=1;
                document.getElementById("totelj").innerHTML={{$data[0]->jinbi}};
                document.getElementById("totely").innerHTML={{$data[0]->yinbi}};
            }
            else
            {
                document.getElementById("jine").value=parseInt(num)-1;
                document.getElementById("shuliang").value=parseInt(num)-1;
                document.getElementById("totelj").innerHTML=(parseInt(num)-1)*{{$data[0]->jinbi}};
                document.getElementById("totely").innerHTML=(parseInt(num)-1)*{{$data[0]->yinbi}};
            }
        }
        function jisuan()
        {
            var num=document.getElementById("jine").value;
            if(num<=1)
            {
                alert("最少投标1份");
                document.getElementById("jine").value=1;
                document.getElementById("shuliang").value=1;
                document.getElementById("totelj").innerHTML={{$data[0]->jinbi}};
                document.getElementById("totely").innerHTML={{$data[0]->yinbi}};
            }
            else
            {
                document.getElementById("shuliang").value=parseInt(num);
                document.getElementById("totelj").innerHTML=parseInt(num)*{{$data[0]->jinbi}};
                document.getElementById("totely").innerHTML=parseInt(num)*{{$data[0]->yinbi}};
            }
        }
    </script>
</head>

<body>
@include('shop.top')
<div class="clear"></div>
<div id="content">
    <div class="content">
        <div class="c-title"><p>确认投标信息</p>
            <span>账户余额： 创益金币 <font color="#ff0000"> {{$user[0]->jinbi}}</font>
            创益银币 <font color="#ff0000"> {{$user[0]->yinbi}}</font></span>
        </div>
        <div class="renzheng">
            <table width="100%" border="0" style="text-align:center" cellpadding="0" cellspacing="0">
                <tr bgcolor="#dedede">
                    <td>众筹信息</td>
                    <td>金币价格</td>
                    <td>银币价格</td>
                    <td>投标份额</td>
                    <td>金币总价</td>
                    <td>银币总价</td>
                </tr>
                <tr>
                    <td><a href="{{URL('shop/zhongchou-detail/'.$id)}}">{{$data[0]->title}}</a></td>
                    <td>{{$data[0]->jinbi}}</td>
                    <td>{{$data[0]->jinbi}}</td>
                    <td width="310">
                        <div class="gentou">
                            <span></span>
                            <input type="button" name="jian" value="" class="button" onclick="jiannum()" />
                            <input type="text" name="jine" id="jine" value="{{$jine}}" onchange="jisuan()" class="text"/>
                            <input type="button" name="jia" value="" class="button" onclick="jianum()" />
                            <span class="Validform_checktip" style="display:none"></span>
                        </div>
                    </td>
                    <td width="100"><font color="#FF0000" size="+2" id="totelj">{{$jine*$data[0]->jinbi}}</font></td>
                    <td width="100"><font color="#FF0000" size="+2" id="totely">{{$jine*$data[0]->yinbi}}</font></td>
                </tr>
            </table>
        </div>
        <div class="renzheng">
            <form name="form1" class="form" action="{{URL('shop/do/toubiao/'.$id)}}" method="post">
                <table width="100%" border="0" style="text-align:center" cellpadding="0" cellspacing="0">
                    <tr>
                        <td colspan="4">
                            <input type='hidden' value='{{$jine}}' name='num' id='shuliang'  datatype='n' nullmsg='参数错误，请重新下单'>
                            <font color="#ff0000">请选择支付类型：</font> <input type="radio" name="type" value="1" />创益金币
                            <input type="radio" name="type" value="0" checked/>创益银币
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4" style="padding-left:400px; padding-top:10px;">

                            <input type="submit" value="确认投标" class="sub" /></td>
                    </tr>

                </table>

            </form>
        </div>
    </div>
</div>
<div class="clear"></div>
@include('shop.foot')
</body>
</html>