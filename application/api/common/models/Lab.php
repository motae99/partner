<?php

namespace api\common\models;

class Lab extends \api\components\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{lab}}';
    }

     public function fields()
    {
        return [
            'id',
            'name',
            'city',
            'address',
            'working_days',
            'from_hour',
            'to_hour',
            // 'app_service',
            'phone',
            'secondary_phone',
            'rate',
            // 'photo' => function($model) { return '/img/clinics/'.$model->photo;},
            // 'start_time'=> function($model) { return $model->start; },
            // 'end_time'=> function($model) { return $model->end; },
            'logitude',
            'latitude',
           
        ];
    }

     public function extraFields() {
        return [
            'insurance' => function($model) { return $model->insurance; },
            'test' => function($model) { return $model->test; },
        ];
    }


    public function getInsurance()
    {
        return $this->hasMany(Labinsurance::className(), ['lab_id' => 'id']);
    }

    public function getTest()
    {
        return $this->hasMany(Labexam::className(), ['lab_id' => 'id']);
    }


    public static function find() {
        return new LabQuery(get_called_class());
    }
}

class LabQuery extends \api\components\db\ActiveQuery
{
}