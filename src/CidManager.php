<?php


namespace Dongqibin\Context;


use Swoole\Coroutine;

class CidManager
{
    public static function getCid():int {
        return Coroutine::getCid();
    }

    public static function getPcid(int $cid=null):int {
        return Coroutine::getPcid($cid);
    }

    public static function getFirst():int {
        return self::getByLevel(1);
    }

    public static function getSecond():int {
        return self::getByLevel(2);
    }

    public static function getByLevel(int $level):int {
        $data = self::getData();

        //此代码目的是因为索引个数比索引的值少1.
        $level = $level - 1;
        return $data[$level] ?? -1;
    }

    private static function getData() {
        $cid = self::getCid();
        $data = [$cid];

        while(true) {
            $pid = self::getPcid($cid);
            if($pid == -1) {
                break;
            }

            $data[] = $pid;
            $cid = $pid;
        }
        return $data;
    }

}