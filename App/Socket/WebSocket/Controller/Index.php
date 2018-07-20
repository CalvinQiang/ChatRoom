<?php
/**
 * Change the World by Program
 * User: Sometimes
 * Date: 2018/7/20/020
 * Time: 12:00
 * Email: concise.sometimes@gmail.com
 */


namespace App\Socket\WebSocket\Controller;


use App\Socket\WebSocket\Logic\Room;
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
        $fd = $this->client()->getFd();
        $this->response()->write("you fd is {$fd}");
    }

    public function room()
    {
        $this->response()->write(123);
        $this->response()->write(Room::testSet());
        $this->response()->write("\n");
        $this->response()->write(Room::testGet());
    }
}