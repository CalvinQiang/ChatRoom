<?php
/**
 * Change the World by Program
 * User: Sometimes
 * Date: 2018/7/20/020
 * Time: 12:00
 * Email: concise.sometimes@gmail.com
 */


namespace App\Socket\WebSocket\Controller;


use App\Socket\WebSocket\Logic\RoomRedis;
use App\Utility\RedisPool;
use EasySwoole\Core\Component\Pool\PoolManager;
use EasySwoole\Core\Socket\AbstractInterface\WebSocketController;

class Index extends WebSocketController
{

    /**
     *  访问找不到的action
     * @param null|string $actionName
     */
    public function actionNotFound(?string $actionName)
    {
        $this->response()->write("action call {$actionName} not found");
    }

    public function index()
    {
        $pool = PoolManager::getInstance()->getPool(RedisPool::class);

        $redis = $pool->getObj(); // 这里的pool是通过poolManager获取的RedisPool
        $redis->exec('set', 'a', '123');
        $a = $redis->exec('get', 'a');
        $this->response()->write($a);
        $pool->freeObj($redis);
    }

}