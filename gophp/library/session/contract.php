<?php

namespace gophp\session;

abstract class contract
{


    abstract public function set($name, $value, $expire = null);

    abstract public function has($name);

    abstract public function get($name);

    abstract public function delete($name);

    abstract public function clean();


}