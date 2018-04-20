<?php

namespace api\common\models;

class Appointment extends \api\components\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{appointment}}';
    }

    public function fields()
    {
        return [
            'id',
            'patient_id',
            'patient' => function($model) { return $model->patient->name; },
            'clinic' => function($model) { return $model->clinic->name; },
            'doctor' => function($model) { return $model->doctor->name; },
            'date' => function($model) { return $model->calender->date; },
            'from_time' => function($model) { return $model->calender->start_time; },
            'to_time' => function($model) { return $model->calender->end_time; },
            'queue' => function($model) { return $model->queue($model); },
            'current' => function($model) { return $model->visit($model); },
            'time' => function($model) { return $model->time($model); },
            'status',
            'stat',
            'fee',
            'insured_fee',
            'insured',
            // 'physician_id',
        ];
    }

    public function extraFields() {
        return [
            'schedule' => function($model) { return $model->scheduale; },
        ];
    }

    public function getScheduale()
    {
        return $this->hasMany(Schedule::className(), ['calender_id' => 'calender_id']);
    }


    public function getCalender()
    {
        return $this->hasOne(Calender::className(), ['id' => 'calender_id']);
    }

    public function Queue($model)
    {
        $confirmed = Appointment::find()
            ->where(['calender_id' => $model->calender_id])
            ->andWhere(['status' => 'confirmed'])
            // ->andWhere(['<', 'confirmed_at', $model->confirmed_at])
            ->count();

        $booked = Appointment::find()
            ->where(['calender_id' => $model->calender_id])
            ->andWhere(['status' => 'booked'])
            ->andWhere(['<=', 'created_at', $model->created_at])
            ->count();
        if ($model->status == 'booked') {
            return $confirmed+$booked;
        }
        elseif($model->status == 'confirmed'){
            $schedule = Schedule::find()
            ->where(['appointment_id' => $model->id])
            ->one();
            return $schedule->queue;
        }

        
    }

    public function Visit($model)
    {
        $proccessing = Appointment::find()
            ->where(['calender_id' => $model->calender_id])
            ->andWhere(['stat' => 'processing'])
            ->one();

        if ($proccessing) {
            $schedule = Schedule::find()
            ->where(['appointment_id' => $proccessing->id])
            ->one();
            return $schedule->queue;
        }else{
            return "NaN";
        }
    }

    public function Time($model)
    {
        $schedule = Schedule::find()->where(['appointment_id' => $model->id])->one();
        if ($schedule) {
            return $schedule->schedule_time;
        }else{
            return "NaN";
        }
    }

    public function getDoctor()
    {
        return $this->hasOne(Physicain::className(), ['id' => 'physician_id']);
    }

    public function getPatient()
    {
        return $this->hasOne(Patient::className(), ['id' => 'patient_id']);
    }

    public function getClinic()
    {
        return $this->hasOne(Medical::className(), ['id' => 'clinic_id']);
    }


    public static function find() {
        return new AppointmentQuery(get_called_class());
    }
}

class AppointmentQuery extends \api\components\db\ActiveQuery
{
}