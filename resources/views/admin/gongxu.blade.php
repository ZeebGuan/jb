<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>后台管理系统</title>
    <link href="{{asset('admin/css/style.css')}}" rel="stylesheet" type="text/css">
    <script language="javascript" src="{{asset('admin/laydate/laydate.js')}}"></script>
    <script language="javascript" src="{{asset('admin/js/jquery.js')}}"></script>
    <script language="javascript" src="{{asset('admin/js/index.js')}}"></script>
    <script language="javascript" src="{{asset('js/city.js')}}"></script>
    <script language="javascript">
        function gotopage()
        {
            page=document.getElementById("page").value;
            var url="{{URL('jb_admin/gongxu/'.$do)}}?id={{$id}}&title={{$title}}&page="+page;
            if(page=="")
            {
                alert("请输入页数！");
            }
            else
            {
                window.location.href=url;
            }

        }
        function queren(msg)
        {
            if(!confirm(msg))
            {
                window.event.returnValue = false;
            }
        }

    </script>
</head>
<body bgcolor="#ecf0f1" topmargin="0" leftmargin="0" rightmargin="0">
<div id="main">
    <div class="user">
        @if($do=='list')
        <div class="title"><span></span>工序搜索</div>
        <div class="user-search">
            <form name="form1" class="myform" method="get" action="{{URL('jb_admin/gongxu/list')}}">
                &nbsp;工序名称：<input type="text" name="title" class="text" value="{{$title}}" />
                <input type="submit" value="查找" class="button" /> <a href="{{URL('jb_admin/gongxu/list')}}">清楚搜索条件</a>
            </form>
        </div>
        <div class="user-list">
            <table width="100%" style="text-align:center;background-color:#fff; margin-top:30px; line-height:30px;" cellpadding="0" cellspacing="0">
                <tr class="tr">
                    <td>工序编号</td>
                    <td>工序名称</td>
                    <td>操作</td>
                </tr>
                @foreach($data as $e)
                    <tr  onmousemove=style.backgroundColor='#e8edf1' onmouseout=style.backgroundColor='#FFFFFF'>
                        <td>{!! $e->id !!}</td>
                        <td>{!! \App\Http\Controllers\FunctionController::highLight($e->title,$title,$color = "red") !!}</td>
                        <td>
                            <a href="{{URL('jb_admin/gongxu/edit/'.$e->id)}}">修改</a> |

                            <a href="{{URL('jb_admin/excsql/delgongxu/'.$e->id)}}" onclick="queren('确定要删除该工序吗？')">删除</a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
        <div class="user-page">
            <div align="center">{{$data->appends(['id'=>$id,'title'=>$title])->links()}}</div>
            <input class="text" type="text" name="page" id="page" value="" />
            <input type="submit" class="sub" value="GO" onclick="gotopage()" />
        </div>

        @elseif($do=='edit')
            <div class="title"><span></span>修改工序</div>
            <div class="user-search">
                <form name="form1" class="myform" method="post" action="{{URL('jb_admin/excsql/editgongxu/'.$data[0]->id)}}">
                    <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                    <table width="855" style="margin-top: 100px;" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td align="right" width="200">工序名称:</td>
                            <td><input type="text" class="input" name="title" value="{{$data[0]->title}}" nullmsg="请输入工序！" datatype="*"></td>
                        </tr>
                        <tr>
                            <td align="right"></td>
                            <td><input type="submit" value="更 新 工 序" style="width:100px; height:40px; line-height:40px; border:none; background:#333; color:#fff; font-size:14px; cursor:pointer; margin:20px 0px;"  /></td>
                        </tr>
                    </table>
                    <br /> <br /> <br /> <br />
                </form>
            </div>
            <div class="user-list">
            </div>

        @elseif($do=='add')
        <div class="title"><span></span>新增工序</div>
        <div class="user-search">
            <form name="form1" class="myform" method="post" action="{{URL('jb_admin/excsql/addgongxu')}}">
                <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                <table width="855" style="margin-top: 100px;" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td align="right" width="200">工序名称:</td>
                        <td><input type="text" class="input" name="title" value="" nullmsg="请输入供应商名称！" datatype="*" ajaxurl="{{URL('checkgongying')}}"></td>
                    </tr>
                    <tr>
                        <td align="right"></td>
                        <td><input type="submit" value="添加工序" style="width:100px; height:40px; line-height:40px; border:none; background:#333; color:#fff; font-size:14px; cursor:pointer; margin:20px 0px;"  /></td>
                    </tr>
                </table>
                <br /> <br /> <br /> <br />
            </form>
        </div>
        <div class="user-list">
        </div>
        @endif
    </div>
</div>
<script language="javascript" src="{{asset('admin/js/Validform_v5.3.2.js')}}"></script>
<script type="text/javascript">
    $(function(){
        $(".myform").Validform({
            tiptype:3,
            datatype:{
                "idcard":function(gets,obj,curform,datatype){
                    var Wi = [ 7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2, 1 ];// 加权因子;
                    var ValideCode = [ 1, 0, 10, 9, 8, 7, 6, 5, 4, 3, 2 ];// 身份证验证位值，10代表X;

                    if (gets.length == 15) {
                        return isValidityBrithBy15IdCard(gets);
                    }else if (gets.length == 18){
                        var a_idCard = gets.split("");// 得到身份证数组
                        if (isValidityBrithBy18IdCard(gets)&&isTrueValidateCodeBy18IdCard(a_idCard)) {
                            return true;
                        }
                        return false;
                    }
                    return false;

                    function isTrueValidateCodeBy18IdCard(a_idCard) {
                        var sum = 0; // 声明加权求和变量
                        if (a_idCard[17].toLowerCase() == 'x') {
                            a_idCard[17] = 10;// 将最后位为x的验证码替换为10方便后续操作
                        }
                        for ( var i = 0; i < 17; i++) {
                            sum += Wi[i] * a_idCard[i];// 加权求和
                        }
                        valCodePosition = sum % 11;// 得到验证码所位置
                        if (a_idCard[17] == ValideCode[valCodePosition]) {
                            return true;
                        }
                        return false;
                    }

                    function isValidityBrithBy18IdCard(idCard18){
                        var year = idCard18.substring(6,10);
                        var month = idCard18.substring(10,12);
                        var day = idCard18.substring(12,14);
                        var temp_date = new Date(year,parseFloat(month)-1,parseFloat(day));
                        // 这里用getFullYear()获取年份，避免千年虫问题
                        if(temp_date.getFullYear()!=parseFloat(year) || temp_date.getMonth()!=parseFloat(month)-1 || temp_date.getDate()!=parseFloat(day)){
                            return false;
                        }
                        return true;
                    }

                    function isValidityBrithBy15IdCard(idCard15){
                        var year =  idCard15.substring(6,8);
                        var month = idCard15.substring(8,10);
                        var day = idCard15.substring(10,12);
                        var temp_date = new Date(year,parseFloat(month)-1,parseFloat(day));
                        // 对于老身份证中的你年龄则不需考虑千年虫问题而使用getYear()方法
                        if(temp_date.getYear()!=parseFloat(year) || temp_date.getMonth()!=parseFloat(month)-1 || temp_date.getDate()!=parseFloat(day)){
                            return false;
                        }
                        return true;
                    }

                }

            }
        });
    })
</script>
</body>
</html>
