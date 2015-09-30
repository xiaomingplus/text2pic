<?php

require '../vendor/autoload.php';

$transform = new Dsgygb\Text2pic\Transform('by text2pic');
$result = $transform->generate("hello\nworld!");

if($result['code']==200){
echo '<img src="'.$result['data']['url'].'"/>';
}else{
echo $result['message'];
}
?>