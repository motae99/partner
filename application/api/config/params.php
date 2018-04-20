<?php
Yii::setAlias('@anyname', realpath(dirname(__FILE__).'/../../'));

return [
    'adminEmail' => 'motae99@gmail.com',
	'formats' => [
		'application/json' => yii\web\Response::FORMAT_JSON,
		'application/xml' => yii\web\Response::FORMAT_XML,
		'text/html' => yii\web\Response::FORMAT_HTML,
	],
];
