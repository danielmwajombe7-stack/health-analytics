<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;


class VitalSigns extends ActiveRecord
{


    public static function tableName()
    {
        return 'vital_signs';
    }





    /*
    ======================================
    VALIDATION RULES
    ======================================
    */

    public function rules()
    {

        return [

            [
                [
                    'visit_id',
                    'recorded_by'
                ],
                'required'
            ],


            [
                [
                    'visit_id',
                    'pulse_rate',
                    'respiratory_rate',
                    'pain_score',
                    'recorded_by',
                    'triaged_by'
                ],
                'integer'
            ],



            [
                [
                    'temperature',
                    'weight',
                    'height',
                    'bmi',
                    'oxygen_saturation'
                ],
                'number'
            ],



            [
                [
                    'blood_pressure',
                    'consciousness',
                    'triage_status',
                    'triage_level',
                    'nurse_notes'
                ],
                'safe'
            ],



            [
                [
                    'created_at',
                    'triaged_at'
                ],
                'safe'
            ],



            [
                'pain_score',
                'integer',
                'min'=>0,
                'max'=>10
            ],



            [
                'oxygen_saturation',
                'number',
                'min'=>0,
                'max'=>100
            ],



            [
                'temperature',
                'number',
                'min'=>25,
                'max'=>45
            ]

        ];

    }








    /*
    ======================================
    RELATIONS
    ======================================
    */



    public function getVisit()
    {

        return $this->hasOne(
            PatientVisit::class,
            [
                'id'=>'visit_id'
            ]
        );

    }






    public function getRecordedBy()
    {

        return $this->hasOne(
            User::class,
            [
                'id'=>'recorded_by'
            ]
        );

    }






    public function getTriagedBy()
    {

        return $this->hasOne(
            User::class,
            [
                'id'=>'triaged_by'
            ]
        );

    }








    /*
    ======================================
    BEFORE SAVE
    AUTO CALCULATIONS
    ======================================
    */


    public function beforeSave($insert)
    {

        if(parent::beforeSave($insert))
        {


            /*
            ============================
            AUTO BMI
            ============================
            */


            if(
                !empty($this->weight)
                &&
                !empty($this->height)
            )
            {


                $this->bmi =
                    round(

                        $this->weight /
                        (
                            $this->height *
                            $this->height
                        ),

                        2
                    );

            }






            /*
            ============================
            AUTO TRIAGE LEVEL
            ============================
            */


            $this->triage_level =
                $this->calculateTriageLevel();





            if(empty($this->triage_status))
            {

                $this->triage_status =
                    'Pending';

            }





            if(!$this->triaged_at)
            {

                $this->triaged_at =
                    date('Y-m-d H:i:s');

            }



            return true;

        }


        return false;

    }









    /*
    ======================================
    TRIAGE INTELLIGENCE
    ======================================
    */


    public function calculateTriageLevel()
    {


        /*
        Emergency Conditions
        */


        if(
            $this->oxygen_saturation
            &&
            $this->oxygen_saturation < 90
        )
        {

            return 'Emergency';

        }




        if(
            $this->temperature
            &&
            $this->temperature >=39
        )
        {

            return 'High';

        }





        if(
            $this->blood_pressure
            &&
            preg_match(
                '/^(\d+)/',
                $this->blood_pressure,
                $match
            )
            &&
            $match[1] >=180
        )
        {

            return 'Critical';

        }






        if(
            $this->pain_score
            &&
            $this->pain_score >=8
        )
        {

            return 'High';

        }




        return 'Normal';


    }









    /*
    ======================================
    BMI STATUS
    ======================================
    */


    public function getBmiStatus()
    {


        if(!$this->bmi)
        {
            return null;
        }



        if($this->bmi <18.5)
        {
            return 'Underweight';
        }


        if($this->bmi <25)
        {
            return 'Normal';
        }


        if($this->bmi <30)
        {
            return 'Overweight';
        }


        return 'Obese';


    }









    /*
    ======================================
    LABELS
    ======================================
    */


    public function attributeLabels()
    {

        return [

            'visit_id'=>'Patient Visit',

            'temperature'=>'Temperature °C',

            'blood_pressure'=>'Blood Pressure',

            'pulse_rate'=>'Pulse Rate',

            'respiratory_rate'=>'Respiratory Rate',

            'oxygen_saturation'=>'Oxygen Saturation',

            'weight'=>'Weight (kg)',

            'height'=>'Height (m)',

            'bmi'=>'BMI',

            'pain_score'=>'Pain Score',

            'consciousness'=>'Consciousness',

            'nurse_notes'=>'Nurse Notes',

            'triage_status'=>'Triage Status',

            'triage_level'=>'Triage Level',

            'recorded_by'=>'Recorded By',

            'triaged_by'=>'Triaged By',

            'triaged_at'=>'Triaged At',

        ];

    }



}