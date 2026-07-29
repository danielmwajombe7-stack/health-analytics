<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;


class LabResult extends ActiveRecord
{

    /*
    |--------------------------------------------------------------------------
    | TABLE
    |--------------------------------------------------------------------------
    */

    public static function tableName()
    {
        return 'lab_results';
    }




    /*
    |--------------------------------------------------------------------------
    | STATUS
    |--------------------------------------------------------------------------
    */

    const STATUS_PENDING   = 'Pending';
    const STATUS_COMPLETED = 'Completed';
    const STATUS_VERIFIED  = 'Verified';





    /*
    |--------------------------------------------------------------------------
    | UPLOAD
    |--------------------------------------------------------------------------
    */

    public $resultFile;





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
                    'test_id',
                    'result',
                    'created_by'
                ],
                'required'
            ],



            [
                [
                    'test_id',
                    'created_by',
                    'verified_by'
                ],
                'integer'
            ],



            [
                [
                    'result',
                    'findings'
                ],
                'string'
            ],



            [
                [
                    'normal_range',
                    'attachment',
                    'status'
                ],
                'string',
                'max'=>255
            ],



            [
                [
                    'created_at',
                    'updated_at'
                ],
                'safe'
            ],




            [
                'status',
                'in',
                'range'=>[
                    self::STATUS_PENDING,
                    self::STATUS_COMPLETED,
                    self::STATUS_VERIFIED
                ]
            ],




            [
                'status',
                'default',
                'value'=>self::STATUS_COMPLETED
            ],




            [
                'resultFile',
                'file',
                'skipOnEmpty'=>true,
                'extensions'=>[
                    'pdf',
                    'jpg',
                    'jpeg',
                    'png',
                    'doc',
                    'docx'
                ],
                'maxSize'=>10 * 1024 * 1024
            ]

        ];

    }







    /*
    |--------------------------------------------------------------------------
    | LABELS
    |--------------------------------------------------------------------------
    */


    public function attributeLabels()
    {

        return [

            'test_id'=>'Laboratory Test',

            'result'=>'Result',

            'findings'=>'Clinical Findings',

            'normal_range'=>'Normal Range',

            'attachment'=>'Attachment',

            'created_by'=>'Technician',

            'verified_by'=>'Verified By',

            'status'=>'Status',

            'created_at'=>'Created',

            'updated_at'=>'Updated'

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

            if(empty($this->status))
            {
                $this->status =
                    self::STATUS_COMPLETED;
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



    // Lab Test
    public function getTest()
    {

        return $this->hasOne(
            LabTest::class,
            [
                'id'=>'test_id'
            ]
        );

    }







    // Lab Request kupitia LabTest
    public function getLabRequest()
    {

        return $this->hasOne(
            LabRequest::class,
            [
                'id'=>'request_id'
            ]
        )
        ->via('test');

    }








    // Patient kupitia LabRequest
    public function getPatient()
    {

        return $this->hasOne(
            Patient::class,
            [
                'id'=>'patient_id'
            ]
        )
        ->via('labRequest');

    }








    // Technician
    public function getTechnician()
    {

        return $this->hasOne(
            User::class,
            [
                'id'=>'created_by'
            ]
        );

    }








    // Doctor aliyethibitisha
    public function getVerifiedBy()
    {

        return $this->hasOne(
            User::class,
            [
                'id'=>'verified_by'
            ]
        );

    }









    /*
    |--------------------------------------------------------------------------
    | DISPLAY HELPERS
    |--------------------------------------------------------------------------
    */


    public function getTestName()
    {

        return $this->test->test_name
            ??
            'Unknown Test';

    }







    public function getPatientName()
    {

        if($this->patient)
        {

            return trim(

                ($this->patient->first_name ?? '')
                .
                ' '
                .
                ($this->patient->last_name ?? '')

            );

        }


        return 'Unknown Patient';

    }








    public function getTechnicianName()
    {

        if($this->technician)
        {

            return

                $this->technician->username
                ??
                $this->technician->name
                ??
                'Technician';

        }


        return 'Unknown Technician';

    }








    public function getVerifiedDoctorName()
    {

        if($this->verifiedBy)
        {

            return

                $this->verifiedBy->username
                ??
                $this->verifiedBy->name
                ??
                'Doctor';

        }


        return 'Not Verified';

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

            self::STATUS_PENDING =>
                '🟡 Pending',


            self::STATUS_COMPLETED =>
                '🧪 Completed',


            self::STATUS_VERIFIED =>
                '✅ Verified',


            default =>
                $this->status

        };

    }









    /*
    |--------------------------------------------------------------------------
    | VERIFY RESULT
    |--------------------------------------------------------------------------
    */


    public function verify()
    {

        $this->status =
            self::STATUS_VERIFIED;



        if($this->hasAttribute('verified_by'))
        {

            $this->verified_by =
                Yii::$app->user->id;

        }



        if($this->hasAttribute('updated_at'))
        {

            $this->updated_at =
                date('Y-m-d H:i:s');

        }



        return $this->save(false);

    }









    /*
    |--------------------------------------------------------------------------
    | FILE UPLOAD
    |--------------------------------------------------------------------------
    */


    public function uploadAttachment()
    {

        $this->resultFile =
            UploadedFile::getInstance(
                $this,
                'resultFile'
            );



        if(!$this->resultFile)
        {
            return true;
        }




        $folder =
            Yii::getAlias(
                '@webroot/uploads/lab-results/'
            );



        if(!is_dir($folder))
        {
            mkdir(
                $folder,
                0777,
                true
            );
        }




        $filename =
            uniqid('lab_')
            .
            '.'
            .
            $this->resultFile->extension;




        if(
            $this->resultFile->saveAs(
                $folder.$filename
            )
        )
        {

            $this->attachment =
                $filename;


            return true;

        }



        return false;

    }









    /*
    |--------------------------------------------------------------------------
    | API OUTPUT
    |--------------------------------------------------------------------------
    */


    public function fields()
    {

        return array_merge(
            parent::fields(),
            [

                'test_name'=>
                    fn()=> $this->testName,


                'patient_name'=>
                    fn()=> $this->patientName,


                'technician_name'=>
                    fn()=> $this->technicianName,


                'verified_by_name'=>
                    fn()=> $this->verifiedDoctorName,


                'status_label'=>
                    fn()=> $this->statusLabel

            ]
        );

    }


}