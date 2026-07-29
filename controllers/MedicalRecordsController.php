<?php

namespace app\controllers;


use Yii;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;


use app\models\MedicalRecords;
use app\models\PatientQueue;
use app\models\LabRequest;
use app\models\Prescription;
use app\models\PatientVisit;



class MedicalRecordsController extends Controller
{


    public function behaviors()
    {

        return [

            'access'=>[

                'class'=>AccessControl::class,

                'rules'=>[

                    [

                        'allow'=>true,

                        'roles'=>['@']

                    ]

                ]

            ],


            'verbs'=>[

                'class'=>VerbFilter::class,

                'actions'=>[

                    'delete'=>['POST']

                ]

            ]

        ];

    }






    /*
    DOCTOR MEDICAL RECORD DASHBOARD
    */


    public function actionIndex()
    {


        $dataProvider=new ActiveDataProvider([


            'query'=>MedicalRecords::find()

                ->with([

                    'patient',
                    'doctor'

                ])

                ->orderBy([

                    'id'=>SORT_DESC

                ]),


            'pagination'=>[

                'pageSize'=>20

            ]

        ]);





        return $this->render(

            'index',

            [

                'dataProvider'=>$dataProvider

            ]

        );


    }







    /*
    CREATE CONSULTATION
    */


    public function actionCreate($patient_id=null)
    {


        $model=new MedicalRecords();



        if($patient_id)
        {

            $model->patient_id=$patient_id;

        }






        if($model->load(Yii::$app->request->post()))
        {


            $transaction=
            Yii::$app->db->beginTransaction();



            try
            {


                /*
                FIND ACTIVE QUEUE
                */


                $queue=PatientQueue::find()

                ->where([

                    'patient_id'=>$model->patient_id,

                    'status'=>'Consulting'

                ])

                ->orderBy([

                    'id'=>SORT_DESC

                ])

                ->one();






                if(!$queue)
                {


                    throw new \Exception(

                        "Patient is not in doctor consultation queue."

                    );


                }







                /*
                ASSIGN DOCTOR
                */


                $model->doctor_id=
                    Yii::$app->user->id;



                if($model->hasAttribute('queue_id'))
                {

                    $model->queue_id=
                        $queue->id;

                }






                /*
                AUTO SAVE CONSULTATION TIME
                */


                if($model->hasAttribute('created_at'))
                {

                    $model->created_at=
                    date('Y-m-d H:i:s');

                }







                /*
                SAVE MEDICAL RECORD
                */


                if(!$model->save())
                {


                    throw new \Exception(

                        json_encode($model->errors)

                    );


                }






                /*
                UPDATE QUEUE
                */


                if($queue->hasAttribute('consulted_at'))
                {

                    $queue->consulted_at=
                    date('Y-m-d H:i:s');

                }


                $queue->save(false);







                $transaction->commit();





                Yii::$app->session->setFlash(

                    'success',

                    'Medical consultation saved successfully.'

                );





                return $this->redirect([

                    'view',

                    'id'=>$model->id

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

            'create',

            [

                'model'=>$model

            ]

        );


    }
    /*
    SEND PATIENT TO LABORATORY
    */


    public function actionSendLab($id)
    {


        $record=$this->findModel($id);




        $transaction =
        Yii::$app->db->beginTransaction();



        try
        {



            $lab=new LabRequest();



            $lab->patient_id=
                $record->patient_id;




            $lab->doctor_id=
                Yii::$app->user->id;





            if($lab->hasAttribute('queue_id'))
            {

                $lab->queue_id=
                    $record->queue_id;

            }





            if($lab->hasAttribute('test_name'))
            {

                $lab->test_name=
                "General Laboratory Investigation";

            }





            if($lab->hasAttribute('status'))
            {

                $lab->status=
                    "Pending";

            }





            if($lab->hasAttribute('request_date'))
            {

                $lab->request_date=
                date('Y-m-d H:i:s');

            }





            if(!$lab->save())
            {


                throw new \Exception(

                    json_encode($lab->errors)

                );


            }







            $transaction->commit();





            Yii::$app->session->setFlash(

                'success',

                'Patient successfully sent to laboratory.'

            );



        }
        catch(\Exception $e)
        {


            $transaction->rollBack();



            Yii::$app->session->setFlash(

                'error',

                $e->getMessage()

            );


        }






        return $this->redirect([

            'view',

            'id'=>$id

        ]);



    }












    /*
    CREATE PRESCRIPTION
    */


    public function actionPrescription($id)
    {


        $record=$this->findModel($id);




        $model=new Prescription();





        $model->patient_id=
            $record->patient_id;



        $model->doctor_id=
            Yii::$app->user->id;






        if($model->load(Yii::$app->request->post()))
        {



            if($model->save())
            {


                Yii::$app->session->setFlash(

                    'success',

                    'Prescription created successfully.'

                );



                return $this->redirect([

                    'view',

                    'id'=>$id

                ]);



            }



        }








        return $this->render(

            'prescription',

            [

                'model'=>$model,

                'record'=>$record

            ]

        );



    }













    /*
    COMPLETE CONSULTATION
    */


    public function actionComplete($id)
    {


        $record=
        $this->findModel($id);





        $queue=
        PatientQueue::findOne(
            $record->queue_id
        );







        if($queue)
        {



            if($queue->hasAttribute('status'))
            {

                $queue->status=
                    "Completed";

            }





            if($queue->hasAttribute('finished_time'))
            {

                $queue->finished_time=
                date('Y-m-d H:i:s');

            }







            if($queue->hasAttribute('notes'))
            {

                $queue->notes=
                "Doctor consultation completed";

            }






            $queue->save(false);


        }








        Yii::$app->session->setFlash(

            'success',

            'Consultation completed successfully.'

        );







        return $this->redirect([

            'view',

            'id'=>$id

        ]);



    }












    /*
    VIEW MEDICAL RECORD
    */


    public function actionView($id)
    {



        $model=$this->findModel($id);





        return $this->render(

            'view',

            [

                'model'=>$model

            ]

        );


    }












    /*
    UPDATE MEDICAL RECORD
    */


    public function actionUpdate($id)
    {


        $model=
        $this->findModel($id);






        if(
            $model->load(Yii::$app->request->post())
            &&
            $model->save()
        )
        {


            Yii::$app->session->setFlash(

                'success',

                'Medical record updated.'

            );



            return $this->redirect([

                'view',

                'id'=>$id

            ]);

        }






        return $this->render(

            'update',

            [

                'model'=>$model

            ]

        );


    }













    /*
    DELETE RECORD
    */


    public function actionDelete($id)
    {


        $this->findModel($id)->delete();





        Yii::$app->session->setFlash(

            'success',

            'Medical record deleted.'

        );




        return $this->redirect([

            'index'

        ]);



    }













    /*
    FIND MEDICAL RECORD
    */


    protected function findModel($id)
    {



        $model=
        MedicalRecords::find()

        ->with([

            'patient',

            'doctor'

        ])

        ->where([

            'id'=>$id

        ])

        ->one();






        if($model)
        {

            return $model;

        }







        throw new NotFoundHttpException(

            'Medical record not found.'

        );


    }


}
