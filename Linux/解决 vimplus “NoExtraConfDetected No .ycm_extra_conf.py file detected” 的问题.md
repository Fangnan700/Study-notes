# 解决 vimplus “NoExtraConfDetected: No .ycm_extra_conf.py file detected” 的问题

在云服务器使用docker运行vimplus的时候，出现ycm的报错：

```shell
NoExtraConfDetected: No .ycm_extra_conf.py file detected
```

解决方法也很简单，打开当前用户目录下的vim配置文件：.vimrc，在文件末尾添加以下代码：

```v
let g:ycm_global_ycm_extra_conf='~/.ycm_extra_conf.py'
let g:ycm_confirm_extra_conf = 0
```



