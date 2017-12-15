<?php

namespace gophp\upload\driver;

use gophp\config;
use gophp\upload\contract;

class oss extends contract {

    public function file($inputName)
    {

        $this->config = config::get('oss', 'upload');

        dump($this->config);

    }

    public function getError()
    {
        // TODO: Implement getError() method.
    }


}