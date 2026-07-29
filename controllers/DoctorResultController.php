<?php

namespace app\controllers;


use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\data\ActiveDataProvider;


use app\models\LabResult;
use app\models\LabTest;



class DoctorResultController extends Controller
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
    | SHOW ALL RESULTS
    |--------------------------------------------------------------------------
    */

    public function actionIndex()
    {


        $results = new ActiveDataProvider([


            'query'=>LabResult::find()

                ->with([

                    'labTest'

                ])

                ->orderBy([

                    'id'=>SORT_DESC

                ])


        ]);





        return $this->render(
            'index',
            [

                'results'=>$results

            ]
        );


    }









    /*
    |--------------------------------------------------------------------------
    | VIEW SINGLE RESULT
    |--------------------------------------------------------------------------
    */

    public function actionView($id)
    {


        $model = LabResult::findOne($id);



        if(!$model)
        {

            throw new NotFoundHttpException(
                'Laboratory result not found'
            );

        }





        return $this->render(
            'view',
            [

                'model'=>$model

            ]
        );


    }









    /*
    |--------------------------------------------------------------------------
    | CREATE RESULT
    |--------------------------------------------------------------------------
    */

    public function actionCreate($test_id)
    {


        $model=new LabResult();



        $model->test_id=$test_id;


        $model->created_by=Yii::$app->user->id;





        if($model->load(Yii::$app->request->post()))
        {


            if($model->save())
            {


                $test=LabTest::findOne($test_id);



                if($test)
                {

                    $test->status='Completed';

                    $test->performed_by=
                    Yii::$app->user->id;

                    $test->save(false);

                }






                Yii::$app->session->setFlash(
                    'success',
                    'Laboratory result saved successfully'
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





}