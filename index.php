<?php

require './vendor/autoload.php';
$transform = new Text2pic\Common\Transform('by text2pic');
$result = $transform->generate("好烦啊hello\nworld!");

if($result['code']==200){
	print_r(get_declared_classes());

echo '<img src="'.$result['data']['url'].'"/>';
}else{
echo $result['message'];
}
?>