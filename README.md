## 上下文管理

#### 安装
```cmd
composer require dongqibin/context
```

#### 说明
* 本组件是对swoole上下文的封装整理. [swoole相关文档](https://wiki.swoole.com/#/coroutine/coroutine?id=getcontext "swoole上下文")

#### 思考
* 名词声明.整个数据叫做 `整个上下文`, 某个协程中的数据叫做 `Co\Context对象` 
* 本组件是一个操作性质的组件.本身不存储数据.
* 上下文可以看做是一个 `二维数组`, 具有全局性质.
* 第一层的下标为 swoole的协程ID.也就是说数据在各个协程之间是独立的.不会相互覆盖.
* 第一层的值为一个 `Co\Context` 对象.实现了 ArrayObject, 满足各种存储需求 (既是对象，也可以以数组方式操作)
* 第一个任务是实现对 `Co\Context对象` 的管理
* 第二个任务也是本包编写的目的.除了具有操作本协程数据的能力之外,还可以根据传递的 `层级数` 来操作整个 `协程链` 里面任意一层的数据.
`协程链`我定义的含义是go函数里面开启go函数而形成的一个链.

#### 简单实例

```php


use Dongqibin\Context\Client;

//获取当前协程上下文key的值
Client::get('key', Co::getCid());

//如果获取当前协程上下文的数据,可以忽略get方法第二个参数 . 简化为如下代码
Client::get('key');

//设置协程上下文key的值
$cid = 1; //获取其他协程ID
Client::set('key', 'val', $cid);

//如果设置当前协程上下文key的值,可省略第三个参数$cid
Client::set('key', 'val');
```

#### 方法列表
##### Co\Context对象相关
* get(string $key, int $cid = null)
* set(string $key, $val, int $cid = null):void
* del(string $key, int $cid = null):void
* has(string $key, int $cid = null):bool

##### 整个上下文相关
* getAll(int $cid = null):array

##### 协程ID相关
* getCid():int
* getPcid(int $cid = null):int
* getFirst():int
* getSecond():int
* getByLevel(int $level):int



