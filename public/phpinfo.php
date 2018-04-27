<?php
goto a;
echo 'Foo';//此句被略过

a:
echo 'Bar';
//上面的例子输出结果为： Bar;

for($i=0,$j=50; $i<100; $i++) {
 while($j--) {
  if($j==17) goto end;
 }
}
echo "i = $i";
end:
echo 'j hit 17';

//上面的例子输出结果为： j hit 17
?><?php
 phpinfo();
?><?php
 phpinfo();
?><?php
 phpinfo();
?><?php
 phpinfo();
?><?php
 phpinfo();
?>