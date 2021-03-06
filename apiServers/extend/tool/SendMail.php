<?php

namespace tool;

use PHPMailer\PHPMailer\PHPMailer;

class SendMail
{
    public function sendMail($to, $title, $content)
    {
        // 实例化PHPMailer
        $mail = new PHPMailer();

        // 是否启用smtp的debug进行调试 开发环境建议开启 生产环境注释掉即可 默认关闭debug调试模式
//        $mail->SMTPDebug = 3;

        // 使用第三方SMTP服务器时禁用本地检查
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );

        // 配置发送者信息
        $mail->isSMTP();// 使用SMTP服务
        $mail->SMTPAuth = true;// 是否使用身份验证
        $mail->Mailer = 'SMTP';
        $mail->SMTPSecure = 'ssl';
        $mail->Host = 'smtp.qq.com';
        $mail->Port = 465;
        $mail->CharSet = 'UTF-8';
        $mail->Username = '395222867@qq.com';
        $mail->Password = 'zwqxpqaoqbeabged';

        $mail->setFrom('395222867@qq.com','TveMaker');// 设置发件人信息
        // 邮件正文是否为html编码
        $mail->isHTML(true);

        // 接收者信息
        $mail->addAddress($to);// 设置收件人信息
        // $mail->addReplyTo("395222867@qq.com",'回复');// 设置回复人信息
        //$mail->addCC("xxx@163.com");// 设置邮件抄送人，可以只写地址，上述的设置也可以只写地址(这个人也能收到邮件)
        //$mail->addBCC("xxx@163.com");// 设置秘密抄送人(这个人也能收到邮件)
        //$mail->addAttachment("bug0.jpg");// 添加附件

        $mail->Subject = $title;// 邮件标题
        $mail->Body = $content;// 邮件正文
        //$mail->AltBody = "This is the plain text纯文本";// 这个是设置纯文本方式显示的正文内容，如果不支持Html方式，就会用到这个，基本无用

        $status = $mail->send();

        if(!$status){// 发送邮件
            return '发送错误: '.$mail->ErrorInfo;// 输出错误信息
        }else{
            return '发送成功';
        }


    }

}