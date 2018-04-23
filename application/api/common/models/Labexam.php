<?php

namespace api\common\models;

class Labexam extends \api\components\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{lab_exam}}';
    }

    public function fields()
    {
        return [
            'name',
            'price',
            'description',
            'resault'
        ];
    }

    // public function getInsu()
    // {
    //     return $this->hasOne(Insurance::className(), ['id' => 'insurance_id']);
    // }

    public static function find() {
        return new LabexamQuery(get_called_class());
    }
}

class LabexamQuery extends \api\components\db\ActiveQuery
{
}