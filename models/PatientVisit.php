<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;


/**
 * Patient Visit Model
 *
 * Handles hospital patient visits
 *
 * Workflow:
 *
 * Patient
 *    |
 * Registration
 *    |
 * Patient Visit
 *    |
 * Queue
 *    |
 * Doctor Consultation
 *    |
 * Laboratory
 *    |
 * Pharmacy
 *    |
 * Discharge
 *
 */


class PatientVisit extends ActiveRecord
{


    public static function tableName()
    {
        return 'patient_visits';
    }





    /*
    |--------------------------------------------------------------------------
    | STATUS CONSTANTS
    |--------------------------------------------------------------------------
    */


    const OPEN = 'Open';

    const WAITING = 'Waiting';

    const CONSULTING = 'Consulting';

    const COMPLETED = 'Completed';

    const CANCELLED = 'Cancelled';






    /*
    |--------------------------------------------------------------------------
    | VALIDATION RULES
    |--------------------------------------------------------------------------
    */


  public function getVitalSigns()
{
    return $this->hasOne(
        VitalSigns::class,
        [
            'visit_id'=>'id'
        ]
    );
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
                    'visit_date',
                    'visit_type',
                    'status',
                    'notes'
                ],

                'safe'
            ],




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


            /*
            Default Visit Date
            */


            if($this->hasAttribute('visit_date')
                &&
                empty($this->visit_date))
            {

                $this->visit_date =
                    date(
                        'Y-m-d H:i:s'
                    );

            }






            /*
            Default Status
            */


            if($this->hasAttribute('status')
                &&
                empty($this->status))
            {

                $this->status =
                    self::OPEN;

            }






            /*
            Default Visit Type
            */


            if($this->hasAttribute('visit_type')
                &&
                empty($this->visit_type))
            {

                $this->visit_type =
                    'OPD';

            }



        }






        /*
        Update timestamp
        */


        if($this->hasAttribute('updated_at'))
        {

            $this->updated_at =
                date(
                    'Y-m-d H:i:s'
                );

        }





        return true;


    }









    /*
    |--------------------------------------------------------------------------
    | PATIENT RELATION
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









    /*
    |--------------------------------------------------------------------------
    | DOCTOR RELATION
    |--------------------------------------------------------------------------
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









    /*
    |--------------------------------------------------------------------------
    | QUEUE RELATION
    |--------------------------------------------------------------------------
    */


    public function getQueue()
    {


        return $this->hasOne(

            PatientQueue::class,

            [
                'visit_id'=>'id'
            ]

        );


    }









    /*
    |--------------------------------------------------------------------------
    | MEDICAL RECORDS
    |--------------------------------------------------------------------------
    */


    public function getMedicalRecords()
    {


        return $this->hasMany(

            MedicalRecords::class,

            [
                'visit_id'=>'id'
            ]

        );


    }









    /*
    |--------------------------------------------------------------------------
    | LAB REQUESTS
    |--------------------------------------------------------------------------
    */


    public function getLabRequests()
    {


        return $this->hasMany(

            LabRequest::class,

            [
                'patient_id'=>'patient_id'
            ]

        );


    }









    /*
    |--------------------------------------------------------------------------
    | PRESCRIPTIONS
    |--------------------------------------------------------------------------
    */


    public function getPrescriptions()
    {


        return $this->hasMany(

            Prescription::class,

            [
                'visit_id'=>'id'
            ]

        );


    }









    /*
    |--------------------------------------------------------------------------
    | DISPLAY PATIENT NAME
    |--------------------------------------------------------------------------
    */


    public function getPatientName()
    {


        if($this->patient)
        {


            return $this->patient->fullName
                ??
                $this->patient->first_name
                ??
                'Unknown Patient';


        }



        return 'Unknown Patient';


    }









    /*
    |--------------------------------------------------------------------------
    | DISPLAY DOCTOR NAME
    |--------------------------------------------------------------------------
    */


    public function getDoctorName()
    {


        if($this->doctor)
        {


            return $this->doctor->username
                ??
                $this->doctor->name
                ??
                'Doctor';


        }



        return 'Not Assigned';


    }









    /*
    |--------------------------------------------------------------------------
    | STATUS LABEL
    |--------------------------------------------------------------------------
    */


    public function getStatusLabel()
    {


        return match($this->status)
        {


            self::OPEN =>

                '🟢 Open',



            self::WAITING =>

                '⏳ Waiting',



            self::CONSULTING =>

                '🩺 Consulting',



            self::COMPLETED =>

                '✅ Completed',



            self::CANCELLED =>

                '❌ Cancelled',



            default =>

                $this->status


        };


    }









    /*
    |--------------------------------------------------------------------------
    | COMPLETE VISIT
    |--------------------------------------------------------------------------
    */


    public function complete()
    {


        $this->status =
            self::COMPLETED;



        if($this->hasAttribute('completed_at'))
        {

            $this->completed_at =
                date(
                    'Y-m-d H:i:s'
                );

        }




        return $this->save(false);


    }









    /*
    |--------------------------------------------------------------------------
    | CANCEL VISIT
    |--------------------------------------------------------------------------
    */


    public function cancel()
    {


        $this->status =
            self::CANCELLED;


        return $this->save(false);


    }









    /*
    |--------------------------------------------------------------------------
    | QUERY HELPERS
    |--------------------------------------------------------------------------
    */


    public static function today()
    {


        return self::find()

            ->where([

                'between',

                'visit_date',

                date('Y-m-d').' 00:00:00',

                date('Y-m-d').' 23:59:59'

            ]);


    }







    public static function active()
    {


        return self::find()

            ->where([

                'in',

                'status',

                [

                    self::OPEN,

                    self::WAITING,

                    self::CONSULTING

                ]

            ]);


    }






}