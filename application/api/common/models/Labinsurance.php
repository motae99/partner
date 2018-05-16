<?php

namespace api\common\models;

class Labinsurance extends \api\components\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{lab_insur}}';
    }

    public function fields()
    {
        return [
            'id',
            'lab_id',
            'provider_name' => function($model) { return $model->insu->name; },
            'lab_name' => function($model) { return $model->lab->name; },
            'discount',
        ];
    }

    public function getInsu()
    {
        return $this->hasOne(Insurance::className(), ['id' => 'insurance_id']);
    }

    public function getLab()
    {
        return $this->hasOne(Lab::className(), ['id' => 'lab_id']);
    }

    public static function find() {
        return new LabinsuranceQuery(get_called_class());
    }
}

class LabinsuranceQuery extends \api\components\db\ActiveQuery
{
}