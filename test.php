<?php

require 'vendor/autoload.php';

use Message\Dingtalk\Test;

$test = new Test();
echo $test->sayHello();
die;