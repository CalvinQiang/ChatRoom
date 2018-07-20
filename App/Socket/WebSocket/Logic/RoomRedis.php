<?php
/**
 * Change the World by Program
 * User: Sometimes
 * Date: 2018/7/20/020
 * Time: 13:57
 * Email: concise.sometimes@gmail.com
 */


namespace App\Socket\WebSocket\Logic;


use EasySwoole\Core\Component\Di;

class RoomRedis
{
    const T_USER = 'user:';
    const T_FD = 'fd:';
    const T_ROOM = 'room:';
    const T_ROOM_SET = 'room_set';

    /**
     * 获取Redis连接实例
     * @return object Redis
     */
    protected static function getRedis()
    {
        return Di::getInstance()->get('REDIS')->handler();
    }

    /**
     * 登录
     * @param  int    $userId 用户id
     * @param  int    $fd     连接id
     * @return bool
     */
    public static function login(int $userId, int $fd)
    {
        self::getRedis()->zAdd(self::T_USER, $userId, $fd);
    }


    /**
     * 进入房间
     * @param  int    $roomId 房间id
     * @param  int    $userId userId
     * @param  int    $fd     连接id
     * @return
     */
    public static function joinRoom(int $roomId, int $fd)
    {
        $userId = self::getUserId($fd);
        self::getRedis()->sSadd(self::T_ROOM_SET,$roomId);
        self::getRedis()->hSet(self::T_FD.$fd, $roomId, $userId);
        self::getRedis()->hSet(self::T_ROOM.$roomId, $fd, $userId);
    }


    /**
     * 获取用户id
     * @param  int    $fd
     * @return int    userId
     */
    public static function getUserId(int $fd)
    {
        return self::getRedis()->zScore(self::T_USER, $fd);
    }

    /**
     * 获取用户fd
     * @param  int    $userId
     * @return array         用户fd集
     */
    public static function getUserFd(int $userId)
    {
        return self::getRedis()->zRange(self::T_USER, $userId, $userId, true);
    }

    /**
     * 获取RoomId
     * @param  int    $fd
     * @return int    RoomId
     */
    public static function getRoomIds(int $fd)
    {
        return self::getRedis()->hKeys(self::T_FD.$fd);
    }

    /**
     * 获取room中全部fd
     * @param  int    $roomId roomId
     * @return array         房间中fd
     */
    public static function selectRoomFd(int $roomId)
    {
        return self::getRedis()->hKeys(self::T_ROOM.$roomId);
    }

    /**
     * 退出room
     * @param  int    $roomId roomId
     * @param  int    $fd     fd
     * @return
     */
    public static function exitRoom(int $roomId, int $fd)
    {
        self::getRedis()->hDel(self::T_ROOM.$roomId, $fd);
        self::getRedis()->hDel(self::T_FD.$fd, $roomId);
    }

    /**
     * 关闭连接
     * @param  string $fd 链接id
     */
    public static function close(int $fd)
    {
        $roomIds = self::getRoomIds($fd);
        foreach ($roomIds as $roomId){
            self::exitRoom($roomId, $fd);
            self::getRedis()->zRem(self::T_USER, $fd);
        }
    }
}