<?php

namespace api\common\models;

class Specialization extends \api\components\db\ActiveRecord
{

	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return '{{specialization}}';
	}
	public function fields()
    {
        return [
            'id',
            // 'speciality_id',
            'clinic_id',
            'physician_id',
            'Speciality' => function($model) { return $model->speciality->name; },
            // 'clinic' => function($model) { return $model->clinic->name; },
            // 'Doctor' => function($model) { return $model->doctor->name; },
        ];
    }

     public function extraFields() {
        return [
            'medical' => function($model) { return $model->clinic; },
            'doctors' => function($model) { return $model->doctor; }
            // 'items' => function($model) { return $model->item; }
        ];
    }
	
	public static function find() {
		return new SpecializationQuery(get_called_class());
	}

	public function getDoctor()
    {
        return $this->hasOne(Physician::className(), ['physician_id' => 'id']);
    }

    public function getClinic()
    {
        return $this->hasOne(Medical::className(), ['clinic_id' => 'id']);
    }

    public function getSpeciality()
    {
        return $this->hasOne(Speciality::className(), ['id' => 'specialty_id']);
    }
}

class SpecializationQuery extends \api\components\db\ActiveQuery
{
}