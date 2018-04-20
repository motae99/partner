<?php

namespace api\common\models;

class Pharmacy extends \api\components\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{pharmacy}}';
    }

    public function fields()
    {
        return [
            'id',
            'name',
            'owner_name',
            'city',
            'address',
            'website',
            'working_days',
            'from_hour',
            'to_hour',
            'app_service',
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
            'drugs' => function($model) { return $model->drugs; },
            'insurance' => function($model) { return $model->insurance; },
        ];
    }

    public function getDrugs()
    {
        return $this->hasMany(Drugs::className(), ['phar_id' => 'id']);
    }

    public function getInsurance()
    {
        return $this->hasMany(Pharinsurance::className(), ['phar_id' => 'id']);
    }

    public static function find() {
        return new PharmacyQuery(get_called_class());
    }
}

class PharmacyQuery extends \api\components\db\ActiveQuery
{
}