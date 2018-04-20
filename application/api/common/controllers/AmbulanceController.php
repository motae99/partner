<?php
namespace api\common\controllers;
use \Yii as Yii;
use api\models\User;
use api\common\models\Ambulance;
use api\common\models\Request;
// use api\common\models\Profile;
use yii\db\Expression;


class AmbulanceController extends \api\components\ActiveController
{
    public $modelClass = '\api\common\models\Ambulance';

    public function accessRules()
    {
        return [
            [
                'allow' => true,
                'roles' => ['@'],
            ],
           
        ];
    }

    public function actions(){
        $actions = parent::actions();
        // unset($actions['index']);
        unset($actions['view']);
        unset($actions['create']);
        unset($actions['update']);
        unset($actions['delete']);
        return $actions;
    }

     public function actionCreate(){
        $user =  Yii::$app->user->identity;
        
        $body = json_decode(Yii::$app->getRequest()->getRawBody(), true);
       
        if($body['provider_id'] && $body['from'] && $body['to'] && $body['phone_no']){
            $model = new Request();
            $model->ambulance_id = $body['provider_id'];
            $model->from_location = $body['from'];
            $model->to_location = $body['to'];
            $model->phone_no = $body['phone_no'];
            $model->requested_by = 1;
            $model->requested_at = new Expression('NOW()');
            $model->status = 'requested';
            if ($model->save()) {
                return array('success' => 1);
            }else{
                return array('success' => 0);
            }
        }else{

            return array('success' => 0, 'massaage' => "fill all required fields");
        }

    }

}