<?php

require 'vendor/autoload.php';

use ChangYuJunGe\Message\Dingtalk\DingtalkClient;

$dingtalkClient = new DingtalkClient();
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
$res = $dingtalkClient->dingtalkSend($param, 'M13qfTngjmndWM7eEjRQL4CApEMwVFfo', 1);
print_r($res);
die;

