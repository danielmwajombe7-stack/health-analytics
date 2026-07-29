<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;


class LabRequest extends ActiveRecord
{

    public static function tableName()
    {
        return 'lab_requests';
    }



    /*
    |--------------------------------------------------------------------------
    | STATUS
    |--------------------------------------------------------------------------
    */

    const STATUS_PENDING='Pending';
    const STATUS_PROCESSING='Processing';
    const STATUS_COMPLETED='Completed';
    const STATUS_CANCELLED='Cancelled';


    const PRIORITY_NORMAL='Normal';
    const PRIORITY_URGENT='Urgent';
    const PRIORITY_CRITICAL='Critical';





    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */


    public function getPatient()
    {
        return $this->hasOne(
            Patient::class,
            ['id'=>'patient_id']
        );
    }



    public function getDoctor()
    {
        return $this->hasOne(
            User::class,
            ['id'=>'doctor_id']
        );
    }



    public function getVisit()
    {
        return $this->hasOne(
            PatientVisit::class,
            ['id'=>'visit_id']
        );
    }



    public function getQueue()
    {
        return $this->hasOne(
            PatientQueue::class,
            ['id'=>'queue_id']
        );
    }




    /*
    |--------------------------------------------------------------------------
    | TESTS
    |--------------------------------------------------------------------------
    */


    public function getLabTests()
    {
        return $this->hasMany(
            LabTest::class,
            ['request_id'=>'id']
        );
    }





    /*
    |--------------------------------------------------------------------------
    | RESULTS THROUGH TEST
    |--------------------------------------------------------------------------
    */


    public function getLabResults()
    {
        return $this->hasMany(
            LabResult::class,
            ['test_id'=>'id']
        )
        ->via('labTests');
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
                    'doctor_id',
                    'visit_id',
                    'queue_id',
                    'requested_by',
                    'test_id'
                ],
                'integer'
            ],


            [
                [
                    'test_name',
                    'priority',
                    'status'
                ],
                'string'
            ],


            [
                [
                    'doctor_note',
                    'created_at',
                    'updated_at',
                    'request_date',
                    'completed_at'
                ],
                'safe'
            ],


            [
                [
                    'patient_id',
                    'doctor_id',
                    'test_name'
                ],
                'required'
            ],


            [
                'status',
                'default',
                'value'=>self::STATUS_PENDING
            ],


            [
                'priority',
                'default',
                'value'=>self::PRIORITY_NORMAL
            ]

        ];

    }





    public function beforeSave($insert)
    {

        if(!parent::beforeSave($insert))
        {
            return false;
        }


        if($insert)
        {

            $this->status =
                $this->status ?: self::STATUS_PENDING;


            $this->priority =
                $this->priority ?: self::PRIORITY_NORMAL;



            if($this->hasAttribute('request_date')
                && empty($this->request_date))
            {
                $this->request_date=date('Y-m-d H:i:s');
            }



            if($this->hasAttribute('created_at')
                && empty($this->created_at))
            {
                $this->created_at=date('Y-m-d H:i:s');
            }

        }



        if($this->hasAttribute('updated_at'))
        {
            $this->updated_at=date('Y-m-d H:i:s');
        }


        return true;

    }





    public function getPatientName()
    {

        if($this->patient)
        {
            return trim(
                $this->patient->first_name.' '.
                $this->patient->last_name
            );
        }


        return "Unknown Patient";

    }




    public function getDoctorName()
    {

        return $this->doctor->username
            ?? 
            $this->doctor->name
            ??
            "Doctor";

    }





    public function getPriorityLabel()
    {

        return match($this->priority)
        {

            self::PRIORITY_CRITICAL=>'🔴 Critical',

            self::PRIORITY_URGENT=>'🟡 Urgent',

            default=>'🟢 Normal'

        };

    }




    public function getStatusLabel()
    {

        return match($this->status)
        {

            self::STATUS_PENDING=>'⏳ Pending',

            self::STATUS_PROCESSING=>'🧪 Processing',

            self::STATUS_COMPLETED=>'✅ Completed',

            self::STATUS_CANCELLED=>'❌ Cancelled',

            default=>$this->status

        };

    }




    public function startProcessing()
    {

        $this->status=self::STATUS_PROCESSING;

        return $this->save(false);

    }



    public function completeRequest()
    {

        $this->status=self::STATUS_COMPLETED;


        if($this->hasAttribute('completed_at'))
        {
            $this->completed_at=date('Y-m-d H:i:s');
        }


        return $this->save(false);

    }




    public function cancel()
    {

        $this->status=self::STATUS_CANCELLED;


        return $this->save(false);

    }


}