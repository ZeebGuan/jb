
function delcfm()
{
    if(!confirm("确认要删除？"))
    {
        window.event.returnValue = false;
    }
}
function guanbi()
{
	document.getElementById("chuli").style.display='none'
}
