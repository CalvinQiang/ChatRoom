<?php
/**
 * Change the World by Program
 * User: Sometimes
 * Date: 2018/7/20/020
 * Time: 15:18
 * Email: concise.sometimes@gmail.com
 */


namespace App\Socket\WebSocket;


class ErrorCode
{
    const E_UNKNOWN = 9999;
    const E_ROUTE_NOT_FOUND = 10000;

    public static function getAllCode()
    {
        return [
            self::E_ROUTE_NOT_FOUND => '找不到Route规则'
        ];
    }

    /**
     * Error Code 详细信息
     * @param $code
     * @return int|mixed
     */
    public static function transErrorCode($code){
        $allCode = self::getAllCode();
        return isset($allCode[$code]) ? $allCode[$code] : self::E_UNKNOWN;
    }
}