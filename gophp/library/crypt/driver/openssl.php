<?php

namespace gophp\crypt\driver;

use gophp\crypt\contract;
use gophp\exception;

class openssl extends contract
{

    private $token;
    private $method;

    public function __construct($config)
    {

        if(!extension_loaded('openssl')) {

            throw new exception('openssl extension missing:', 'openssl extension not install');

        }

        $this->token  = $config['token'];
        $this->method = $config['method'];

    }

    public function encrypt($string){

        $data['iv']    = base64_encode(substr('fdakinel;injajdji',0,16));

        $data['value'] = openssl_encrypt(serialize($string), $this->method, $this->token,0, base64_decode($data['iv']));
        $encrypt       = base64_encode(json_encode($data));

        return $encrypt;

    }

    public function decrypt($encrypt)
    {

        $encrypt = json_decode(base64_decode($encrypt), true);

        $decrypt = openssl_decrypt($encrypt['value'], $this->method, $this->token, 0, base64_decode($encrypt['iv']));

        return unserialize($decrypt) ? unserialize($decrypt) : '';

    }



}