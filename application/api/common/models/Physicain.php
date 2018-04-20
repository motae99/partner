<?php

namespace api\common\models;

class Physicain extends \api\components\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{physician}}';
    }

    public function fields()
    {
        return [
            'id',
            'name',
            'contact_no',
            'spaciality'=> function($model) { return $model->specialization_id; },
            'regestration_no',
            'university',
            'extra_info',
            'photo'=> function($model) { return '/img/doctors/'.$model->photo;},
        ];
    }

    public function extraFields() {
        return [
            'work' => function($model) { return $model->avail; },
            'insurance' => function($model) { return $model->insurance; }
            // 'items' => function($model) { return $model->item; }
        ];
    }

    public function getAvail()
    {
        return $this->hasMany(Availability::className(), ['physician_id' => 'id']);
         
    }

    // public function getInsurance()
    // {
        
    //     return $this->hasMany(InsuranceAcceptance::className(), ['id' => 'id']);
    // }

    public static function find() {
        return new PhysicainQuery(get_called_class());
    }
}

class PhysicainQuery extends \api\components\db\ActiveQuery
{
}