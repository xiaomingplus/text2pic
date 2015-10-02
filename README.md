
## php文字生成图片(使用composer构建)

生成后的图片界面是仿照锤子便签的生成长微博的界面,使用的是苹方字体,你也可以选择使用你自己的喜欢的字体,非常容易配置。




### 如何使用？

使用composer安装本模块后，仅仅需要3行代码就可以生成了：

	$ composer require dsgygb/text2pic
	$ touch test.php

---	

	<?php
	
	require 'vendor/autoload.php';
	
	$transform = new Text2pic\Transform('by text2pic');
	$result = $transform->generate("hello world");
	print_r($result);
---
在浏览器访问该网页:

	output:
	
	Array
	(
    [code] => 200,
    [message] => ok,
    [data] => Array
        (
            [url] => "pic url",
            [path] => "pic path"
        )

	)
	

### 详细参数

#### 实例化

	$transform=new Text2pic\Transform($by,$uploadsPath,$uploadsUrl,$fontPath);
	
	
> *$by* :可选,string,生成后的图片的后缀,默认为空;

> *$uploadsPath*:可选,string,保存生成后的图片的路径,如果填写此参数,则必须填写*$uploadsUrl*:参数,默认为当前的包下面的'src/Publics/uploads';

> *$uploadsUrl*:可选,string,自定义路径后的该路径的url访问的绝对地址;

> *$fontpath*: 可选,string,自定义字体文件的路径


#### 调用生成图片的方法

	$transform->generate($text,$footer);
	
> *$text*:必填,string,填写生成图片的内容。支持"\n"换行

> *$footer*:可选,string,填写图片左下角的小号的字


#### 调用返回

	Array
	(
    [code] => 200,
    [message] => ok,
    [data] => Array
        (
            [url] => "pic url",
            [path] => "pic path"
        )

	)
	
> 如果返回的数组的code==200，则成功生成,其他情况则生成失败，调用message查看错误信息。

> data里的url是生成的图片网址,path是生成图片的路径，你可以用这个路径去上传图片到又拍云或者其他地方，然后可以unlink（删除）这个文件。
	
		

图片示例:
![](https://github.com/dsgygb/text2pic/blob/master/src/Publics/images/sample_pic.jpg?raw=true)


欢迎使用和提建议。


