<?php

namespace App\HttpController;

use App\Utility\MysqlPool2;
use App\Utility\RedisPool;
use EasySwoole\Core\Component\Cache\Cache;
use EasySwoole\Core\Component\Di;
use EasySwoole\Core\Component\Pool\PoolManager;
use EasySwoole\Core\Http\AbstractInterface\Controller;
use EasySwoole\Core\Swoole\Memory\TableManager;
use EasySwoole\Core\Swoole\Task\TaskManager;
use EasySwoole\Core\Swoole\Time\Timer;
use EasySwoole\Core\Utility\Random;
use Swoole\Table;

/**
 * Class Index
 * @package App\HttpController
 */
class Index extends Controller
{
    function index()
    {

    }

}