<?php

namespace api\common\models;

class Insurance extends \api\components\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{insurance}}';
    }

    public function fields()
    {
        return [
            'id',
            'name',
        ];
    }

    public function extraFields() {
        return [
            'services' => function($model) { return $model->acceptance; },
        ];
    }

    public function getAcceptance()
    {
        return $this->hasOne(InsuranceAcceptance::className(), ['insurance_id' => 'id']);
    }


    public static function find() {
        return new InsuranceQuery(get_called_class());
    }
}

class InsuranceQuery extends \api\components\db\ActiveQuery
{
}