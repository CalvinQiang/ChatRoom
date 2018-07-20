<?php
/**
 * Change the World by Program
 * User: Sometimes
 * Date: 2018/7/20/020
 * Time: 15:55
 * Email: concise.sometimes@gmail.com
 */


namespace App\Socket\WebSocket\Logic;


use EasySwoole\Core\Component\Di;

class RoomTable
{
    /**
     * 该table主要是为了映射uid和fd
     */
    const TABLE_UID_MAP = 'uid_map';

    protected static function getTable()
    {
        $table = Di::getInstance()->get('ROOM_TABLE');
        return $table;
    }


}