<?php
namespace api\common\controllers;
use \Yii as Yii;
// use api\models\User;
use api\common\models\Physicain;
use yii\data\ActiveDataProvider;


class PhysicainController extends \api\components\ActiveController
{
    public $modelClass = '\api\common\models\Physicain';

    public function accessRules()
    {
        return [
            [
                'allow' => true,
                'roles' => ['@'],
            ],
           
        ];
    }

    

    // public function actionIndex(){
    //     return new ActiveDataProvider([
    //         'query' => Physicain::find()->with('recivable'), // and the where() part, etc.
    //     ]);

    // }

}