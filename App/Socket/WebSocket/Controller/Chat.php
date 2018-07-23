<?php
/**
 * Change the World by Program
 * User: Sometimes
 * Date: 2018/7/20/020
 * Time: 14:22
 * Email: concise.sometimes@gmail.com
 */


namespace App\Socket\WebSocket\Controller;


use App\Socket\WebSocket\BaseController;
use App\Socket\WebSocket\ErrorCode;
use App\Socket\WebSocket\Logic\RoomRedis;
use App\Socket\WebSocket\Response;
use EasySwoole\Core\Socket\AbstractInterface\WebSocketController;
use EasySwoole\Core\Swoole\ServerManager;
use EasySwoole\Core\Swoole\Task\TaskManager;

class chat extends BaseController
{

    /**
     * 访问找不到的action
     * @param null|string $actionName
     */
    public function actionNotFound(?string $actionName)
    {
        $code = ErrorCode::E_ROUTE_NOT_FOUND;
        $message = Response::formatCodeMsg($code);
        $package = Response::Error($message);
        $this->sendPackage($package);
    }

    public function index()
    {
        RoomRedis::test();
        $package = Response::Ok('Change the World by Program');
        $this->sendPackage($package);
    }

    /**
     * 进入房间
     */
    public function intoRoom()
    {
        $param = $this->request()->getArg('data');
        $userId = $param['userId'];
        $roomId = $param['roomId'];

        $fd = $this->client()->getFd();

        RoomRedis::login($userId, $fd);
        RoomRedis::joinRoom($roomId, $fd);
        $package = Response::Ok();
        $this->sendPackage($package);
    }

    /**
     * 发送信息到房间
     */
    public function sendToRoom()
    {
        $param = $this->request()->getArg('data');
        $message = $param['message'];
        $roomId = $param['roomId'];

        //异步推送
        TaskManager::async(function () use ($roomId, $message) {
            $list = RoomRedis::selectRoomFd($roomId);
            foreach ($list as $fd) {
                ServerManager::getInstance()->getServer()->push($fd, $message);
            }
        });
        $package = Response::Ok();
        $this->sendPackage($package);
    }

    /**
     * 发送私聊
     */
    public function sendToUser()
    {
        $param = $this->request()->getArg('data');
        $message = $param['message'];
        $userId = $param['userId'];

        //异步推送
        TaskManager::async(function () use ($userId, $message) {
            $fdList = RoomRedis::getUserFd($userId);
            foreach ($fdList as $fd) {
                ServerManager::getInstance()->getServer()->push($fd, $message);
            }
        });
        $package = Response::Ok();
        $this->sendPackage($package);
    }
}