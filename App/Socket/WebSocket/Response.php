<?php
/**
 * Change the World by Program
 * User: Sometimes
 * Date: 2018/7/20/020
 * Time: 14:28
 * Email: concise.sometimes@gmail.com
 */


namespace App\Socket\WebSocket;


class Response
{
    /**
     * 返回状态：成功
     */
    const CODE_OK = true;

    /**
     * 返回状态：失败
     */
    const CODE_ERROR = false;

    const ERROR_CODE_NONE = 0;

    /**
     * 格式化方式:JSON
     */
    const FORMAT_JSON = 'json';

    /**
     * 格式化方式:XML
     */
    const FORMAT_XML = 'xml';

    /**
     * 正确返回
     * @return string
     */
    public static function Ok($oMessage = null, $oData = null)
    {
        $code = self::CODE_OK;
        $message = $oMessage ?? null;
        $data = $oData ?? null;
        return self::baseStatus($code, $message, $data);
    }

    /**
     * 错误返回
     * @return string
     */
    public static function Error($oMessage = null, $oData = null)
    {
        $code = self::CODE_OK;
        $message = $oMessage ?? null;
        $data = $oData ?? null;
        return self::baseStatus($code, $message, $data);
    }

    /**
     * @param $code
     * @param $messages
     * @param $data
     * @return string
     */
    public static function baseStatus($code, $messages, $data)
    {
        $package = ['status' => $code, 'message' => $messages, 'data' => $data];
        return self::formatResponse($package);
    }

    /**
     * 格式化返回信息
     * @param $data
     * @param string $method
     * @return string
     */
    public static function formatResponse($data, $method = self::FORMAT_JSON)
    {
        $resContent = '';
        switch ($method) {
            case self::FORMAT_JSON:
                $resContent = json_encode($data);
                break;
            case self::FORMAT_XML:
                $resContent = self::arr2xml($data, true);
                break;
            default:
                $resContent = json_encode($data);
        }
        return $resContent;
    }

    /**
     *   将数组转换为xml
     * @param array $data 要转换的数组
     * @param bool $root 是否要根节点
     * @return string         xml字符串
     * @author Dragondean
     * @url    http://www.cnblogs.com/dragondean
     */
    public static function arr2xml($data, $root = true)
    {
        $str = "";
        if ($root) $str .= "<xml>";
        foreach ($data as $key => $val) {
            if (is_array($val)) {
                $child = self::arr2xml($val, false);
                $str .= "<$key>$child</$key>";
            } else {
                $str .= "<$key><![CDATA[$val]]></$key>";
            }
        }
        if ($root) $str .= "</xml>";
        return $str;
    }
}