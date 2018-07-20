<?php
/**
 * Change the World by Program
 * User: Sometimes
 * Date: 2018/7/20/020
 * Time: 11:14
 * Email: concise.sometimes@gmail.com
 */


namespace App\Socket\WebSocket;


use App\Socket\WebSocket\Controller\Index;
use EasySwoole\Core\Socket\AbstractInterface\ParserInterface;
use EasySwoole\Core\Socket\Common\CommandBean;

class Parser implements ParserInterface
{
    public static function decode($raw, $client)
    {
        $commandLine = json_decode($raw, true);
        if (!is_array($commandLine)) {
            return 'unknown command';
        }
        $commandBean = new CommandBean();
        $control = isset($commandLine['controller']) ? 'App\\Socket\\WebSocket\\Controller\\' . ucfirst($commandLine['controller']) : '';
        $action = $commandLine['action'] ?? 'none';
        $data = $commandLine['data'] ?? null;

        $commandBean->setControllerClass(class_exists($control) ? $control : Index::class);
        $commandBean->setAction(class_exists($control) ? $action : 'controllerNotFound');
        $commandBean->setArg('data', $data);
        return $commandBean;
    }

    public static function encode(string $raw, $client): ?string
    {
        return $raw;
    }

}