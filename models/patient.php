<?php

namespace app\models;

use yii\db\ActiveRecord;
use app\models\User;
use app\models\PatientVisit;
use app\models\PatientQueue;
use app\models\Appointment;


class Patient extends ActiveRecord
{


    public static function tableName()
    {
        return 'patients';
    }






    public function rules()
    {

        return [

            [
                [
                    'patient_number',
                    'first_name',
                    'last_name',
                    'gender'
                ],
                'required'
            ],



            [
                [
                    'created_by',
                    'is_first_visit'
                ],
                'integer'
            ],



            [
                [
                    'date_of_birth',
                    'registration_date',
                    'created_at',
                    'updated_at'
                ],
                'safe'
            ],




            [
                [

                    'middle_name',
                    'full_name',

                    'phone',
                    'email',
                    'address',

                    'region',
                    'district',
                    'ward',

                    'blood_group',

                    'marital_status',
                    'occupation',

                    'nationality',

                    'national_id',
                    'passport_number',

                    'next_of_kin',
                    'next_of_kin_phone',

                    'emergency_contact',

                    'insurance_type',
                    'insurance_number',

                    'patient_type',
                    'patient_category',
                    'registration_source',

                    'risk_level',

                    'profile_photo',

                    'status'

                ],
                'safe'
            ],




            [
                'email',
                'email'
            ],





            [
                'gender',
                'in',
                'range'=>[
                    'Male',
                    'Female'
                ]
            ],






            /*
            Patient Service Type
            */

            [
                'patient_type',
                'in',
                'range'=>[

                    'OPD',
                    'IPD',
                    'Emergency',
                    'Follow Up',
                    'Preventive Care'

                ]
            ],







            /*
            Patient Category
            */

            [
                'patient_category',
                'in',
                'range'=>[

                    'New Patient',
                    'Returning Patient',
                    'Emergency Patient',
                    'VIP Patient',
                    'Chronic Care Patient',
                    'Referral Patient',
                    'Insurance Patient',
                    'Walk-in Patient'

                ]
            ],






            /*
            Registration Source
            */

            [
                'registration_source',
                'in',
                'range'=>[

                    'Reception',
                    'Online Appointment',
                    'Referral',
                    'Emergency',
                    'Walk-in'

                ]
            ],






            /*
            Risk Level
            */

            [
                'risk_level',
                'in',
                'range'=>[

                    'Low',
                    'Medium',
                    'High',
                    'Critical'

                ]
            ]


        ];

    }









    /**
     * Before Save
     */

    public function beforeSave($insert)
    {


        if(parent::beforeSave($insert))
        {



            /*
            Generate Full Name
            */

            $this->full_name = trim(

                $this->first_name.' '.

                ($this->middle_name ?? '').' '.

                $this->last_name

            );







            /*
            Default Nationality
            */

            if(empty($this->nationality))
            {

                $this->nationality="Tanzanian";

            }








            /*
            Default Patient Type
            */

            if(empty($this->patient_type))
            {

                $this->patient_type="OPD";

            }







            /*
            Default Patient Category
            */

            if(empty($this->patient_category))
            {

                $this->patient_category="New Patient";

            }








            /*
            Default Registration Source
            */

            if(empty($this->registration_source))
            {

                $this->registration_source="Reception";

            }








            /*
            Default Risk
            */

            if(empty($this->risk_level))
            {

                $this->risk_level="Low";

            }








            /*
            First Visit Default
            */

            if($this->is_first_visit===null)
            {

                $this->is_first_visit=1;

            }







            /*
            Registration Date
            */

            if(empty($this->registration_date))
            {

                $this->registration_date=date('Y-m-d');

            }





            return true;

        }


        return false;

    }









    /**
     * Full Name
     */

    public function getFullName()
    {

        return trim(

            $this->first_name.' '.

            ($this->middle_name ?? '').' '.

            $this->last_name

        );

    }









    /**
     * Age Calculation
     */

    public function getAge()
    {

        if(empty($this->date_of_birth))
        {
            return null;
        }



        $birthDate =
            new \DateTime(
                $this->date_of_birth
            );



        $today =
            new \DateTime();



        return $today->diff($birthDate)->y;

    }









    public function getDob()
    {

        return $this->date_of_birth;

    }



    public function setDob($value)
    {

        $this->date_of_birth=$value;

    }









    public function getPatientId()
    {

        return $this->id;

    }









    public function getCreatedByUser()
    {

        return $this->hasOne(
            User::class,
            [
                'id'=>'created_by'
            ]
        );

    }









    public function getVisits()
    {

        return $this->hasMany(
            PatientVisit::class,
            [
                'patient_id'=>'id'
            ]
        );

    }









    public function getQueues()
    {

        return $this->hasMany(
            PatientQueue::class,
            [
                'patient_id'=>'id'
            ]
        );

    }









    public function getAppointments()
    {

        return $this->hasMany(
            Appointment::class,
            [
                'patient_id'=>'id'
            ]
        );

    }









    public function attributeLabels()
    {

        return [

            'patient_number'=>'Patient Number',

            'first_name'=>'First Name',

            'middle_name'=>'Middle Name',

            'last_name'=>'Last Name',

            'full_name'=>'Full Name',


            'date_of_birth'=>'Date Of Birth',

            'dob'=>'Date Of Birth',

            'age'=>'Age',


            'gender'=>'Gender',


            'blood_group'=>'Blood Group',


            'phone'=>'Phone Number',

            'email'=>'Email',

            'address'=>'Residential Address',


            'region'=>'Region',

            'district'=>'District',

            'ward'=>'Ward',


            'national_id'=>'National ID',

            'passport_number'=>'Passport Number',



            'patient_type'=>'Patient Type',

            'patient_category'=>'Patient Category',

            'registration_source'=>'Registration Source',


            'risk_level'=>'Risk Level',

            'is_first_visit'=>'First Visit',



            'next_of_kin'=>'Next Of Kin',

            'next_of_kin_phone'=>'Next Of Kin Phone',



            'insurance_type'=>'Insurance Type',

            'insurance_number'=>'Insurance Number',


            'profile_photo'=>'Profile Photo'


        ];

    }


}