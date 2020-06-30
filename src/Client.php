<?php


namespace Dongqibin\Context;


class Client
{

    public static function get(string $key, int $cid = null) {
        return Context::get($key, $cid);
    }

    public static function set(string $key, $val, int $cid = null):void {
        Context::set($key, $val, $cid);
    }

    public static function del(string $key, int $cid = null):void {
        Context::del($key, $cid);
    }

    public static function has(string $key, int $cid = null):bool {
        return Context::has($key, $cid);
    }

    public static function getAll(int $cid = null):\Swoole\Coroutine\Context {
        return Context::getAll($cid);
    }

    public static function getCid():int {
        return CidManager::getCid();
    }

    public static function getPcid(int $cid = null):int {
        return CidManager::getPcid($cid);
    }

    public static function getFirst():int {
        return CidManager::getFirst();
    }

    public static function getSecond():int {
        return CidManager::getSecond();
    }

    public static function getByLevel(int $level):int {
        return CidManager::getByLevel($level);
    }

}