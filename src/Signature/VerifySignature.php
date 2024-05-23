<?php

namespace ChangYuJunGe\Message\Signature;

use ChangYuJunGe\Message\Constant\CommonConstant;

/**
 * 消息发送签名&验签
 *
 * @author liujianxin <lmmlwen@163.com>
 * @version v1.0 2024-05-22
 * @package ChangYuJunGe\Signature
 * @link http://serv.changyujunge.com:3000/
 */
class VerifySignature
{
    /**
     * 参数签名
     * @param  array $request
     * @param  int $timestamp
     * @return string
     */
    public function sign(array $request, int $timestamp = 0): string
    {
        $params = $request;
        // 要签名的参数
        if (isset($params['signature'])) {
            unset($params['signature']);
        }
        // 将时间戳添加到参数中
        if (empty($timestamp)) {
            $timestamp = time();
        }
        $params['timestamp'] = $timestamp;
        // 字典序排序
        ksort($params);
        // 将参数拼接成字符串
        $queryString = http_build_query($params);
        // 密钥
        $key = CommonConstant::SIGNATURE_KEY;
        // 使用 HMAC-SHA256 算法对参数进行签名
        $signature = hash_hmac('sha256', $queryString, $key);

        return $signature;
    }

    /**
     * 参数校验
     * @param  array $request
     * @return bool
     */
    public function verify(array $request): string
    {
        // 获取接收到的参数和签名
        if (empty($request['signature'])) {
            return false;
        }
        $receivedSignature = $request['signature'];
        unset($request['signature']);

        $timestamp = $request['timestamp'];
        // 检查时间戳是否有效（例如，有效期为 1 分钟）
        if (time() - $timestamp > 360) {
            return false;
        }
        $params = $request;
        // 字典序排序
        ksort($params);
        // 将参数拼接成字符串
        $queryString = http_build_query($params);
        // 密钥
        $key = CommonConstant::SIGNATURE_KEY;
        // 计算期望的签名
        $expectedSignature = hash_hmac('sha256', $queryString, $key);

        // 验证签名
        if ($receivedSignature !== $expectedSignature) {
            return false;
        }
        return true;
    }
}
