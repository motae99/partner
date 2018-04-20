<?php
return [
    'id' => 'app-api',
	'name' => '',

    'controllerNamespace' => 'api\controllers',
	// 'defaultRoute' => 'task',

    'components' => [
		'urlManager' => [
			'enablePrettyUrl' => true,
			'rules' => [
				'POST /oauth2/<action:\w+>' => 'oauth2/default/<action>',
				[
					'class' => 'yii\rest\UrlRule',
					'controller' => ['v1/medical', 'v1/lab', 'v1/ambulance', 'v1/pharmacy', 'v1/insurance','v1/physicain'],
					// 'extraPatterns' => [
					// 	'GET accept/<id>' => 'accept',
					// 	'GET reject/<id>' => 'reject',
					// 	'GET only/<id>' => 'only',
					// 	'GET oname/<id>' => 'oname',
					// ],
				],	
				[
					'class' => 'yii\rest\UrlRule',
					'controller' => ['v1/appointment'],
					'extraPatterns' => [
						'POST booking' => 'booking',
						'GET all' => 'all',
						'GET reserve' => 'reserve',
						'GET cancel/<id>' => 'cancel',
						'GET schedule/<id>' => 'schedule',
						'POST reschedule' => 'reschedule',
					],
				],
				[
					'class' => 'yii\rest\UrlRule',
					'controller' => ['v1/register'],
					'extraPatterns' => [
						'POST code' => 'code',
						'POST verify' => 'verify',
					],
				],	
			]
		],
		// 'apns' => [
		// 	'class' => 'bryglen\apnsgcm\Apns',
		// 	'environment' => \bryglen\apnsgcm\Apns::ENVIRONMENT_SANDBOX,
		// 	'pemFile' => dirname(__FILE__).'/apnssert/apns-dev.pem',
		// 	// 'retryTimes' => 3,
		// 	'options' => [
		// 		'sendRetryTimes' => 5
		// 	]
		// ],
		// 'gcm' => [
		// 	'class' => 'bryglen\apnsgcm\Gcm',
		// 	'apiKey' => 'AIzaSyD8rUMEY_RBu0Tkgfiu0Tqm-uqMvqBdsgU',
		// ],
		// // using both gcm and apns, make sure you have 'gcm' and 'apns' in your component
		// 'apnsGcm' => [
		// 	'class' => 'bryglen\apnsgcm\ApnsGcm',
		// 	// custom name for the component, by default we will use 'gcm' and 'apns'
		// 	//'gcm' => 'gcm',
		// 	//'apns' => 'apns',
		// ],
		'request' => [
			'parsers' => [
				'application/json' => 'yii\web\JsonParser',
			]
		],
		'response' => [
			'class' => 'yii\web\Response',
			'formatters' => [
				yii\web\Response::FORMAT_HTML => '\api\components\HtmlResponseFormatter',
			],
			'on beforeSend' => function (\yii\base\Event $event) {
				/** @var \yii\web\Response $response */
				$response = $event->sender;
				// catch situation, when no controller hasn't been loaded
				// so no filter wasn't loaded too. Need to understand in which format return result
				if(empty(Yii::$app->controller)) {
					$content_neg = new \yii\filters\ContentNegotiator();
					$content_neg->response = $response;
					$content_neg->formats = Yii::$app->params['formats'];
					$content_neg->negotiate();
				}
				if ($response->data !== null && Yii::$app->request->get('suppress_response_code')) {
					$response->data = [
						'success' => $response->isSuccessful,
						'data' => $response->data,
					];
					$response->statusCode = 200;
				}
			},
		],
		'user' => [
			'identityClass' => 'api\models\User',
			'loginUrl' => null,
			'enableSession' => false
        ],
    ],
    'params' => [],
];
