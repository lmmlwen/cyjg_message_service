<?php

namespace ChangYuJunGe\Message;

use ChangYuJunGe\Message\Signature\VerifySignature;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Client;
use ChangYuJunGe\Message\Constant\RouteConstant;

/**
 * 消息发送基类
 *
 * @author liujianxin <lmmlwen@163.com>
 * @version v1.0 2024-05-22
 * @package ChangYuJunGe
 * @link http://serv.changyujunge.com:3000/
 */
class CommonClient
{
    /**
     * @var object
     */
    public $verifySignatur;

    /**
     * @var string
     */
    public $env = '';

    public function __construct()
    {
        $this->verifySignatur = new VerifySignature();
    }

    /**
     * 生成所需header
     * @param  array $paramCollect
     * @return array
     */
    public function createHeader(array $paramCollect): array
    {
        $timestamp = time();
        $signature = $this->verifySignatur->sign($paramCollect, $timestamp);
        return [
            'X-Request-ID' => unique_id(),
            'signature' => $signature,
            'timestamp' => $timestamp,
            'env' => 'test',
        ];
    }

    /**
     * 处理响应
     * @param ResponseInterface $response
     * @return array
     */
    public function handleResponse(ResponseInterface $response): array
    {
        $statusCode = $response->getStatusCode();
        $body = $response->getBody()->getContents();
        if (is_json($body)) {
            $body = json_decode($body, true);
        }
        return [
            'status' => $statusCode,
            'message' => 'success',
            'data' => $body,
        ];
    }

    /**
     * 获取当前环境
     * @param string $env
     * @return string
     */
    public function getRequestEnv(string $env = ''): string
    {
        $host = $_SERVER['HTTP_HOST'];
        $hostParts = explode('.', $host);
        $hostPrefix = '';
        if (count($hostParts) > 2) {
            // 如果域名是三级或更高，返回最左边的部分（即二级域名前缀）
            if (in_array($hostParts[0], ['test', 'pre1', 'prod'])) {
                $hostPrefix = $hostParts[0];
            }
        }
        return $hostPrefix;
    }

    /**
     * 获取请求路由
     * @param string $msgType
     * @return string
     */
    public function getRequestRoute(string $msgType): string
    {
        $route = RouteConstant::SEND_MESSAGE_ROUTE_MAP[$msgType];
        return $route;
    }

    /**
     * 获取请求地址
     * @param string $hostPrefix
     * @param string $route
     * @return string
     */
    public function getRequestUrl(string $hostPrefix, string $route): string
    {
        $host = '172.16.1.2:8001';
        if ($hostPrefix == 'test') {
            $host = '';
        } else if ($hostPrefix == 'pre1') {
            $host = '';
        } else if ($hostPrefix == 'prod') {
            $host = '';
        }
        if ($hostPrefix == '') {
            $url = $host.$route;
        } else {
            $url = $hostPrefix.'.'.$host.$route;
        }
        return $url;
    }

    /**
     * 向消息中台发送消息
     * @param  array $param
     * @param  string $token
     * @param  int $pns
     * @param  string $msgType
     * @param  string $env
     * @return array
     * @throws RequestException
     * @throws \Throwable
     */
    public function send(array $param, string $token = '', int $pns = 0, string $msgType = RouteConstant::MESSAGE_TYPE_DINGTALK, string $env = ''): array
    {
        $hostPrefix = $this->getRequestEnv($env);
        $route = $this->getRequestRoute($msgType);
        $url = $this->getRequestUrl($hostPrefix, $route);
        $paramCollect = [
            'token' => $token,
            'pns' => $pns,
            'param' => $param,
        ];
        $header = $this->createHeader($paramCollect);
        $sendRes = [];

        try {
            $client = new Client();
            $response = $client->request('POST', $url, [
                'headers' => $header,
                'form_params' => $paramCollect,
            ]);
            $sendRes =  $this->handleResponse($response);
        } catch (ClientException $e) {
            // 客户端异常处理
            $sendRes['code'] = $e->getCode();
            $sendRes['message'] = $e->getMessage();
        } catch (RequestException $e) {
            // 请求异常处理
            $response = $e->getResponse();
            $sendRes['code'] = $response->getStatusCode();
            $sendRes['message'] = $response->getBody()->getContents();
        } catch (\Throwable $e) {
            // 其他异常处理
            $sendRes['code'] = $e->getCode();
            $sendRes['message'] = $e->getMessage();
        }

        return $sendRes;
    }
}
