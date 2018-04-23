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
            'rate_count' => function($model) { return $model->count($model);},
            'rate_total' => function($model) { return $model->total($model);},
            'photo'=> function($model) { return '/img/doctors/'.$model->photo;},
        ];
    }

    public function extraFields() {
        return [
            'work' => function($model) { return $model->avail; },
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

    public function count($model)
    {
        $no = Appointment::find()
                ->where(['physician_id' => $model->id])
                ->andWhere(['<=', 'doctor_rate', 5])
                // ->orWhere(['>=', 'doctor_rate', 1])
                ->count();
        if ($no) {
            return $no;
        }else{
            return 0;
        }
    }

    public function total($model)
    {
        $no = Appointment::find()
                ->where(['physician_id' => $model->id])
                ->andWhere(['<=', 'doctor_rate', 5])
                // ->orWhere(['>=', 'doctor_rate', 1])
                ->sum('doctor_rate');
        if ($no) {
            return $no;
        }else{
            return 0;
        }
    }



    public static function find() {
        return new PhysicainQuery(get_called_class());
    }
}

class PhysicainQuery extends \api\components\db\ActiveQuery
{
}