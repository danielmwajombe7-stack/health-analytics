<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;


/**
 * Diagnosis Model
 *
 * Clinical Diagnosis Management
 *
 * Patient
 *  |
 * Visit
 *  |
 * Doctor Consultation
 *  |
 * Diagnosis
 *
 */


class Diagnosis extends ActiveRecord
{


    /*
    |--------------------------------------------------------------------------
    | Temporary Virtual Attribute
    |--------------------------------------------------------------------------
    |
    | Allows:
    | $form->field($model,'diagnosis')
    |
    | while database uses diagnosis_note
    |
    */

    public $diagnosis;




    public static function tableName()
    {
        return 'diagnoses';
    }






    /*
    |--------------------------------------------------------------------------
    | CONSTANTS
    |--------------------------------------------------------------------------
    */


    const MILD = 'Mild';

    const MODERATE = 'Moderate';

    const SEVERE = 'Severe';



    const ACTIVE = 'Active';

    const COMPLETED = 'Completed';









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
                    'visit_id',
                    'doctor_id'
                ],
                'required'
            ],




            [
                [
                    'patient_id',
                    'visit_id',
                    'doctor_id',
                    'disease_id'
                ],
                'integer'
            ],





            [
                [
                    'diagnosis',
                    'diagnosis_note',
                    'doctor_advice',
                    'severity',
                    'status'
                ],
                'string'
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
    | BEFORE VALIDATION
    |--------------------------------------------------------------------------
    */


    public function beforeValidate()
    {


        if(parent::beforeValidate())
        {


            /*
            Convert virtual diagnosis
            into database field
            */


            if(
                !empty($this->diagnosis)
            )
            {

                $this->diagnosis_note =
                    $this->diagnosis;

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


        if(!parent::beforeSave($insert))
        {
            return false;
        }




        if($insert)
        {


            if(
                $this->hasAttribute('status')
                &&
                empty($this->status)
            )
            {

                $this->status =
                    self::ACTIVE;

            }






            if(
                $this->hasAttribute('severity')
                &&
                empty($this->severity)
            )
            {

                $this->severity =
                    self::MILD;

            }







            if(
                $this->hasAttribute('created_at')
                &&
                empty($this->created_at)
            )
            {

                $this->created_at =
                    date('Y-m-d H:i:s');

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







    public function getDisease()
    {

        return $this->hasOne(
            Disease::class,
            [
                'id'=>'disease_id'
            ]
        );

    }









    /*
    |--------------------------------------------------------------------------
    | DISPLAY HELPERS
    |--------------------------------------------------------------------------
    */



    public function getDoctorName()
    {


        if($this->doctor)
        {

            return 
                $this->doctor->username
                ??
                $this->doctor->name
                ??
                'Doctor';

        }


        return 'Unknown Doctor';


    }







    public function getDiagnosisName()
    {


        if($this->disease)
        {

            return 
                $this->disease->name;

        }





        if(!empty($this->diagnosis_note))
        {

            return 
                $this->diagnosis_note;

        }





        return 'No Diagnosis';


    }









    public function getSeverityLabel()
    {


        return match($this->severity)
        {


            self::MILD =>
                '🟢 Mild',



            self::MODERATE =>
                '🟡 Moderate',



            self::SEVERE =>
                '🔴 Severe',



            default =>
                'Unknown'


        };


    }










    public function getStatusLabel()
    {


        return match($this->status)
        {


            self::ACTIVE =>
                '🩺 Active',



            self::COMPLETED =>
                '✅ Completed',



            default =>
                $this->status


        };


    }









    /*
    |--------------------------------------------------------------------------
    | COMPLETE
    |--------------------------------------------------------------------------
    */


    public function complete()
    {


        $this->status =
            self::COMPLETED;


        return $this->save(false);


    }









    /*
    |--------------------------------------------------------------------------
    | API OUTPUT
    |--------------------------------------------------------------------------
    */


    public function toArray(
        array $fields=[],
        array $expand=[],
        $recursive=true
    )
    {


        $data =
            parent::toArray(
                $fields,
                $expand,
                $recursive
            );




        $data['patient_name'] =
            'Unknown Patient';




        if($this->patient)
        {

            $data['patient_name'] =
                trim(
                    ($this->patient->first_name ?? '')
                    .' '.
                    ($this->patient->last_name ?? '')
                );

        }







        $data['doctor_name'] =
            $this->doctorName;





        $data['diagnosis'] =
            $this->diagnosisName;





        $data['severity_label'] =
            $this->severityLabel;





        $data['status_label'] =
            $this->statusLabel;





        return $data;


    }




}