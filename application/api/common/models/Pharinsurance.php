<?php

namespace api\common\models;

class Pharinsurance extends \api\components\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{phar_insu}}';
    }

    public function fields()
    {
        return [
            'id' ,
            'phar_id',
            'provider_name' => function($model) { return $model->insu->name; },
            'pharmacy_name' => function($model) { return $model->pharmacy->name; },
            'discount',
        ];
    }

    public function getInsu()
    {
        return $this->hasOne(Insurance::className(), ['id' => 'insurance_id']);
    }

    public function getPharmacy()
    {
        return $this->hasOne(Pharmacy::className(), ['id' => 'phar_id']);
    }

    public static function find() {
        return new PharinsuranceQuery(get_called_class());
    }
}

class PharinsuranceQuery extends \api\components\db\ActiveQuery
{
}