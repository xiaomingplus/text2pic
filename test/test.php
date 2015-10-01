<?php

require '../vendor/autoload.php';
$example1 = "示例图片:\n本图片自豪的使用php构建。\n生成后的图片界面是仿锤子便签生成长微博的界面,使用苹方字体,你也可以选择使用你自己的喜欢的字体,一切都非常容易配置。\n"."使用好用的composer，这一切只需要三行语句就能生成，不信你看：\n".'require "vendor/autoload.php";'."\n".'$pic = new Text2pic\Transform();'.'$r = $pic->generate("hello");'."\n愉快的开始使用它吧!";
$example2 = "hello world!";
$transform = new Text2pic\Transform('by text2pic');
$result = $transform->generate($example2);
if($result['code']==200){

print_r($result);
echo '<img src="'.$result['data']['url'].'"/>';
}else{
echo $result['message'];
}
?>