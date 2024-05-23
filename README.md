# 长与君歌-消息中台客户端

```php
// 发送钉钉文本消息
$client = new \ChangYuJunGe\Message\Dingtalk\DingtalkClient();
$token = 'M13qfTngjmndWM7eEjRQL4CApEMwVFfo';
$pns = 1;
$param = [
    'content' => '测试环境-测试内容',
    'at_mobiles' => [
        19138989982
    ],
    'at_dingtalk_id' => [
        0
    ],
    'is_at_all' => 'false',
];
$res = $client->dingtalkSend($param, $token, $pns); // 返回json格式数据
```

