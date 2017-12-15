<?php

namespace gophp;

class curl
{

    private $curl;
    private $body;

    public $url;
    public $method;
    public $data;
    public $headers;
    public $time_out;

    public function __construct($url, $method, $data, $headers, $time_out = 20)
    {

        if(!extension_loaded('curl')) {

            throw new exception('Curl Error', 'Curl extension not install');

        }

        $this->url      = $url;
        $this->method   = strtoupper($method);
        $this->data     = $data;
        $this->headers  = $headers;
        $this->time_out = $time_out;


        $this->curl = curl_init(); //初始化CURL句柄

        // 设置请求方式
        curl_setopt($this->curl, CURLOPT_CUSTOMREQUEST,$this->method);

        if($this->method == 'GET' && $this->data && is_array($this->data)){

            $query = http_build_query($this->data);

            $query and $this->url = strpos($this->url, '?') !== false ? $this->url . '&' . $query :  $this->url . '?' . $query;

        }

        // 采用https方式调用，必须使用下面2行代码打开ssl安全校验。
        curl_setopt($this->curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($this->curl, CURLOPT_SSL_VERIFYHOST, false);
        // 只将结果返回，不自动输出任何内容。
        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, true);

        if($this->method == 'POST'){
            curl_setopt($this->curl, CURLOPT_POST, true);
            curl_setopt($this->curl, CURLOPT_POSTFIELDS, $this->data);

        }

        // 设置连接超时时间
        curl_setopt($this->curl, CURLOPT_TIMEOUT, $this->time_out);

        // TRUE 时追踪句柄的请求字符串，从 PHP 5.1.3 开始可用。这个很关键，就是允许你查看请求header
        curl_setopt($this->curl, CURLINFO_HEADER_OUT, true);

        // 设置请求的URL
        curl_setopt($this->curl, CURLOPT_URL, $this->url);

        curl_setopt($this->curl, CURLOPT_HTTPHEADER, $this->headers);

        return $this->curl;

    }

    public function getBody()
    {

        return curl_exec($this->curl);

    }

    public function getError()
    {

        return [
            'no'    => curl_errno($this->curl),
            'error' => curl_error($this->curl),
        ];

    }

    public function getInfo()
    {

        curl_exec($this->curl);

        return curl_getinfo($this->curl);

    }

    public function getHeader()
    {

        //返回response头部信息
        curl_setopt($this->curl, CURLOPT_HEADER, true);

        curl_setopt($this->curl, CURLOPT_NOBODY, true);

        $this->body = curl_exec($this->curl);

        $request_header  =  curl_getinfo($this->curl, CURLINFO_HEADER_OUT);

        $request_headers = array_filter(explode("\r\n", $request_header));

        $header_size     = curl_getinfo($this->curl, CURLINFO_HEADER_SIZE);

        $response_header  = substr($this->body, 0, $header_size);

        $response_headers = array_filter(explode("\r\n", $response_header));

        return [
            'request'  => $request_headers,
            'response' => $response_headers,
        ];

    }

    public function __destruct()
    {

        curl_close($this->curl);

    }


}
