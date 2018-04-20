<?php

namespace api\common\models;

class Patient extends \api\components\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{patient}}';
    }


    public static function find() {
        return new PatientQuery(get_called_class());
    }
}

class PatientQuery extends \api\components\db\ActiveQuery
{
}