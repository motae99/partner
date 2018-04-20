<?php

namespace api\common\models;

class Ambulance extends \api\components\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{ambulance}}';
    }

    // public function fields()
    // {
    //     return [
    //         'id',
    //         'name',
    //     ];
    // }

    // public function extraFields() {
    //     return [
    //         'services' => function($model) { return $model->acceptance; },
    //     ];
    // }

    // public function getAcceptance()
    // {
    //     return $this->hasOne(AmbulanceAcceptance::className(), ['Ambulance_id' => 'id']);
    // }


    public static function find() {
        return new AmbulanceQuery(get_called_class());
    }
}

class AmbulanceQuery extends \api\components\db\ActiveQuery
{
}