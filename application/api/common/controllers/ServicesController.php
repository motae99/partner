<?php
namespace api\common\controllers;
use \Yii as Yii;
use api\models\User;
use api\common\models\Services;
use api\common\models\Servicetype;
use yii\db\Expression;


class ServicesController extends \api\components\ActiveController
{
    public $modelClass = '\api\common\models\Services';

    public function accessRules()
    {
        return [
            [
                'allow' => true,
                'actions' => [
                    'create',
                    'types',
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

    public function actionTypes(){
        $services = Servicetype::find()->all();
        return array('success' => 1, 'data' => $services);

    }

    public function actionCreate(){
        $user =  Yii::$app->user->identity;
        
        $body = json_decode(Yii::$app->getRequest()->getRawBody(), true);
       
        if($body['service_id'] && $body['name'] && $body['phone'] && $body['address']){
            $model = new Services();
            $model->service_id = $body['service_id'];
            $model->name = $body['name'];
            $model->phone = $body['phone'];
            $model->address = $body['address'];
            if (isset($body['description'])) {
                $model->description = $body['description'];
            }
            $model->status = "requested";
            $model->status = "requested";
            $model->created_at = new Expression('NOW()');
            $model->created_by = $user->id;
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