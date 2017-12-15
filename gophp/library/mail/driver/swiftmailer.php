<?php

namespace gophp\mail\driver;

use gophp\config;
use gophp\mail\contract;
use gophp\traits\instance;

class phpmailer extends contract
{

    private $mail = null;

    private function __construct()
    {
        $this->config = config::get('mail');

        $this->mail = new \PHPMailer();

        // 使用SMTP方式发送
        $this->mail->IsSMTP();

        // 邮局服务器地址
        $this->mail->Host = $this->config['host'];

        // 邮局服务器端口
        $this->mail->Port = $this->config['port'];

        // 启用SMTP验证功能
        $this->mail->SMTPAuth = true;

        // 发件人email地址
        $this->mail->Username = $this->config['user'];

        // 发件人email密码
        $this->mail->Password = $this->config['password'];

        // 发件人email地址
        $this->mail->From = $this->config['from'];

        // 发件人昵称
        $this->mail->FromName = $this->config['nickname'];

        // 是否使用HTML格式
        $this->mail->IsHTML(true);

        // 邮件标题
        $this->mail->Subject = $this->config['title'];

        // 邮件内容
        $this->mail->Body = $this->config['body'];

    }

    public function from($from)
    {

        // 发件人email地址
        $this->mail->From = $from;

    }

    public function to($to)
    {

        $this->mail->AddAddress($to);

    }

    public function subject($key)
    {
        // TODO: Implement subject() method.
    }

    public function body($key)
    {
        // TODO: Implement body() method.
    }

    public function send()
    {
        $this->mail->send();
    }
}