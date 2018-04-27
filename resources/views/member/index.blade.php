<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>{{$sitename}}</title>
    <meta name="Keywords" content="{{$keyword}}">
    <meta name="description" content="{{$description}}" />
    <link rel="shortcut icon" href="/favicon.ico" />
    <link href="{{asset('css/style.css')}}" rel="stylesheet" type="text/css">
</head>
<frameset cols="328,*" frameborder="no" border="0" framespacing="0">
    <frame src="{{URL('left')}}" name="left" scrolling="yes" noresize="noresize" id="left" title="left" />
    <frame src="{{URL('main')}}" name="right" id="right" title="right" />
</frameset>
<noframes>
    <body onLoad= "javascript:window.resizeTo(screen.availWidth,screen.availHeight);window.moveTo(0,0) ">
    </body></noframes>
</html>
