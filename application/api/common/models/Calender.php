<?php

namespace api\common\models;

class Calender extends \api\components\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{calender}}';
    }

    // public function fields()
    // {
    //     return [
    //         'id',
    //         'physician_id',
    //         'clinic_id',
    //         'doctor' => function($model) { return $model->doctor->name; },
    //         'clinic' => function($model) { return $model->clinic->name; },
    //         'day' => function($model) { return $model->date; },
    //         'from_time',
    //         'to_time',
    //         'appointment_fee',
    //     ];
    // }

    public function extraFields() {
        return [
            'time' => function($model) { return $model->schedule; },
        ];
    }

    public function getSchedule()
    {
        // $all = $this->hasMany(Schedule::className(), ['calender_id' => 'id']);
        return $this->hasMany(Schedule::className(), ['calender_id' => 'id']);
    }


    public static function find() {
        return new CalenderQuery(get_called_class());
    }
}

class CalenderQuery extends \api\components\db\ActiveQuery
{
}