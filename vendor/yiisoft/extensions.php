<?php

$vendorDir = dirname(__DIR__);

return array (
  'filsh/yii2-oauth2-server' => 
  array (
    'name' => 'filsh/yii2-oauth2-server',
    'version' => '2.0.0.0',
    'alias' => 
    array (
      '@filsh/yii2/oauth2server' => $vendorDir . '/filsh/yii2-oauth2-server',
    ),
    'bootstrap' => 'filsh\\yii2\\oauth2server\\Bootstrap',
  ),
  'bryglen/yii2-apns-gcm' => 
  array (
    'name' => 'bryglen/yii2-apns-gcm',
    'version' => '1.0.5.0',
    'alias' => 
    array (
      '@bryglen/apnsgcm' => $vendorDir . '/bryglen/yii2-apns-gcm',
    ),
  ),
);
