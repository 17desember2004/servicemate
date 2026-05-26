<?php
require 'vendor/autoload.php';
$v = \Minishlink\WebPush\VAPID::createVapidKeys();
echo 'Public: ' . $v['publicKey'] . PHP_EOL;
echo 'Private: ' . $v['privateKey'] . PHP_EOL;
 