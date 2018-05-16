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
            'physicians' => function($model) { return $model->acceptance; },
            'pharmacies' => function($model) { return $model->phar; },
            'labs' => function($model) { return $model->lab; },
        ];
    }

    public function getAcceptance()
    {
        return $this->hasMany(InsuranceAcceptance::className(), ['insurance_id' => 'id']);
    }

    public function getPhar()
    {
        return $this->hasMany(Pharinsurance::className(), ['insurance_id' => 'id']);
    }

    public function getLab()
    {
        return $this->hasMany(Labinsurance::className(), ['insurance_id' => 'id']);
    }


    public static function find() {
        return new InsuranceQuery(get_called_class());
    }
}

class InsuranceQuery extends \api\components\db\ActiveQuery
{
}