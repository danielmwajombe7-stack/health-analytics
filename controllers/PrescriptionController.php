<?php

namespace app\controllers;


use Yii;

use yii\web\Controller;
use yii\web\NotFoundHttpException;

use yii\filters\AccessControl;

use yii\data\ActiveDataProvider;

use yii\db\Exception;


use app\models\Prescription;
use app\models\PatientVisit;



class PrescriptionController extends Controller
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

            ]

        ];

    }






    /*
    |--------------------------------------------------------------------------
    | INDEX
    |--------------------------------------------------------------------------
    */

    public function actionIndex()
    {


        $dataProvider = new ActiveDataProvider([


            'query'=>Prescription::find()

            ->with([

                'patient',
                'doctor',
                'visit',
                'medicine'

            ])

            ->orderBy([

                'id'=>SORT_DESC

            ]),



            'pagination'=>[

                'pageSize'=>20

            ]


        ]);





        /*
        REAL DATABASE STATISTICS
        */


        $total = Prescription::find()
        ->count();




        $waiting = Prescription::find()

        ->where([

            'status'=>[
                Prescription::STATUS_ACTIVE,
                Prescription::STATUS_PENDING
            ]

        ])

        ->count();






        $dispensed = Prescription::find()

        ->where([

            'status'=>Prescription::STATUS_DISPENSED

        ])

        ->count();






        $cancelled = Prescription::find()

        ->where([

            'status'=>Prescription::STATUS_CANCELLED

        ])

        ->count();







        return $this->render(
            'index',
            [

                'dataProvider'=>$dataProvider,

                'total'=>$total,

                'waiting'=>$waiting,

                'dispensed'=>$dispensed,

                'cancelled'=>$cancelled

            ]
        );


    }










    /*
    |--------------------------------------------------------------------------
    | CREATE PRESCRIPTION
    |--------------------------------------------------------------------------
    */


    public function actionCreate($patient_id=null,$visit_id=null)
    {


        $model = new Prescription();





        if($visit_id)
        {


            $visit =
            PatientVisit::findOne($visit_id);



            if($visit)
            {

                $model->visit_id =
                $visit->id;


                $model->patient_id =
                $visit->patient_id;


            }


        }





        if($patient_id && empty($model->patient_id))
        {

            $model->patient_id =
            $patient_id;


        }





        if($model->load(Yii::$app->request->post()))
        {


            if(empty($model->doctor_id))
            {

                $model->doctor_id =
                Yii::$app->user->id;

            }



            if(empty($model->status))
            {

                $model->status =
                Prescription::STATUS_ACTIVE;

            }






            if($model->save())
            {


                Yii::$app->session->setFlash(

                    'success',

                    'Prescription sent to pharmacy.'

                );



                return $this->redirect([

                    'index'

                ]);


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
    |--------------------------------------------------------------------------
    | VIEW
    |--------------------------------------------------------------------------
    */


    public function actionView($id)
    {

        return $this->render(

            'view',

            [

                'model'=>$this->findModel($id)

            ]

        );

    }












    /*
    |--------------------------------------------------------------------------
    | UPDATE
    |--------------------------------------------------------------------------
    */


    public function actionUpdate($id)
    {


        $model =
        $this->findModel($id);



        if($model->status ==
        Prescription::STATUS_DISPENSED)
        {


            Yii::$app->session->setFlash(

                'warning',

                'Dispensed medicine cannot be edited.'

            );


            return $this->redirect([
                'index'
            ]);

        }







        if(
            $model->load(Yii::$app->request->post())
            &&
            $model->save()
        )
        {


            Yii::$app->session->setFlash(

                'success',

                'Prescription updated.'

            );



            return $this->redirect([

                'index'

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
    |--------------------------------------------------------------------------
    | DISPENSE MEDICINE
    |--------------------------------------------------------------------------
    */


    public function actionDispense($id)
    {


        $model =
        $this->findModel($id);




        if($model->status ==
        Prescription::STATUS_DISPENSED)
        {


            Yii::$app->session->setFlash(

                'warning',

                'Medicine already dispensed.'

            );


            return $this->redirect([
                'index'
            ]);


        }





        if($model->status ==
        Prescription::STATUS_CANCELLED)
        {


            Yii::$app->session->setFlash(

                'error',

                'Cancelled prescription cannot be dispensed.'

            );


            return $this->redirect([
                'index'
            ]);

        }







        $transaction =
        Yii::$app->db->beginTransaction();



        try{


            $model->status =
            Prescription::STATUS_DISPENSED;



            $model->dispensed_at =
            date('Y-m-d H:i:s');





            if($model->save(false))
            {


                $transaction->commit();



                Yii::$app->session->setFlash(

                    'success',

                    '💊 Medicine dispensed successfully.'

                );


            }


        }

        catch(Exception $e)
        {


            $transaction->rollBack();


            Yii::$app->session->setFlash(

                'error',

                $e->getMessage()

            );


        }






        return $this->redirect([

            'index'

        ]);


    }












    /*
    |--------------------------------------------------------------------------
    | CANCEL
    |--------------------------------------------------------------------------
    */


    public function actionCancel($id)
    {


        $model =
        $this->findModel($id);



        if($model->status ==
        Prescription::STATUS_DISPENSED)
        {


            Yii::$app->session->setFlash(

                'error',

                'Dispensed medicine cannot be cancelled.'

            );


        }

        else{


            $model->status =
            Prescription::STATUS_CANCELLED;


            $model->save(false);



            Yii::$app->session->setFlash(

                'success',

                'Prescription cancelled.'

            );


        }




        return $this->redirect([

            'index'

        ]);

    }












    /*
    |--------------------------------------------------------------------------
    | DELETE
    |--------------------------------------------------------------------------
    */


    public function actionDelete($id)
    {


        $model =
        $this->findModel($id);



        if($model->status ==
        Prescription::STATUS_DISPENSED)
        {


            Yii::$app->session->setFlash(

                'error',

                'Dispensed medicine cannot be deleted.'

            );


            return $this->redirect([
                'index'
            ]);

        }




        $model->delete();



        return $this->redirect([

            'index'

        ]);

    }












    /*
    |--------------------------------------------------------------------------
    | FIND MODEL
    |--------------------------------------------------------------------------
    */


    protected function findModel($id)
    {


        $model =
        Prescription::find()

        ->with([

            'patient',
            'doctor',
            'visit',
            'medicine'

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

            'Prescription not found.'

        );


    }



}