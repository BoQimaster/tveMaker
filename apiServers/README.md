TveMaker 1.0
==============================

>本系统所用后台框架为 ThinkPHP 6.0 ，前台页面构建框架为 Vue 3.x 搭配 Element-Plus UI库 共同组合开发  

###<span style="color: #ff4d4d;">*请注意</span> 本项目是我自学编程的实践项目，不保证会持续更新

<span style="color: #ff4d4d;">项目先暂停</span> 规划有误，不应该把前后端搞在一起，需要分离前后端，后端只起到提供api接口、权限验证、文件上传、本地和oss、增删改查封装，
主要应该使用TP6的单应用模式、注解路由、中间件、事件、门面、服务等，后端只使用api.tvemaker.com这个接口地址。
  
后台管理和前台开放展示，采用VUE3.X+Element-plus，，实现功能主要包括：路由动态加载，axios 请求封装，接口规则封装，布局调整，通用列表，通用表单，通用增删改查功能封装。

phpmailer
php邮箱大师，配合发送验证邮件