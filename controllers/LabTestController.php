<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;

use app\models\LabTest;


class LabTestController extends Controller
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
    Doctor Requests Laboratory Test
    */

    public function actionCreate($visit_id,$patient_id)
    {


        $model=new LabTest();


        $model->visit_id=$visit_id;

        $model->patient_id=$patient_id;

        $model->requested_by=Yii::$app->user->id;

        $model->status="Pending";



        if($model->load(Yii::$app->request->post()))
        {


            if($model->save())
            {


                Yii::$app->session->setFlash(
                    'success',
                    'Laboratory test requested successfully.'
                );


                return $this->redirect([
                    '/doctor/dashboard'
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
    Doctor View Result
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
    All Tests
    */

    public function actionIndex()
    {


        $tests=LabTest::find()

        ->with([
            'patient',
            'doctor',
            'result'
        ])

        ->orderBy([
            'id'=>SORT_DESC
        ])

        ->all();



        return $this->render(
            'index',
            [
                'tests'=>$tests
            ]
        );


    }








    protected function findModel($id)
    {


        $model=LabTest::findOne($id);



        if($model)
        {
            return $model;
        }



        throw new NotFoundHttpException(
            'Laboratory test not found'
        );


    }



}