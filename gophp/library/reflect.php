<?php

namespace gophp;

class reflect
{

    private static $reflectionClass;

    // 获取类单例
    public static function getInstance($class, array $args = [])
    {

        $reflectionClass = self::getClass($class);

        if(!$reflectionClass->isInstantiable()) {

            throw new exception('Access to non-public constructor');

        }

        if($args){

            return $reflectionClass->newInstanceArgs($args);

        }

        return $reflectionClass->newInstance();

    }

    // 是否有指定类
    public static function hasClass($class)
    {

        if(!class_exists($class)){

            throw new exception('Class ' . $class .'  does not exist');

        }

        return true;

    }

    // 获取反射类
    private static function getClass($class)
    {

        if(self::$reflectionClass[$class]){

            return self::$reflectionClass[$class];

        }elseif(self::hasClass($class)){

            $reflectionClass = new \ReflectionClass($class);

            self::$reflectionClass[$class] = $reflectionClass;

            return $reflectionClass;

        }

    }

    // 获取不包括命名空间的类名
    public static function getName($class)
    {

        $reflectionClass = self::getClass($class);

        return $reflectionClass->getShortName();

    }

    // 是否有指定方法
    public static function hasMethod($class, $method)
    {

        $reflectionClass = self::getClass($class);

        return $reflectionClass->hasMethod($method);

    }

    // 获取反射方法
    public static function getMethod($class, $method)
    {


        if(!self::hasMethod($class, $method) && self::hasMethod($class, '__call')){

            return self::getClass($class)->getMethod('__call');

        }elseif(!self::hasMethod($class, $method) && !self::hasMethod($class, '__call')){

            throw new exception('Reflect error', 'Class ' . $class . ' method ' . $method .' does not exist');

        }

        return self::getClass($class)->getMethod($method);

    }

    // 获取某个类中所有公共方法名
    public static function getMethods($class)
    {

        $reflectionClass = self::getClass($class);

        $methods =  $reflectionClass->getMethods();

        $name = [];

        foreach ($methods as $method) {

            if($method->isPublic()){

                $name[] =  $method->getName();

            }

        }

        return $name;

    }

    // 执行有访问权限方法
    public static function invoke($class, $method)
    {

        $reflectionMethod = self::getMethod($class, $method);

        $methodAccess = self::getMethodAccess($class, $method);

        if($methodAccess !== 'public'){

            throw new exception( 'Class ' . $class . ' '. $methodAccess . ' method ' . $method . '  not allow access');

        }

        $instance = self::getInstance($class);

        return $reflectionMethod->invoke($instance);

    }

    // 获取方法访问权限
    public static function getMethodAccess($class = null, $method = null)
    {

        $class  = $class ? $class : self::class;
        $method = $method ? $method : __FUNCTION__;

        $reflectionMethod = self::getMethod($class, $method);

        if($reflectionMethod->isAbstract()){

            return 'abstract';

        }

        if($reflectionMethod->isPublic()){

            return 'public';

        }

        if($reflectionMethod->isPrivate()){

            return 'private';

        }

        if($reflectionMethod->isProtected()){

            return 'protected';

        }

        if($reflectionMethod->isFinal()){

            return 'final';

        }

        if($reflectionMethod->isStatic()){

            return 'static';

        }

    }

    // 获取类的注释信息
    public static function getDocComment($class)
    {

        $reflectionClass = self::getClass($class);

        return $reflectionClass->getDocComment();

    }

}

