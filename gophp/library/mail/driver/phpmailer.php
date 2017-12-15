<?php

namespace gophp\mail\driver;

use gophp\mail\contract;
use gophp\view;

class phpmailer extends contract
{

    protected $data;
    public $config;
    public $mail;

    public function __construct($config)
    {

        $this->config = $config['phpmailer'];

        $this->mail   = new \PHPMailer();

        // 使用SMTP方式发送
        $this->mail->IsSMTP();

        // 邮局服务器地址
        $this->mail->Host = $this->config['host'];

        // 邮局服务器端口
        $this->mail->Port = $this->config['port'];

        // 设置编码
        $this->mail->CharSet  = 'UTF-8';

        // 启用SMTP验证功能
        $this->mail->SMTPAuth = $this->config['auth'];

        // 发件人email地址
        $this->mail->Username = $this->config['user'];

        // 发件人email密码
        $this->mail->Password = $this->config['password'];

        // 发件人email地址
        $this->mail->From     = $this->config['user'];

        // 发件人昵称
        $this->mail->FromName = $this->config['name'];

        // 是否使用HTML格式
        $this->mail->IsHTML(true);

        // 邮件标题
        $this->mail->Subject = $this->config['title'];

        // 邮件内容
        $this->mail->Body = $this->config['body'];

    }

    public function from($from, $name)
    {

        // 发件人email地址
        $this->mail->From = $from;

        // 发件人email昵称
        $this->mail->FromName = $name;

        return $this;

    }

    public function auth($auth = true)
    {

        $this->mail->SMTPAuth = $auth;

        return $this;
    }

    public function to($to, $name = '')
    {

        $this->data['to'] = $to;

        $this->mail->AddAddress($to, $name);

        return $this;

    }

    public function title($title)
    {

        $this->data['title'] = $title;
        $this->mail->Subject = $title;

        return $this;

    }

    public function attachment($path, $name = '')
    {

        $extension = pathinfo($path, PATHINFO_EXTENSION);

        $name      = $name ? $name . '.' . $extension : '';

        $this->mail->AddAttachment($path, $name);

        return $this;

    }

    public function body($body)
    {

        $this->data['body'] = $body;
        $this->mail->Body   = $body;

        return $this;

    }

    public function view($file, $data = [])
    {

        view::assign('mail', $data);

        $body = view::fetch($file);

        $this->data['body'] = $body;

        $this->mail->MsgHTML($body);


        return $this;

    }

    public function send()
    {

        if(!$this->data['to']) return '收件人地址不能为空';

        if(!$this->data['title']) return '邮件标题不能为空';

        if(!$this->data['body']) return '邮件内容不能为空';

        return $this->mail->send() ? true : $this->mail->ErrorInfo;

    }
}