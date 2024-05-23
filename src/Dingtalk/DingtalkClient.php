<?php

namespace ChangYuJunGe\Message\Dingtalk;

use ChangYuJunGe\Message\CommonClient;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ClientException;
use ChangYuJunGe\Message\Constant\RouteConstant;

/**
 * 钉钉消息发送类
 *
 * @author liujianxin <lmmlwen@163.com>
 * @version v1.0 2024-05-22
 * @package ChangYuJunGe\Signature
 * @link http://serv.changyujunge.com:3000/
 */
class DingtalkClient extends CommonClient
{
    /**
     * 发送钉钉消息
     * @param  array $param
     * @param  string $token
     * @param  int $pns
     * @return array
     * @throws RequestException
     * @throws \Throwable
     */
    public function dingtalkSend(array $param, string $token = '', int $pns = 0): array
    {
        $dingtalk = $this->send($param, $token, $pns, RouteConstant::MESSAGE_TYPE_DINGTALK);
        return $dingtalk;
    }
}