<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\db\Exception;

use app\models\PatientQueue;
use app\models\PatientVisit;
use app\models\VitalSigns;


class NurseController extends Controller
{


    /*
    ======================================
    NURSE DASHBOARD
    ======================================
    */

    public function actionIndex()
    {


         $waitingPatients = PatientQueue::find()
    ->where([
        'status'=>[
            PatientQueue::WAITING,
            PatientQueue::CALLED
        ]
    ])
    ->count();


        $triagePatients = VitalSigns::find()
            ->where([
                'triage_status'=>'Pending'
            ])
            ->count();



        $completedTriage = VitalSigns::find()
            ->where([
                'triage_status'=>'Completed'
            ])
            ->count();



        return $this->render(
            'index',
            [

                'waitingPatients'=>$waitingPatients,

                'triagePatients'=>$triagePatients,

                'completedTriage'=>$completedTriage

            ]
        );


    }









    /*
    ======================================
    PATIENT WORKLIST
    NURSE QUEUE
    ======================================
    */


    public function actionWorklist()
    {


        $patients = PatientQueue::find()

    ->where([
        'status'=>[
            PatientQueue::WAITING,
            PatientQueue::CALLED
        ]
    ])

            ->orderBy([
                'priority'=>SORT_DESC,
                'arrival_time'=>SORT_ASC
            ])

            ->all();



        return $this->render(
            'worklist',
            [
                'patients'=>$patients
            ]
        );


    }









    /*
    ======================================
    OPEN TRIAGE FORM
    ======================================
    */


    public function actionTriage($id)
    {


        $queue = PatientQueue::findOne($id);

        if(
    !in_array(
        $queue->status,
        [
            PatientQueue::WAITING,
            PatientQueue::CALLED
        ]
    )
)
{
    throw new NotFoundHttpException(
        'Patient is not available for nurse assessment.'
    );
}

        if(!$queue)
        {

            throw new NotFoundHttpException(
                'Patient queue not found'
            );

        }



    $visit = null;


if($queue->visit_id)
{
    $visit = PatientVisit::findOne(
        $queue->visit_id
    );
}



if(!$visit)
{

    $visit = new PatientVisit();


    $visit->patient_id =
        $queue->patient_id;


    if($visit->hasAttribute('visit_number'))
    {
        $visit->visit_number =
            'VIS-'.date('YmdHis');
    }


    if($visit->hasAttribute('status'))
    {
        $visit->status =
            'Open';
    }


    if($visit->hasAttribute('created_at'))
    {
        $visit->created_at =
            date('Y-m-d H:i:s');
    }


    if(!$visit->save())
    {

        throw new Exception(
            'Unable to create patient visit'
        );

    }



    $queue->visit_id =
        $visit->id;


    $queue->save(false);

}




        $model = VitalSigns::find()
            ->where([
                'visit_id'=>$visit->id
            ])
            ->one();



        if(!$model)
        {

            $model = new VitalSigns();

            $model->visit_id =
                $visit->id;

        }




        if(
            $model->load(
                Yii::$app->request->post()
            )
        )
        {


            $transaction =
                Yii::$app->db->beginTransaction();



            try {


                $model->recorded_by =
                    Yii::$app->user->id;



                $model->triaged_by =
                    Yii::$app->user->id;



                $model->triage_status =
                    'Completed';



                if(!$model->save())
                {

                    throw new Exception(
                        'Unable to save vital signs'
                    );

                }







                /*
                Move patient to doctor queue
                */


               $queue->status =
                    PatientQueue::READY_FOR_DOCTOR;

               if($queue->hasAttribute('updated_at'))
{
    $queue->updated_at =
        date('Y-m-d H:i:s');
}

 if($queue->hasAttribute('consulted_at'))
{
    $queue->consulted_at = null;
}


                if(
                    !$queue->save()
                )
                {

                    throw new Exception(
                        'Queue update failed'
                    );

                }






                $this->createAudit(
                    'COMPLETE_TRIAGE',
                    'Completed triage for visit '.$visit->visit_number
                );





                $transaction->commit();



                Yii::$app->session->setFlash(
                    'success',
                    'Triage completed. Patient sent to doctor queue.'
                );



                return $this->redirect([
                    'worklist'
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
            'triage',
            [
                'model'=>$model,

                'queue'=>$queue,

                'visit'=>$visit

            ]
        );


    }









    /*
    ======================================
    AUDIT LOG
    ======================================
    */


    protected function createAudit(
        $action,
        $description
    )
    {


        if(
            Yii::$app->db
            ->schema
            ->getTableSchema(
                'audit_logs',
                true
            )
        )
        {


            Yii::$app->db
            ->createCommand()
            ->insert(
                'audit_logs',
                [

                    'user_id'=>Yii::$app->user->id,

                    'action'=>$action,

                    'description'=>$description,

                    'created_at'=>date(
                        'Y-m-d H:i:s'
                    )

                ]
            )
            ->execute();


        }


    }






}