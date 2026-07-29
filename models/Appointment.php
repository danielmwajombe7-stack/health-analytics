<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class Appointment extends ActiveRecord
{
    public static function tableName()
    {
        return 'appointments';
    }

    const STATUS_PENDING   = 'Pending';
    const STATUS_CONFIRMED = 'Confirmed';
    const STATUS_COMPLETED = 'Completed';
    const STATUS_CANCELLED = 'Cancelled';

    public function rules()
    {
        return [

            [['patient_id', 'department_id', 'appointment_date'], 'required'],

            [['patient_id', 'doctor_id', 'department_id', 'created_by'], 'integer'],

            [['appointment_date', 'appointment_time', 'created_at', 'updated_at'], 'safe'],

            ['status', 'in', 'range' => array_keys(self::statusList())],

            ['reason', 'string', 'max' => 255],

        ];
    }

    public function attributeLabels()
    {
        return [

            'patient_id'       => 'Patient',
            'doctor_id'        => 'Doctor',
            'department_id'    => 'Department',
            'appointment_date' => 'Appointment Date',
            'appointment_time' => 'Appointment Time',
            'reason'           => 'Reason',
            'status'           => 'Status',

        ];
    }

    public static function statusList()
    {
        return [

            self::STATUS_PENDING   => 'Pending',
            self::STATUS_CONFIRMED => 'Confirmed',
            self::STATUS_COMPLETED => 'Completed',
            self::STATUS_CANCELLED => 'Cancelled',

        ];
    }

    /*
     * PATIENT
     */
    public function getPatient()
    {
        return $this->hasOne(Patient::class, [
            'id' => 'patient_id'
        ]);
    }

    /*
     * DOCTOR
     */
    public function getDoctor()
    {
        return $this->hasOne(User::class, [
            'id' => 'doctor_id'
        ]);
    }

    /*
     * DEPARTMENT
     */
    public function getDepartment()
    {
        return $this->hasOne(Department::class, [
            'id' => 'department_id'
        ]);
    }

    /*
     * CREATED BY USER
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::class, [
            'id' => 'created_by'
        ]);
    }

    public function isPending()
    {
        return $this->status == self::STATUS_PENDING;
    }

    public function isCompleted()
    {
        return $this->status == self::STATUS_COMPLETED;
    }

    public function isCancelled()
    {
        return $this->status == self::STATUS_CANCELLED;
    }

    public function confirm()
    {
        $this->status = self::STATUS_CONFIRMED;
        return $this->save(false);
    }

    public function complete()
    {
        $this->status = self::STATUS_COMPLETED;
        return $this->save(false);
    }

    public function cancel()
    {
        $this->status = self::STATUS_CANCELLED;
        return $this->save(false);
    }

    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }

        $now = date('Y-m-d H:i:s');

        if ($insert) {

            $this->created_at = $now;

            if (Yii::$app->user && !Yii::$app->user->isGuest) {
                $this->created_by = Yii::$app->user->id;
            }

            if (empty($this->status)) {
                $this->status = self::STATUS_PENDING;
            }

        } else {

            $this->updated_at = $now;

        }

        return true;
    }
}