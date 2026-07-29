<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;


/**
 * Admission Model
 *
 * @property int $id
 * @property int $patient_id
 * @property int|null $doctor_id
 * @property string|null $admission_date
 * @property string|null $discharge_date
 * @property string|null $status
 * @property string|null $created_at
 */
class Admission extends ActiveRecord
{


    public static function tableName()
    {
        return 'admissions';
    }




    public function rules()
    {

        return [

            [
                [
                    'patient_id'
                ],
                'required'
            ],


            [
                [
                    'patient_id',
                    'doctor_id'
                ],
                'integer'
            ],


            [
                [
                    'admission_date',
                    'discharge_date',
                    'created_at'
                ],
                'safe'
            ],


            [
                'status',
                'string',
                'max'=>50
            ]

        ];

    }





    /**
     * Patient Relation
     */
    public function getPatient()
    {

        return $this->hasOne(
            Patient::class,
            [
                'id'=>'patient_id'
            ]
        );

    }





    /**
     * Doctor Relation
     */
    public function getDoctor()
    {

        return $this->hasOne(
            User::class,
            [
                'id'=>'doctor_id'
            ]
        );

    }




    /**
     * Admission Status
     */
    public static function statusList()
    {

        return [

            'Admitted'=>'Admitted',

            'Discharged'=>'Discharged',

            'Pending'=>'Pending'

        ];

    }



}