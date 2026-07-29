<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;


class MedicalRecords extends ActiveRecord
{


    /*
    |--------------------------------------------------------------------------
    | TABLE
    |--------------------------------------------------------------------------
    */


    public static function tableName()
    {
        return 'medical_records';
    }





    /*
    |--------------------------------------------------------------------------
    | RULES
    |--------------------------------------------------------------------------
    */


    public function rules()
    {

        return [


            [
                [
                    'patient_id',
                    'doctor_id'
                ],
                'required'
            ],



            [
                [
                    'patient_id',
                    'doctor_id',
                    'queue_id',
                    'visit_id'
                ],
                'integer'
            ],



            [
                [
                    'blood_pressure',
                    'temperature',
                    'pulse_rate',
                    'weight',
                    'height',
                    'complaint',
                    'diagnosis',
                    'treatment',
                    'notes',
                    'status'
                ],
                'safe'
            ],



            [
                [
                    'created_at',
                    'updated_at'
                ],
                'safe'
            ]

        ];

    }








    /*
    |--------------------------------------------------------------------------
    | BEFORE SAVE
    |--------------------------------------------------------------------------
    */


    public function beforeSave($insert)
    {


        if(!parent::beforeSave($insert))
        {
            return false;
        }



        if($insert)
        {


            if(
                $this->hasAttribute('created_at')
                &&
                empty($this->created_at)
            )
            {

                $this->created_at =
                    date('Y-m-d H:i:s');

            }





            if(
                $this->hasAttribute('status')
                &&
                empty($this->status)
            )
            {

                $this->status = "Active";

            }



        }





        if(
            $this->hasAttribute('updated_at')
        )
        {

            $this->updated_at =
                date('Y-m-d H:i:s');

        }



        return true;

    }










    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
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






    public function getVisit()
    {


        /*
        Prevent error if visit_id
        does not exist in table
        */


        if(!$this->hasAttribute('visit_id'))
        {
            return null;
        }



        return $this->hasOne(
            PatientVisit::class,
            [
                'id'=>'visit_id'
            ]
        );

    }







    public function getDoctor()
    {

        return $this->hasOne(
            User::class,
            [
                'id'=>'doctor_id'
            ]
        );

    }








    public function getQueue()
    {

        if(!$this->hasAttribute('queue_id'))
        {
            return null;
        }



        return $this->hasOne(
            PatientQueue::class,
            [
                'id'=>'queue_id'
            ]
        );

    }









    public function getPrescriptions()
    {


        return $this->hasMany(
            Prescription::class,
            [
                'patient_id'=>'patient_id'
            ]
        )
        ->orderBy([
            'id'=>SORT_DESC
        ]);

    }










    public function getLabTests()
    {


        return $this->hasMany(
            LabTest::class,
            [
                'patient_id'=>'patient_id'
            ]
        )
        ->orderBy([
            'id'=>SORT_DESC
        ]);

    }









    /*
    |--------------------------------------------------------------------------
    | DISPLAY HELPERS
    |--------------------------------------------------------------------------
    */



    public function getPatientName()
    {


        if($this->patient)
        {


            if(
                isset($this->patient->fullName)
            )
            {

                return $this->patient->fullName;

            }



            return trim(

                ($this->patient->first_name ?? '')

                ." ".

                ($this->patient->last_name ?? '')

            );


        }


        return "Unknown Patient";

    }









    public function getDoctorName()
    {


        if($this->doctor)
        {

            return
                $this->doctor->full_name
                ??
                $this->doctor->username
                ??
                "Doctor";

        }


        return "Unknown Doctor";

    }









    /*
    |--------------------------------------------------------------------------
    | SUMMARY
    |--------------------------------------------------------------------------
    */


    public function getSummary()
    {


        return [

            'patient'=>$this->patientName,

            'doctor'=>$this->doctorName,

            'complaint'=>$this->complaint,

            'diagnosis'=>$this->diagnosis,

            'treatment'=>$this->treatment,

            'date'=>$this->created_at

        ];


    }









    /*
    |--------------------------------------------------------------------------
    | STATUS
    |--------------------------------------------------------------------------
    */


    public function getStatusLabel()
    {


        return match($this->status)
        {


            "Active"
            =>
            "🟢 Active",


            "Closed"
            =>
            "⚪ Closed",


            "Critical"
            =>
            "🔴 Critical",


            default
            =>
            $this->status ?? "Unknown"


        };


    }









    /*
    |--------------------------------------------------------------------------
    | API OUTPUT
    |--------------------------------------------------------------------------
    */


    public function toArray(
        array $fields = [],
        array $expand = [],
        $recursive = true
    )
    {


        $data = parent::toArray(
            $fields,
            $expand,
            $recursive
        );




        $data['patient_name'] =
            $this->patientName;



        $data['doctor_name'] =
            $this->doctorName;



        $data['status_label'] =
            $this->statusLabel;



        return $data;


    }



}