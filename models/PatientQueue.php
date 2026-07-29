<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;


/**
 * Patient Queue Management
 *
 * MYLES Health Analytics System (MHAS)
 *
 * Workflow:
 *
 * Registration
 *      |
 * Reception Queue
 *      |
 * Nurse Assessment
 *      |
 * Doctor Consultation
 *      |
 * Laboratory
 *      |
 * Pharmacy
 *      |
 * Completed
 *
 */
class PatientQueue extends ActiveRecord
{


    public static function tableName()
    {
        return 'patient_queue';
    }





    /*
    |--------------------------------------------------------------------------
    | STATUS CONSTANTS
    |--------------------------------------------------------------------------
    */


    const WAITING = 'Waiting';

    const CALLED = 'Called';

    const TRIAGE = 'Nurse Assessment';

    const READY_FOR_DOCTOR = 'Ready For Doctor';

    const CONSULTING = 'Consulting';

    const LAB_PENDING = 'Lab Pending';

    const RESULT_READY = 'Result Ready';

    const PHARMACY = 'Pharmacy';

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
                ['patient_id'],
                'required'
            ],


            [
                [
                    'patient_id',
                    'visit_id',
                    'doctor_id'
                ],
                'integer'
            ],


            [
                [
                    'queue_number',
                    'department',
                    'priority',
                    'status',
                    'notes'
                ],
                'string'
            ],


            [
                [
                    'arrival_time',
                    'called_time',
                    'consulted_at',
                    'finished_time',
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


            if(!Patient::findOne($this->patient_id))
            {

                Yii::$app->session->setFlash(
                    'error',
                    'Invalid patient selected.'
                );

                return false;

            }





            $exists = self::find()

                ->where([
                    'patient_id'=>$this->patient_id
                ])

                ->andWhere([

                    'in',

                    'status',

                    [
    self::WAITING,
    self::CALLED,
    self::TRIAGE,
    self::READY_FOR_DOCTOR,
    self::CONSULTING,
    self::LAB_PENDING,
    self::RESULT_READY,
    self::PHARMACY
]

                ])

                ->exists();





            if($exists)
            {

                Yii::$app->session->setFlash(
                    'warning',
                    'Patient already has active queue.'
                );


                return false;

            }







            if(empty($this->status))
            {

                $this->status =
                    self::WAITING;

            }





            if(empty($this->priority))
            {

                $this->priority =
                    'Normal';

            }





            if(empty($this->queue_number))
            {


                $count = self::find()

                    ->where([
                        'like',
                        'queue_number',
                        'Q-'.date('Ymd')
                    ])

                    ->count();



                $this->queue_number =

                    'Q-'
                    .date('Ymd')
                    .'-'
                    .str_pad(
                        $count + 1,
                        3,
                        '0',
                        STR_PAD_LEFT
                    );

            }






            if($this->hasAttribute('arrival_time'))
            {

                $this->arrival_time =
                    date('Y-m-d H:i:s');

            }




            if($this->hasAttribute('created_at'))
            {

                $this->created_at =
                    date('Y-m-d H:i:s');

            }


        }





        if($this->hasAttribute('updated_at'))
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





    public function getDoctor()
    {

        return $this->hasOne(
            User::class,
            [
                'id'=>'doctor_id'
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






    public function getLabRequests()
    {

        return $this->hasMany(
            LabRequest::class,
            [
                'queue_id'=>'id'
            ]
        );

    }






    public function getPrescriptions()
    {

        return $this->hasMany(
            Prescription::class,
            [
                'queue_id'=>'id'
            ]
        );

    }









    /*
    |--------------------------------------------------------------------------
    | WORKFLOW
    |--------------------------------------------------------------------------
    */

 public function canMoveTo($status)
{

    $flow = [

        self::WAITING => [

            self::CALLED

        ],


        self::CALLED => [

            self::TRIAGE

        ],


        self::TRIAGE => [

            self::READY_FOR_DOCTOR

        ],


        self::READY_FOR_DOCTOR => [

            self::CONSULTING

        ],


        self::CONSULTING => [

            self::LAB_PENDING,
            self::PHARMACY,
            self::COMPLETED

        ],


        self::LAB_PENDING => [

            self::RESULT_READY

        ],


        self::RESULT_READY => [

            self::PHARMACY,
            self::COMPLETED

        ],


        self::PHARMACY => [

            self::COMPLETED

        ],


        self::COMPLETED => []

    ];


    return in_array(
        $status,
        $flow[$this->status] ?? []
    );

}
public function getStatusBadge()
{

    return match($this->status)
    {


        self::WAITING =>

        '⏳ Waiting Reception',



        self::CALLED =>

        '📢 Called',




        self::TRIAGE =>

        '🩺 Nurse Assessment',




        self::READY_FOR_DOCTOR =>

        '✅ Ready For Doctor',




        self::CONSULTING =>

        '👨‍⚕️ Consulting',




        self::LAB_PENDING =>

        '🧪 Laboratory Pending',




        self::RESULT_READY =>

        '🧾 Result Ready',




        self::PHARMACY =>

        '💊 Pharmacy',




        self::COMPLETED =>

        '✔ Completed',




        default =>

        'Unknown'

    };

}






    /*
    |--------------------------------------------------------------------------
    | QUERY HELPERS
    |--------------------------------------------------------------------------
    */


    public static function waiting()
    {

        return self::find()

            ->where([
                'status'=>self::WAITING
            ]);

    }





    public static function today()
    {

        return self::find()

            ->where([

                'between',

                'created_at',

                date('Y-m-d 00:00:00'),

                date('Y-m-d 23:59:59')

            ]);

    }





    public static function activeCount()
    {

        return self::find()

            ->where([

                'in',

                'status',

           [
self::WAITING,
self::CALLED,
self::TRIAGE,
self::READY_FOR_DOCTOR,
self::CONSULTING
]

            ])

            ->count();

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





        /*
        Patient Name Safe
        */


        $data['patient_name'] =
            'Unknown Patient';



        if($this->patient)
        {


            $data['patient_name'] =


                $this->patient->full_name

                ??

                $this->patient->first_name.' '.

                ($this->patient->last_name ?? '');

        }







        /*
        Doctor Name Safe
        */


        $data['doctor_name'] =
            'Not Assigned';



        if($this->doctor)
        {


            $data['doctor_name'] =


                $this->doctor->full_name

                ??

                $this->doctor->username

                ??

                'Not Assigned';


        }







        $data['status_label'] =

            $this->statusBadge;





        return $data;


    }



}