<?php
/**
 * Change the World by Program
 * User: Sometimes
 * Date: 2018/7/20/020
 * Time: 15:29
 * Email: concise.sometimes@gmail.com
 */


namespace App\Socket\WebSocket;


use EasySwoole\Core\Socket\AbstractInterface\WebSocketController;

class BaseController extends WebSocketController
{
    public function sendPackage($message)
    {
        $this->response()->write($message);
    }
}