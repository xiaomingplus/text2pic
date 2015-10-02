<?php
namespace Text2pic;
use Text2pic\Publics\Path;
use Text2pic\Common\Common;
class Transform {

private $by = "";
private $fontPath;
private $uploadsPath;
private $uploadsUrl;
public function __construct($_by="",$_uploadsPath="",$_uploadsUrl="",$_fontPath=""){
$basePath = new Path();
$this->by = $_by;
if($_fontPath==""){
	$this->fontPath = $basePath->getPath()."/font/PingFangMedium.ttf";
}else{
	$this->fontPath =$_fontPath;
}
if($_uploadsPath==""){
$this->uploadsPath = $basePath->getPath()."/uploads";
$this->uploadsUrl = $basePath->getUrl()."/uploads";

}else{
$this->uploadsPath = $_uploadsPath;
	if($_uploadsUrl==""){
		$this->uploadsUrl = "";
    	}else{
$this->uploadsUrl = $_uploadsUrl;
	}
}
}


public function generate($text="",$footer=""){


if($text==""){

	   $result = array(
    "code"=>2001,
    "message"=>"缺少输入的内容,请在generate的第一个参数传入",
      );
    return $result;

}


if($this->uploadsPath==""){
	   $result = array(
    "code"=>2002,
    "message"=>"请在构造函数的第二个参数传入合法的上传路径",
      );
    return $result;
}


if($this->uploadsUrl==""){
	   $result = array(
    "code"=>2003,
    "message"=>"请在构造函数的第三个参数传入合法的上传路径的url",
      );
    return $result;

}

try {
$common = new Common();
$basePath = new Path();
$fileName = $common->fileName();
$sourceName=$common->makeimger($text,$this->uploadsPath,$fileName,$this->fontPath,$this->by,$footer);
  $result = array(
    "code"=>200,
    "message"=>"ok",
    "data"=>array(
      "url"=>$this->uploadsUrl.'/'.$sourceName,
      "path"=>$this->uploadsPath.'/'.$sourceName
      )
    );
    return $result;
} catch(\Exception $e){
	 $result = array(
    "code"=>2004,
    "message"=>$e->getMessage(),
      );
    return $result;

}

}





}