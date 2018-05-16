<?php

namespace api\common\models;

class Availability extends \api\components\db\ActiveRecord
{

	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return '{{availability}}';
	}
	public function fields()
    {
        return [
            'id',
            'physician_id',
            'clinic_id',
            'doctor' => function($model) { return $model->doctor->name; },
            'clinic' => function($model) { return $model->clinic->name; },
            // 'specialization' => function($model) { return $model->spec->specialty_id; },
            'specialization' => function($model) { return $model->spec($model); },
            'day' => function($model) { return $model->date; },
            'from_time',
            'to_time',
            'appointment_fee',
        ];
    }

    public function extraFields() {
        return [
            'clinic' => function($model) { return $model->clinic; },
            'insurance' => function($model) { return $model->insurance; }
            // 'items' => function($model) { return $model->item; }
        ];
    }

	public function getClinic()
    {
        return $this->hasOne(Medical::className(), ['id' => 'clinic_id']);
    }

    public function getDoctor()
    {
        
        return $this->hasOne(Physicain::className(), ['id' => 'physician_id']);
    }

    public function getInsurance()
    {
        
        return $this->hasMany(InsuranceAcceptance::className(), ['availability_id' => 'id']);
    }

    public function spec($model)
    {
        $specialization = Specialization::find()
                ->where(['clinic_id' => $model->clinic_id])
                ->andWhere(['physician_id' => $model->physician_id])->one();
        if ($specialization) {
            return $specialization->speciality->name;;
        }else{
            return 0;
        }
    }

	public static function find() {
		return new AvailabilityQuery(get_called_class());
	}
}

class AvailabilityQuery extends \api\components\db\ActiveQuery
{
}