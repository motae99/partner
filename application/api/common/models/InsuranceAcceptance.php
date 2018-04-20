<?php

namespace api\common\models;

class InsuranceAcceptance extends \api\components\db\ActiveRecord
{

	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return '{{insurance_acceptance}}';
	}
	public function fields()
    {
        return [
            'insurance_id',
            'physician_id',
            'clinic_id',
            'medical'=> function($model) { return $model->clinic->name; },
            'group'=> function($model) { return $model->clinic->type; },
            'insurance_provider'=> function($model) { return $model->provider->name; },
            'patient_payment',
        ];
    }

    // public function extraFields() {
    //     return [
    //         'clinic' => function($model) { return $model->clinic; },
    //         'insurance' => function($model) { return $model->insurance; }
    //         // 'items' => function($model) { return $model->item; }
    //     ];
    // }

	public function getProvider()
    {
        return $this->hasOne(Insurance::className(), ['id' => 'insurance_id']);
    }

    public function getDoctor()
    {
        
        return $this->hasOne(Physicain::className(), ['id' => 'physician_id']);
    }

    public function getClinic()
    {
        
        return $this->hasOne(Medical::className(), ['id' => 'clinic_id']);
    }

	public static function find() {
		return new InsuranceAcceptanceQuery(get_called_class());
	}
}

class InsuranceAcceptanceQuery extends \api\components\db\ActiveQuery
{
}