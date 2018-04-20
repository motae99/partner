<?php
namespace api\common\controllers;
use \Yii as Yii;
// use api\models\User;
use api\common\models\Medical;


class MedicalController extends \api\components\ActiveController
{
    public $modelClass = '\api\common\models\Medical';

    public function accessRules()
    {
        return [
            [
                'allow' => true,
                'roles' => ['@'],
            ],
            // [
            //     'allow' => true,
            //     'actions' => [
            //         'view',
            //         'create',
            //         'update',
            //         'delete'
            //     ],
            //     'roles' => ['@'],
            // ],
            // [
            //     'allow' => true,
            //     'actions' => ['custom'],
            //     'roles' => ['@'],
            //     'scopes' => ['custom'],
            // ],
            // [
            //     'allow' => true,
            //     'actions' => ['protected'],
            //     'roles' => ['@'],
            //     'scopes' => ['protected'],
            // ]
        ];
    }

    public function actions(){
        $actions = parent::actions();
        // unset($actions['index']);
        unset($actions['create']);
        unset($actions['update']);
        unset($actions['delete']);
        return $actions;
    }

    
}