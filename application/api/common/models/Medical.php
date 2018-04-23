<?php

namespace api\common\models;
use Yii;
 
class Medical extends \api\components\db\ActiveRecord
{

	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return '{{clinic}}';
	}
	public function fields()
    {
        return [
            'id',
            'name',
            'state',
            'city',
            'address',
            'primary_contact',
            'secondary_contact',
            'type',
            'special_services',
            'working_days',
            'manager',
            'info',
            'email',
            'app_service',
            'rate_count' => function($model) { return $model->count($model);},
            'rate_total' => function($model) { return $model->total($model);},
            'photo' => function($model) { return '/img/clinics/'.$model->photo;},
            'start_time'=> function($model) { return $model->start; },
            'end_time'=> function($model) { return $model->end; },
            'longitude',
            'latitude',
           
        ];
    }
    public function extraFields() {
        return [
            'specialization' => function($model) { return $model->spec; },
            'doctors' => function($model) { return $model->doctor; },
            'insurance' => function($model) { return $model->avail; },

            // 'items' => function($model) { return $model->item; }
        ];
    }

    public function getAvail()
    {
        return $this->hasMany(Availability::className(), ['clinic_id' => 'id']);
         
    }

    public function getSpec()
    {
        return $this->hasMany(Specialization::className(), ['clinic_id' => 'id']);
    }

    public function getDoctor()
    {
        return $this->hasMany(Availability::className(), ['clinic_id' => 'id']);
    }

    public function count($model)
    {
        $no = Appointment::find()
                ->where(['clinic_id' => $model->id])
                ->andWhere(['<=', 'clinic_rate', 5])
                // ->orWhere(['>=', 'clinic_rate', 1])
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
                ->where(['clinic_id' => $model->id])
                ->andWhere(['<=', 'clinic_rate', 5])
                // ->orWhere(['>=', 'clinic_rate', 1])
                ->sum('clinic_rate');
        if ($no) {
            return $no;
        }else{
            return 0;
        }
    }

    // public static function getPhoto($photo)
    // {
    //     $dispImg = is_file(Yii::getAlias('@webroot').'/img/'.$photo) ? true :false;
    //     return Yii::getAlias('@web')."/img/".(($dispImg) ? $photo : "no-photo.png");
    // }
	
	public static function find() {
		return new MedicalQuery(get_called_class());
	}
}

class MedicalQuery extends \api\components\db\ActiveQuery
{
}