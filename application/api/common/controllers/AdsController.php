<?php
namespace api\common\controllers;
use \Yii as Yii;
use api\models\User;
use api\common\models\Ads;
use yii\db\Expression;


class AdsController extends \api\components\ActiveController
{
    public $modelClass = '\api\common\models\Ads';

    public function accessRules()
    {
        return [
            [
                'allow' => true,
                'actions' => [
                    'index',
                    'text',
                    'img'
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

    public function actionIndex(){
        $ads = Ads::find()->all();
        return array('ads'=>$ads);

    }

    

}