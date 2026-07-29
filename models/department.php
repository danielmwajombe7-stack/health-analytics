<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "departments".
 *
 * @property int $id
 * @property string $department_name
 * @property string|null $description
 * @property int|null $status
 * @property string $created_at
 *
 * @property Appointments[] $appointments
 * @property PatientVisits[] $patientVisits
 */
class department extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'departments';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description'], 'default', 'value' => null],
            [['status'], 'default', 'value' => 1],
            [['department_name'], 'required'],
            [['description'], 'string'],
            [['status'], 'integer'],
            [['created_at'], 'safe'],
            [['department_name'], 'string', 'max' => 100],
            [['department_name'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'department_name' => 'Department Name',
            'description' => 'Description',
            'status' => 'Status',
            'created_at' => 'Created At',
        ];
    }

    /**
     * Gets query for [[Appointments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAppointments()
    {
        return $this->hasMany(Appointments::class, ['department_id' => 'id']);
    }

    /**
     * Gets query for [[PatientVisits]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPatientVisits()
    {
        return $this->hasMany(PatientVisits::class, ['department_id' => 'id']);
    }

}
