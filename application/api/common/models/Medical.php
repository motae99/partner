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
            'rate',
            'app_service',
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
            'doctors' => function($model) { return $model->doctor; }
            // 'items' => function($model) { return $model->item; }
        ];
    }

    public function getSpec()
    {
        return $this->hasMany(Specialization::className(), ['clinic_id' => 'id']);
    }

    public function getDoctor()
    {
        return $this->hasMany(Availability::className(), ['clinic_id' => 'id']);
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