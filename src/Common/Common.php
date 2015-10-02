<?php
namespace Text2pic\Common;

class Common{
public static function fileName (){
	return 'pic_'.time().rand(1111,9999);
}

public static function strDiv($str, $width = 10){
	$strArr = array();
	$len = strlen($str);
	$count = 0;
	$flag = 0;
	while($flag < $len){
		if(ord($str[$flag]) > 128){
			$count += 1;
			$flag += 3;
		}
		else{
			$count += 0.5;
			$flag += 1 ;
		}
		if($count >= $width){
			$strArr[] = substr($str, 0, $flag);
			$str = substr($str, $flag);
			$len -= $flag;
			$count = 0;
			$flag = 0;
		}
	}
	$strArr[] = $str;
	return $strArr;
}

public static function str2rgb($str)
{
	$color = array('red'=>0, 'green'=>0, 'blue'=>0);
	$str = str_replace('#', '', $str);
	$len = strlen($str);
	if($len==6){
		$arr=str_split($str,2);
		$color['red'] = (int)base_convert($arr[0], 16, 10);
		$color['green'] = (int)base_convert($arr[1], 16, 10);
		$color['blue'] = (int)base_convert($arr[2], 16, 10);
		return $color;
	}
	if($len==3){
		$arr=str_split($str,1);
		$color['red'] = (int)base_convert($arr[0].$arr[0], 16, 10);
		$color['green'] = (int)base_convert($arr[1].$arr[1], 16, 10);
		$color['blue'] = (int)base_convert($arr[2].$arr[2], 16, 10);
		return $color;
	}
	return $color;
}

public static function imagelinethick($image, $x1, $y1, $x2, $y2, $color, $thick = 1)
{
    /* 下面两行只在线段直角相交时好使
    imagesetthickness($image, $thick);
    return imageline($image, $x1, $y1, $x2, $y2, $color);
    */
    if ($thick == 1) {
        return imageline($image, $x1, $y1, $x2, $y2, $color);
    }
    $t = $thick / 2 - 0.5;
    if ($x1 == $x2 || $y1 == $y2) {
        return imagefilledrectangle($image, round(min($x1, $x2) - $t), round(min($y1, $y2) - $t), round(max($x1, $x2) + $t), round(max($y1, $y2) + $t), $color);
    }
    $k = ($y2 - $y1) / ($x2 - $x1); //y = kx + q
    $a = $t / sqrt(1 + pow($k, 2));
    $points = array(
        round($x1 - (1+$k)*$a), round($y1 + (1-$k)*$a),
        round($x1 - (1-$k)*$a), round($y1 - (1+$k)*$a),
        round($x2 + (1+$k)*$a), round($y2 - (1-$k)*$a),
        round($x2 + (1-$k)*$a), round($y2 + (1+$k)*$a),
    );
    imagefilledpolygon($image, $points, 4, $color);
    return imagepolygon($image, $points, 4, $color);
}

public static function makeimger($text = "内容获取失败...",$types,$ids,$fontPath,$by="",$footer=""){
	$setStyle = '5f574c|FDFCF5'; #设置颜色,也可以开发为页面可选择并传递这个参数
	$haveBrLinker = ""; #超长使用分隔符
	$userStyle = explode('|', $setStyle); #分开颜色
	$text = substr($text, 0, 10000); #截取前1024个字符
	$imgpath = "".$types."/"; #图片存放地址

	if(!is_dir($imgpath)){ 


throw new \Exception("未找到上传目录");
		 }
	$imgfile =  $imgpath . $ids . '.jpg';
	if(file_exists($imgfile))
	{
	return $imgfile;	
	}
	else
	{
	//这里是边框宽度，可传递参数
	$paddingTop = 100;
	$paddingLeft = 64;
	$paddingBottom = 60;
	$copyrightHeight = 100;
	
	$canvasWidth = 659;
	$canvasHeight = $paddingTop + $paddingBottom + $copyrightHeight;
	
	$fontSize = 24;
	$lineHeight = intval($fontSize * 3.0);
	
	$textArr = array();
	$tempArr = explode("\n", trim($text));
	$j = 0;
	foreach($tempArr as $v){
		$arr = Common::strDiv($v, 16);
		$textArr[] = array_shift($arr);
		foreach($arr as $v){
			$textArr[] = $haveBrLinker . $v;
			$j ++;
			if($j > 100){ break; }
		}
		$j ++;
		if($j > 100){ break; }
	}
	
	$textLen = count($textArr);

$footerLen = 0;
	if($footer!=""){
	$footerArr = array();
	$footerTempArr = explode("\n", trim($footer));
	$jj = 0;
	foreach($footerTempArr as $v){
		$arrFooter = Common::strDiv($v, 25);
		$textArrFooter[] = array_shift($arrFooter);
		foreach($arrFooter as $v){
			$textArrFooter[] = $haveBrLinker . $v;
			$jj ++;
			if($jj > 100){ break; }
		}
		$jj ++;
		if($jj > 100){ break; }
	}
	
	$footerLen = count($textArrFooter);
}

$byLen = 0;
	if($by!=""){
	$byArr = array();
	$byTempArr = explode("\n", trim($by));
	$jjj = 0;
	foreach($byTempArr as $v){
		$arrby = Common::strDiv($v, 28);
		$textArrby[] = array_shift($arrby);
		foreach($arrby as $v){
			$textArrby[] = $haveBrLinker . $v;
			$jjj ++;
			if($jjj > 100){ break; }
		}
		$jjj ++;
		if($jjj > 100){ break; }
	}
	
	$byLen = count($textArrby);
}



	
	$canvasHeight = $lineHeight * $textLen + $canvasHeight+$footerLen*(16*2)+$byLen*(16*2);
	$im = imagecreatetruecolor($canvasWidth, $canvasHeight); #定义画布
	$colorArray = Common::str2rgb($userStyle[1]);
	imagefill($im, 0, 0, imagecolorallocate($im, $colorArray['red'], $colorArray['green'], $colorArray['blue']));
	
	$colorArray = Common::str2rgb('#e8e6da');
	$colorLine = imagecolorallocate($im, $colorArray['red'], $colorArray['green'], $colorArray['blue']);
	$padding = 50;

	$paddingBottom=130;
	$y1 = $y2 = $padding;

	$x1 =$x4= $padding-32;
	$x2 = $x3 = $canvasWidth - $padding+32 -  1;


	// $y3 = $y4 = $canvasHeight - $paddingBottom - 120;
		$y3 = $y4 = $lineHeight*$textLen+$footerLen*(16*2)+$paddingTop+50;

	//可以开发为页面可选择并传递这个参数,选择是否显示边框以及颜色
	Common::imagelinethick($im, $x1, $y1, $x2, $y2, $colorLine,2);
	Common::imagelinethick($im, $x2, $y2, $x3, $y3, $colorLine,2);
	Common::imagelinethick($im, $x3, $y3, $x4, $y4, $colorLine,2);
	Common::imagelinethick($im, $x4, $y4, $x1, $y1, $colorLine,2);

    $y1 = $y2 = $padding-4;

	$x1 =$x4= $padding-32-4;
	$x2 = $x3 = $canvasWidth - $padding+32 +4;
	// $y3 = $y4 = $canvasHeight - $paddingBottom - 36+20-100;
			$y3 = $y4 = $lineHeight*$textLen+$footerLen*(16*2)+$paddingTop+54;

	Common::imagelinethick($im, $x1, $y1, $x2, $y2, $colorLine,2);
	Common::imagelinethick($im, $x2, $y2, $x3, $y3, $colorLine,2);
	Common::imagelinethick($im, $x3, $y3, $x4, $y4, $colorLine,2);
	Common::imagelinethick($im, $x4, $y4, $x1, $y1, $colorLine,2);

	//字体路径，,也可以开发为页面可选择并传递这个参数
	$fontStyle = $fontPath;
	if(!is_file($fontStyle)){
		throw new \Exception("未找到字体文件");

	}
	
	//写入四个随机数
	$colorArray = Common::str2rgb($userStyle[0]);
	$fontColor = imagecolorallocate($im, $colorArray['red'], $colorArray['green'], $colorArray['blue']);
	
	foreach($textArr as $k=>$text){
		$offset = $paddingTop + $lineHeight * ($k + 1) - intval(($lineHeight-$fontSize) / 2);
		imagettftext($im, $fontSize, 0, $paddingLeft, $offset, $fontColor, $fontStyle, $text);
	}

	$lineHeightFooter = intval(16 * 2.2);

	if($footer!=""){
		$currentTop = $lineHeight*$textLen+$paddingTop;
	$fontColor = imagecolorallocate($im, 200, 198, 190);
foreach($textArrFooter as $k=>$footer){
		$offset =  $currentTop+$lineHeightFooter * ($k + 1) - intval(($lineHeightFooter-16) / 2);
		imagettftext($im, 16, 0, $paddingLeft, $offset, $fontColor, $fontStyle, $footer);
	}
	}
		if($by!=""){

   $currentTop = $lineHeight*$textLen+$paddingTop+$lineHeightFooter*$footerLen+70;
	$fontColor = imagecolorallocate($im, 200, 198, 190);
	$lineHeightBy = intval(16 * 2.2);
foreach($textArrby as $k=>$by){
		$offset =  $currentTop+$lineHeightBy * ($k + 1) - intval(($lineHeightBy-16) / 2);
		imagettftext($im, 16, 0, $paddingLeft-25, $offset, $fontColor, $fontStyle, $by);
	}
	}
	imagejpeg($im, $imgfile,100);
	imagedestroy($im);
	//echo $imgfile;
    	//exit($imgfile);
	}
	return $ids.'.jpg';
}
}
?>