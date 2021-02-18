Vue Cli 脚手架使用帮助
===============

> 系统需要先安装 <font color=#00FF00> Node.js </font>  
> 然后运行脚手架安装命令 npm install -g @vue/cli

##<font color=#0099FF>安装快速开发原型后可以使用</font>
`npm run serve`启动测试服务器 和 `npm run build` 打包项目文件


~~~
npm install -g @vue/cli-service-global
~~~  

  
创建一个新项目 `hello world`
~~~
vue create hello-world
~~~

安装丢失的 <font color=#996600> node_modules </font> 文件夹
~~~
npm install express
~~~

history 模式下运行单页面生产环境
~~~
serve -s 文件目录名
~~~

更多详细介绍查看 Vue Cli [官方文档](https://cli.vuejs.org/zh/)  
  


安装Element-Plus
~~~
npm install element-plus --save
~~~

更多详细介绍查看 Element-Plus [官方文档](https://element-plus.gitee.io/#/zh-CN/component/installation)

###安装axios
~~~
npm i axios
~~~

####nginx设置接收跨域请求(实际部署不存在跨域问题)
```
在conf文件里server域名配置下location ~ \.php{*这里面添加*}
add_header 'Access-Control-Allow-Origin' '*' always;
```