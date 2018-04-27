 <?php
if(getGet('access2008_cmd')=='2'){
die('0');
}
if(getGet('access2008_cmd')=='3'){
die('1');
}
$php_path = dirname(__FILE__) .'/';
$php_url = dirname($_SERVER['PHP_SELF']) .'/';
$save_path ='upload/';
$save_url ='/upload/';
$ext_arr =array('gif','jpg','png','jpeg');
$max_size = 1024*500000;
$save_path = realpath($save_path) .'/';
if (empty($_FILES) === false) {
$file_name = $_FILES['Filedata']['name'];
$tmp_name = $_FILES['Filedata']['tmp_name'];
$file_size = $_FILES['Filedata']['size'];
if (!$file_name) {
exit("返回错误: 请选择文件。");
}
if (@is_dir($save_path) === false) {
exit("返回错误: 上传目录不存在。($save_path)");
}
if (@is_writable($save_path) === false) {
exit("返回错误: 上传目录没有写权限。($save_url)");
}
if (@is_uploaded_file($tmp_name) === false) {
exit("返回错误: 临时文件可能不是上传文件。($file_name)");
}
if ($file_size >$max_size) {
exit("返回错误: 上传文件($file_name)大小超过限制。最大".($max_size/1024)."KB");
}
$temp_arr = explode(".",$file_name);
$file_ext = array_pop($temp_arr);
$file_ext = trim($file_ext);
$file_ext = strtolower($file_ext);
if (in_array($file_ext,$ext_arr) === false) {
exit("返回错误: 上传文件扩展名是不允许的扩展名。");
}
$ymd = date("Ymd");
$save_path .= $ymd ."/";
$save_url .= $ymd ."/";
if (!file_exists($save_path)) {
mkdir($save_path);
}
$new_file_name = date("YmdHis") .'_'.rand(10000,99999) .'.'.$file_ext;
$file_path = $save_path .$new_file_name;
@chmod($file_path,0644);
if (move_uploaded_file($tmp_name,$file_path) === false) {
exit("返回错误: 上传文件失败。($file_name)");
}
$file_url = $save_url .$new_file_name;
$fileName =$new_file_name;
echo $file_url."|";
if(getPost("access2008_box_info_max")!=""){
}
}
function filekzm($a)
{
$c=strrchr($a,'.');
if($c)
{
return $c;
}else{
return '';
}
}
function getGet($v)
{
if(isset($_GET[$v]))
{
return $_GET[$v];
}else{
return '';
}
}
function getPost($v)
{
if(isset($_POST[$v]))
{
return $_POST[$v];
}else{
return '';
}
}
?>