<?php

namespace api\common\models;

class Speciality extends \api\components\db\ActiveRecord
{

	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return '{{speciality}}';
	}

	public function fields()
    {
        return [
            'id',
            'name',
        ];
    }


	
	public static function find() {
		return new SpecialityQuery(get_called_class());
	}

	
}

class SpecialityQuery extends \api\components\db\ActiveQuery
{
}