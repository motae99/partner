<?php
namespace api\common\controllers;
use \Yii as Yii;
use api\models\User;
use api\common\models\Contactus;
use yii\db\Expression;


class ContactusController extends \api\components\ActiveController
{
    public $modelClass = '\api\common\models\Contactus';

    public function accessRules()
    {
        return [
            [
                'allow' => true,
                'actions' => [
                    'form',
                ],
                'roles' => ['@'],
            ],
           
        ];
    }

    public function actions(){
        $actions = parent::actions();
        unset($actions['index']);
        unset($actions['view']);
        unset($actions['create']);
        unset($actions['update']);
        unset($actions['delete']);
        return $actions;
    }

    public function actionForm(){
        $user =  Yii::$app->user->identity;
        $body = json_decode(Yii::$app->getRequest()->getRawBody(), true);
        if (isset($body['type']) && isset($body['sub']) && isset($body['body']) && isset($body['phone']) && isset($body['email']) && isset($body['name'])) {
            $contactus = new Contactus();
            $contactus->type = $body['type'];
            $contactus->sub = $body['sub'];
            $contactus->body = $body['body'];
            $contactus->phone = $body['phone'];
            $contactus->email = $body['email'];
            $contactus->name = $body['name'];
            $contactus->created_by = $user->id;
            $contactus->created_at =  new Expression('NOW()');
            if ($contactus->save()) {
                return array('success' => 1, 'message'=> 'تمت العملية' );
            }else{
                return array('success' => 1, 'message'=> 'حدث خطأ الرجاء الأبﻻغ' );
            }

        }else{
            return array('success' => 0, 'message'=> 'كل الحقول اجبارية' );
        }

    }

    

}