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
            'id' => function($model) { return $model->insurance_id; },
            'name' => function($model) { return $model->insu->name; },
            'discount',
        ];
    }

    public function getInsu()
    {
        return $this->hasOne(Insurance::className(), ['id' => 'insurance_id']);
    }

    public static function find() {
        return new LabinsuranceQuery(get_called_class());
    }
}

class LabinsuranceQuery extends \api\components\db\ActiveQuery
{
}