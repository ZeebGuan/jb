<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>后台管理系统</title>
    <link href="{{asset('admin/css/style.css')}}" rel="stylesheet" type="text/css">
    <script language="javascript" src="{{asset('admin/laydate/laydate.js')}}"></script>
    <script language="javascript" src="{{asset('admin/js/jquery.js')}}"></script>
</head>
<body bgcolor="#ecf0f1" topmargin="0" leftmargin="0" rightmargin="0">
<div id="main">
    @if($do=='info')
        <div class="user">
            <div class="title"><span></span>网站配置</div>
            <div class="site">
                <form name="form1" class="site" action="{{URL('jb_admin/excsql/site/1')}}" method="post">
                    <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                    <table width="700" align="center" border="0" cellspacing="0" cellpadding="0" style="line-height:50px;text-align:left">

                        <tr>
                            <td width="200" align="right">网站名称:</td>
                            <td><input type="text" class="text" name="sitename" value="{{$data[0]->sitename}}" /></td>
                        </tr>
                        <tr>
                            <td  align="right">关键字:</td>
                            <td><input type="text" class="text" name="keyword" value="{{$data[0]->keyword}}" /></td>
                        </tr>
                        <tr>
                            <td  align="right">描述:</td>
                            <td><textarea id="description" name="description" style="width:400px; font-size:12px; height:100px;">{{$data[0]->description}}</textarea></td>
                        </tr>
                        <tr>
                            <td  align="right">电话:</td>
                            <td><input type="text"  class="text" name="phone" value="{{$data[0]->phone}}" /></td>
                        </tr>

                        <tr>
                            <td  align="right">联系地址:</td>
                            <td><input type="text"  class="text" name="dizhi" value="{{$data[0]->dizhi}}" />
                            </td>
                        </tr>
                        <tr>
                            <td  align="right">邮箱:</td>
                            <td><input type="text"  class="text" name="email" value="{{$data[0]->email}}" />
                            </td>
                        </tr>
                        <tr>
                            <td  align="right">QQ:</td>
                            <td><input type="text"  class="text" name="qq" value="{{$data[0]->qq}}" />
                            </td>
                        </tr>
                        <tr>
                            <td  align="right">传真号码:</td>
                            <td><input type="text"  class="text" name="fax" value="{{$data[0]->fax}}" />
                            </td>
                        </tr>
                        <tr>
                            <td  align="right">原料库存警戒值:</td>
                            <td><input type="text"  class="text" name="kucun" value="{{$data[0]->kucun}}" />
                            </td>
                        </tr>
                        <tr>
                            <td  align="right">JS代码:</td>
                            <td>
                                <textarea id="kefu" name="kefu" style="width:400px;font-size:12px; height:100px;margin-top:10px;">{{$data[0]->kefu}}</textarea>
                            </td>
                        </tr>
                        <tr>
                            <td  align="right">统计代码:</td>
                            <td>
                                <textarea id="cnzz" name="cnzz" style="width:400px; line-height:24px;font-size:12px; height:100px;margin-top:10px;">{{$data[0]->cnzz}}</textarea>
                            </td>
                        </tr>
                        <tr>
                            <td  align="right">注册状态:</td>
                            <td>
                                <input type="radio" name="regstation" value="1" @if($data[0]->regstation=='1')checked @endif  />打开
                                <input type="radio" name="regstation" value="0" @if($data[0]->regstation=='0')checked @endif  />关闭
                                <font color="#FF0000">@if($data[0]->regstation=='1')注册开放中@else 已关闭注册 @endif </font>
                            </td>
                        </tr>
                        <tr>
                            <td  align="right">网站状态:</td>
                            <td>
                                <input type="radio" name="station" value="1" @if($data[0]->station=='1')checked @endif  />打开
                                <input type="radio" name="station" value="0" @if($data[0]->station=='0')checked @endif   />关闭
                                <font color="#FF0000">@if($data[0]->station=='1')网站开启中@else 网站关闭中 @endif</font>
                            </td>
                        </tr>

                        <tr>
                            <td  align="right"></td>
                            <td><input type="submit" class="sub" value="更新" style="padding:10px 20px;" /><br /><br /><br /></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    @endif
</div>
</body>
</html>


