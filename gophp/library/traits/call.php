<?php

namespace gophp\traits;

use gophp\exception;
use gophp\reflect;

trait call
{
    use instance;

    final public function __call($method, $arguments) {

        $methodAccess = reflect::getMethodAccess(self::class, $method);

        if($methodAccess != 'public' && $methodAccess != 'protected'){

            throw new exception('Call Error', 'Class ' . self::class . ' ' . $methodAccess .' method ' . str::quote($method) . '  no access');

        }

        return call_user_func_array([self::instance(), $method], $arguments);

    }

    final public static function __callStatic($method, $arguments) {

        $methodAccess = reflect::getMethodAccess(self::class, $method);

        if($methodAccess != 'public' && $methodAccess != 'protected'){

            throw new exception('CallStatic Error', 'Class ' . self::class . ' ' . $methodAccess .' method ' . $method . '  no access');

        }

        return call_user_func_array([self::instance(), $method], $arguments);

    }

}