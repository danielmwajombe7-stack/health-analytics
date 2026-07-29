<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\db\Exception;
use yii\web\NotFoundHttpException;

use app\models\Patient;
use app\models\PatientVisit;
use app\models\PatientQueue;


class ReceptionController extends Controller
{


    /*
    =====================================
    RECEPTION DASHBOARD
    =====================================
    */

    public function actionIndex()
    {

        $todayPatients = PatientVisit::find()
            ->where([
                'DATE(visit_date)' => date('Y-m-d')
            ])
            ->count();


        $waitingPatients = PatientQueue::find()
            ->where([
                'status'=>'Waiting'
            ])
            ->count();


        $consultingPatients = PatientQueue::find()
            ->where([
                'status'=>'Consulting'
            ])
            ->count();



        return $this->render(
            'index',
            [

                'todayPatients'=>$todayPatients,

                'waitingPatients'=>$waitingPatients,

                'consultingPatients'=>$consultingPatients

            ]
        );

    }






    /*
    =====================================
    REGISTER PATIENT
    PATIENT + VISIT + QUEUE + AUDIT
    TRANSACTION BASED
    =====================================
    */


    public function actionRegister()
    {


        $model = new Patient();



        if(
            $model->load(Yii::$app->request->post())
        )
        {


            /*
            ==========================
            DUPLICATE DETECTION
            ==========================
            */


            $duplicate = Patient::find()
                ->where([

                    'phone'=>$model->phone

                ])
                ->orWhere([

                    'and',

                    [
                        'first_name'=>$model->first_name
                    ],

                    [
                        'last_name'=>$model->last_name
                    ],

                    [
                        'date_of_birth'=>$model->date_of_birth
                    ]

                ])
                ->one();



            if($duplicate)
            {


                Yii::$app->session->setFlash(
                    'warning',
                    'Patient already exists. Patient Number: '
                    .$duplicate->patient_number
                );


                return $this->redirect([
                    'patients/view',
                    'id'=>$duplicate->id
                ]);


            }







            $transaction =
                Yii::$app->db->beginTransaction();



            try {


                /*
                ==========================
                GENERATE PATIENT NUMBER
                ==========================
                */


                $lastId = Patient::find()
                    ->max('id');


                $patientNumber =
                    'MH-PAT-'
                    .date('Y')
                    .'-'
                    .str_pad(
                        ($lastId+1),
                        6,
                        '0',
                        STR_PAD_LEFT
                    );



                $model->patient_number =
                    $patientNumber;





                /*
                ==========================
                PATIENT CATEGORY
                ==========================
                */


                if($model->hasAttribute('patient_category'))
{

    if(empty($model->patient_category))
    {
        $model->patient_category = 'New Patient';
    }

}



                if(
                    $model->hasAttribute('status')
                    &&
                    empty($model->status)
                )
                {

                    $model->status='Active';

                }





                if(
                    $model->hasAttribute('created_by')
                )
                {

                    $model->created_by =
                        Yii::$app->user->id;

                }





                if(!$model->save())
                {

                    throw new Exception(
                        'Patient registration failed'
                    );

                }


/*
==========================
AUTO PATIENT CATEGORY
==========================
*/


if($model->patient_type == 'Emergency')
{

    $model->patient_category =
        'Emergency Patient';

}
elseif($model->registration_source == 'Appointment')
{

    $model->patient_category =
        'Returning Patient';

}
else
{

    $model->patient_category =
        'New Patient';

}


                /*
                ==========================
                CREATE VISIT
                ==========================
                */


                $visit = new PatientVisit();


                $visit->patient_id =
                    $model->id;


                $visit->visit_number =
                    'VIS-'
                    .date('Ymd')
                    .'-'
                    .str_pad(
                        $model->id,
                        5,
                        '0',
                        STR_PAD_LEFT
                    );



                $visit->visit_date =
                    date('Y-m-d H:i:s');



                if($visit->hasAttribute('visit_type'))
                {

                    $visit->visit_type =
                        'OPD';

                }



                $visit->status =
                    'Waiting';




                if(!$visit->save())
                {

                    throw new Exception(
                        'Visit creation failed'
                    );

                }




/*
==========================
CREATE QUEUE TOKEN
==========================
*/


$lastQueue = PatientQueue::find()
    ->where([
        'between',
        'created_at',
        date('Y-m-d 00:00:00'),
        date('Y-m-d 23:59:59')
    ])
    ->orderBy([
        'id' => SORT_DESC
    ])
    ->one();


$nextNumber = 1;


if ($lastQueue) {

    $parts = explode('-', $lastQueue->queue_number);

    $nextNumber = ((int) end($parts)) + 1;

}


$queue = new PatientQueue();


$queue->patient_id = $model->id;


$queue->visit_id = $visit->id;


$queue->queue_number =
    'MHAS-'
    .date('Ymd')
    .'-'
    .str_pad(
        $nextNumber,
        3,
        '0',
        STR_PAD_LEFT
    );



if ($queue->hasAttribute('department')) {

    $queue->department = 'General OPD';

}


if ($queue->hasAttribute('priority')) {

    $queue->priority = 'Normal';

}


$queue->status = 'Waiting';


if ($queue->hasAttribute('arrival_time')) {

    $queue->arrival_time = date('Y-m-d H:i:s');

}


if (!$queue->save()) {

    throw new Exception(
        implode('<br>', $queue->getFirstErrors())
    );

}






                /*
                ==========================
                AUDIT LOG
                ==========================
                */


                $this->createAudit(
                    'REGISTER_PATIENT',
                    'Registered patient '.$model->patient_number
                );







                $transaction->commit();





                Yii::$app->session->setFlash(
                    'success',
                    'Patient registered successfully and added to queue.'
                );



                return $this->redirect([
                    'queue'
                ]);



            }
            catch(\Exception $e)
            {


                $transaction->rollBack();



                Yii::$app->session->setFlash(
                    'error',
                    $e->getMessage()
                );


            }



        }





        return $this->render(
            'register',
            [
                'model'=>$model
            ]
        );


    }








    /*
    =====================================
    AUDIT FUNCTION
    =====================================
    */


    protected function createAudit($action,$description)
    {


        if(
            Yii::$app->db
            ->schema
            ->getTableSchema('audit_logs',true)
        )
        {


            Yii::$app->db->createCommand()
            ->insert(
                'audit_logs',
                [

                    'user_id'=>Yii::$app->user->id,

                    'action'=>$action,

                    'description'=>$description,

                    'created_at'=>date('Y-m-d H:i:s')

                ]

            )
            ->execute();


        }


    }








    /*
    =====================================
    DOCTOR WAITING QUEUE
    =====================================
    */


    public function actionQueue()
    {


        $queue = PatientQueue::find()

            ->where([
                'status'=>'Waiting'
            ])

            ->orderBy([
                'id'=>SORT_ASC
            ])

            ->all();



        return $this->render(
            'queue',
            [
                'queue'=>$queue
            ]
        );


    }




}