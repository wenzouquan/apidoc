<?php

namespace gophp;

use gophp\traits\driver;

class queue
{

    use driver;

    private function __construct()
    {

        return $this->handler(config::get('queue'));

    }

}