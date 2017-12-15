<?php

namespace gophp\mail;

abstract class contract
{

    abstract public function from($from, $name);

    abstract public function to($to, $name);

    abstract public function attachment($path, $name);

    abstract public function title($title);

    abstract public function body($body);

    abstract public function send();

}