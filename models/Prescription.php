<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;


class Prescription extends ActiveRecord
{


    public static function tableName()
    {
        return 'prescriptions';
    }




    /*
    |--------------------------------------------------------------------------
    | STATUS CONSTANTS
    |--------------------------------------------------------------------------
    */


    const STATUS_PENDING = 'Pending';

    const STATUS_ACTIVE = 'Active';

    const STATUS_DISPENSED = 'Dispensed';

    const STATUS_CANCELLED = 'Cancelled';







    /*
    |--------------------------------------------------------------------------
    | VALIDATION RULES
    |--------------------------------------------------------------------------
    */


    public function rules()
    {


        return [



            /*
            EMR REQUIRED FIELDS
            */


            [

                [
                    'visit_id',
                    'doctor_id',
                    'drug_name',
                    'dosage',
                    'frequency',
                    'duration'
                ],

                'required'

            ],





            /*
            INTEGER FIELDS
            */


            [

                [
                    'id',
                    'visit_id',
                    'patient_id',
                    'doctor_id',
                    'medicine_id',
                    'quantity'
                ],

                'integer'

            ],






            /*
            STRING FIELDS
            */


            [

                [
                    'drug_name',
                    'dosage',
                    'frequency',
                    'duration',
                    'status'
                ],

                'string',

                'max'=>255

            ],





            [
                'instructions',
                'string'
            ],






            /*
            SAFE DATE FIELDS
            */


            [

                [
                    'created_at',
                    'dispensed_at'
                ],

                'safe'

            ],





            /*
            STATUS VALIDATION
            */


            [

                'status',

                'in',

                'range'=>[

                    self::STATUS_PENDING,

                    self::STATUS_ACTIVE,

                    self::STATUS_DISPENSED,

                    self::STATUS_CANCELLED

                ]

            ],





            /*
            DEFAULT QUANTITY
            */


            [

                'quantity',

                'default',

                'value'=>1

            ],






            /*
            DEFAULT STATUS
            */


            [

                'status',

                'default',

                'value'=>self::STATUS_PENDING

            ]

        ];

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







    public function getDoctor()
    {

        return $this->hasOne(

            User::class,

            [
                'id'=>'doctor_id'
            ]

        );

    }







    public function getMedicine()
    {

        return $this->hasOne(

            Medicine::class,

            [
                'id'=>'medicine_id'
            ]

        );

    }







    public function getVisit()
    {

        return $this->hasOne(

            PatientVisit::class,

            [
                'id'=>'visit_id'
            ]

        );

    }









    /*
    |--------------------------------------------------------------------------
    | BEFORE VALIDATE
    |--------------------------------------------------------------------------
    */


    public function beforeValidate()
    {


        if(parent::beforeValidate())
        {


            if(empty($this->quantity))
            {

                $this->quantity = 1;

            }





            if(empty($this->status))
            {

                $this->status =
                    self::STATUS_PENDING;

            }





            return true;


        }


        return false;


    }









    /*
    |--------------------------------------------------------------------------
    | BEFORE SAVE
    |--------------------------------------------------------------------------
    */


    public function beforeSave($insert)
    {


        if(parent::beforeSave($insert))
        {


            if(empty($this->created_at))
            {

                $this->created_at =
                    date('Y-m-d H:i:s');

            }




            return true;


        }


        return false;


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


            return

            $this->patient->first_name
            .' '.
            $this->patient->last_name;


        }



        return "Unknown";


    }









    public function getMedicineName()
    {


        if($this->medicine)
        {

            return $this->medicine->name;

        }



        return $this->drug_name ?? "Unknown";


    }









    /*
    |--------------------------------------------------------------------------
    | STATUS BADGE
    |--------------------------------------------------------------------------
    */



    public function getStatusBadge()
    {


        switch($this->status)
        {



            case self::STATUS_PENDING:


                return '

                <span class="badge bg-warning">

                ⏳ Pending Pharmacy

                </span>';





            case self::STATUS_ACTIVE:


                return '

                <span class="badge bg-primary">

                💊 Active

                </span>';





            case self::STATUS_DISPENSED:


                return '

                <span class="badge bg-success">

                ✅ Dispensed

                </span>';





            case self::STATUS_CANCELLED:


                return '

                <span class="badge bg-danger">

                ❌ Cancelled

                </span>';

        }



        return $this->status;


    }









    /*
    |--------------------------------------------------------------------------
    | PHARMACY DISPENSE
    |--------------------------------------------------------------------------
    */



    public function dispense()
    {


        if(
            in_array(
                $this->status,
                [

                    self::STATUS_DISPENSED,

                    self::STATUS_CANCELLED

                ]
            )
        )
        {

            return false;

        }




        $this->status =
            self::STATUS_DISPENSED;




        $this->dispensed_at =
            date('Y-m-d H:i:s');






        if($this->hasAttribute('dispensed_by'))
        {

            $this->dispensed_by =
                Yii::$app->user->id;

        }






        return $this->save(false);


    }









    /*
    |--------------------------------------------------------------------------
    | CANCEL
    |--------------------------------------------------------------------------
    */


    public function cancel()
    {


        if(
            $this->status ==
            self::STATUS_DISPENSED
        )
        {

            return false;

        }




        $this->status =
            self::STATUS_CANCELLED;




        return $this->save(false);


    }









    /*
    |--------------------------------------------------------------------------
    | STATUS CHECK
    |--------------------------------------------------------------------------
    */



    public function isPending()
    {


        return in_array(

            $this->status,

            [

                self::STATUS_PENDING,

                self::STATUS_ACTIVE

            ]

        );


    }





}