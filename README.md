
## php文字转图片接口

使用php实现，生成后的图片界面是仿照锤子便签的生成长微博的界面,使用的是苹方字体,你也可以选择使用你自己的喜欢的字体,非常容易配置。



图片示例:
![](http://static.scuinfo.com/uploads/9423003ddd9a956e81aecfbb1f762b4b.jpg)

### 如何使用？

```git clone```或下载后，将根目录下的```config.php.example``` 改为```config.php```

然后修改config.php的配置项，可选择是否开启又拍云的上传，默认关闭。配置好项目的绝对网址，一切就已经就绪了。

### 接口API

		{
		method:"post",
		url:"/index.php",
		params:{
		text:"" //要生成文字的内容
		},
		return:
		{
    	"code": 200,
    	"message": "ok",
    	"data": {
        		"url": "http://static.scuinfo.com/uploads/9423003ddd9a956e81aecfbb1f762b4b.jpg"
    			}
		}
		}
		
		
ps代码写的比较糟，但是能用^_^,源代码根据网络上的7384长微博文字生成图片系统 v0.1做了比较多的修改而成，原作者链接已访问不了，在这表达敬意。

在这个地址下载的源代码:http://www.softhy.net/soft/34246.htm 

修改的内容除了界面的全新修改，还有：源代码是gbk的，我转成了utf8，以及把整体的架构变的更有条理一些。





