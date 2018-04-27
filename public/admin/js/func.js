function logout()
{
	if (confirm("您确定要退出控制面板吗？"))
	top.location = "logout.php";
	return false;
}
function delcfm()
{
    if(!confirm("确认要删除？"))
    {
        window.event.returnValue = false;
    }
}
