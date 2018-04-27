<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>{{$sitename}}</title>
    <meta name="Keywords" content="{{$keyword}}">
    <meta name="description" content="{{$description}}" />
    <link rel="shortcut icon" href="/favicon.ico" />
    <link href="{{asset('css/style.css')}}" rel="stylesheet" type="text/css">
    <script src="{{asset('js/jquery.js')}}" type="text/javascript"></script>
</head>
<body  style="background:#eeefef;" topmargin="0" leftmargin="0" rightmargin="0">

@include('member.top')
<div id="main">
    <div class="siteinfo">
        <div class="banben"><!--当前最新版本：2.2.0--></div>
        <div class="contact"><br /><br /><br /><br />
            客服电话：{{$phone}}<br />
            客服邮箱：{{$email}}
        </div>
    </div>
</div>
</body>
</html>
