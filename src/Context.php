<?php


namespace Dongqibin\Context;


use Swoole\ArrayObject;
use Swoole\Coroutine;

class Context
{
    public static function get(string $key, int $cid = null) {
        $context = self::getAll($cid);
        return $context[$key] ?? null;
    }

    public static function set(string $key, $val, int $cid = null):void {
        $context = self::getAll($cid);
        $context[$key] = $val;
    }

    public static function del(string $key, int $cid = null):void {
        $context = self::getAll($cid);
        unset($context[$key]);
    }

    public static function has(string $key, int $cid = null):bool {
        $context = self::getAll($cid);
        return isset($context[$key]);
    }

    public static function getAll(int $cid = null):Coroutine\Context {
        return Coroutine::getContext($cid);
    }

}