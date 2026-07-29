<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;


class LabTest extends ActiveRecord
{


    /**
     * TABLE
     */
    public static function tableName()
    {
        return 'lab_tests';
    }



    /**
     * RULES
     */
    public function rules()
    {
        return [

            [
                [
                    'visit_id',
                    'patient_id',
                    'requested_by',
                    'test_name'
                ],
                'required'
            ],


            [
                [
                    'visit_id',
                    'patient_id',
                    'requested_by',
                    'performed_by'
                ],
                'integer'
            ],


            [
                [
                    'test_name',
                    'priority',
                    'doctor_note',
                    'status'
                ],
                'string'
            ],


            [
                [
                    'request_date',
                    'completed_date'
                ],
                'safe'
            ]

        ];
    }





    /**
     * BEFORE SAVE
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
                $this->status = 'Pending';
            }


            if(empty($this->priority))
            {
                $this->priority = 'Normal';
            }


            if(empty($this->request_date))
            {
                $this->request_date = date('Y-m-d H:i:s');
            }

        }



        if(
            $this->status == 'Completed'
            &&
            $this->hasAttribute('completed_date')
        )
        {

            if(empty($this->completed_date))
            {
                $this->completed_date = date('Y-m-d H:i:s');
            }

        }


        return true;

    }







    /**
     * RELATIONS
     */



    // Patient
    public function getPatient()
    {

        return $this->hasOne(
            Patient::class,
            ['id'=>'patient_id']
        );

    }




    // Visit
    public function getVisit()
    {

        return $this->hasOne(
            PatientVisit::class,
            ['id'=>'visit_id']
        );

    }





    // Doctor who requested test
    public function getDoctor()
    {

        return $this->hasOne(
            User::class,
            ['id'=>'requested_by']
        );

    }

public function getLabRequest()
{
    return $this->hasOne(
        LabRequest::class,
        ['id'=>'request_id']
    );
}



    // Lab technician
    public function getTechnician()
    {

        return $this->hasOne(
            User::class,
            ['id'=>'performed_by']
        );

    }





    // Single latest result
    public function getResult()
    {

        return $this->hasOne(
            LabResult::class,
            ['test_id'=>'id']
        )
        ->orderBy([
            'id'=>SORT_DESC
        ]);

    }





    // All results
    public function getResults()
    {

        return $this->hasMany(
            LabResult::class,
            ['test_id'=>'id']
        )
        ->orderBy([
            'id'=>SORT_DESC
        ]);

    }







    /**
     * DISPLAY HELPERS
     */



    public function getPatientName()
    {

        if($this->patient)
        {

            return trim(
                ($this->patient->first_name ?? '')
                .' '.
                ($this->patient->last_name ?? '')
            );

        }


        return 'Unknown Patient';

    }







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


        return 'Not Assigned';

    }








    /**
     * STATUS
     */


    public function getStatusLabel()
    {

        return match($this->status)
        {

            'Pending' =>
            '⏳ Pending',


            'Processing' =>
            '🧪 Processing',


            'Completed' =>
            '✅ Completed',


            default =>
            $this->status

        };

    }







    /**
     * PRIORITY
     */


    public function getPriorityLabel()
    {

        return match($this->priority)
        {

            'High' =>
            '🔴 High',


            'Medium' =>
            '🟡 Medium',


            default =>
            '🟢 Normal'

        };

    }








    public function getStatusClass()
    {

        return match($this->status)
        {

            'Pending' =>
            'pending',


            'Processing' =>
            'processing',


            'Completed' =>
            'completed',


            default =>
            'normal'

        };

    }








    /**
     * WORKFLOW
     */


    public function startProcessing()
    {

        $this->status='Processing';

        return $this->save(false);

    }





    public function completeTest()
    {

        $this->status='Completed';


        if($this->hasAttribute('completed_date'))
        {
            $this->completed_date=date('Y-m-d H:i:s');
        }


        return $this->save(false);

    }





    public function hasResult()
    {

        return $this->result !== null;

    }







    /**
     * API OUTPUT
     */


    public function toArray(
        array $fields=[],
        array $expand=[],
        $recursive=true
    )
    {

        $data = parent::toArray(
            $fields,
            $expand,
            $recursive
        );


        $data['patient_name']=$this->patientName;

        $data['doctor_name']=$this->doctorName;

        $data['technician_name']=$this->technicianName;

        $data['status_label']=$this->statusLabel;

        $data['priority_label']=$this->priorityLabel;

        $data['has_result']=$this->hasResult();


        return $data;

    }


}