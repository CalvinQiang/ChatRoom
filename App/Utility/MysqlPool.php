<?php
/**
 * Change the World by Program
 * User: Sometimes
 * Date: 2018/7/19/019
 * Time: 18:03
 * Email: concise.sometimes@gmail.com
 */


namespace App\Utility;


use EasySwoole\Core\Component\Di;
use EasySwoole\Core\Component\Pool\AbstractInterface\Pool;
use EasySwoole\Core\Component\Trigger;

class MysqlPool extends Pool
{
    protected function createObject()
    {
        try{
           $db = Di::getInstance()->get('MYSQL');
           return $db;
        }catch (\Throwable $throwable){
            Trigger::throwable($throwable);
            return null;
        }
    }


}