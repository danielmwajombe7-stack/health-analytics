<?php

namespace app\controllers;


use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\data\ActiveDataProvider;

use app\models\PatientVisit;



class PatientVisitsController extends Controller
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





    /**
     * Display all patient visits
     */
    public function actionIndex()
    {


        $dataProvider = new ActiveDataProvider([


            'query'=>PatientVisit::find()

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




        return $this->render('index',[


            'dataProvider'=>$dataProvider


        ]);

    }







    /**
     * Create new patient visit
     */
    public function actionCreate()
    {


        $model = new PatientVisit();



        if($model->load(Yii::$app->request->post()))

        {


            if($model->save())

            {


                Yii::$app->session->setFlash(

                    'success',

                    'Patient visit created successfully.'

                );



                return $this->redirect(['index']);

            }


        }





        return $this->render('create',[


            'model'=>$model


        ]);


    }









    /**
     * View single visit
     */
    public function actionView($id)
    {


        return $this->render('view',[


            'model'=>$this->findModel($id)


        ]);

    }









    /**
     * Update patient visit
     */
    public function actionUpdate($id)
    {


        $model=$this->findModel($id);



        if($model->load(Yii::$app->request->post()))

        {


            if($model->save())

            {


                Yii::$app->session->setFlash(

                    'success',

                    'Patient visit updated successfully.'

                );



                return $this->redirect(['index']);


            }


        }






        return $this->render('update',[


            'model'=>$model


        ]);


    }









    /**
     * Delete patient visit
     */
    public function actionDelete($id)
    {


        $model=$this->findModel($id);



        $model->delete();




        Yii::$app->session->setFlash(

            'success',

            'Patient visit deleted successfully.'

        );




        return $this->redirect(['index']);


    }









    /**
     * Find patient visit
     */
    protected function findModel($id)
    {


        $model = PatientVisit::findOne($id);



        if($model)

        {

            return $model;

        }




        throw new NotFoundHttpException(

            'Patient visit not found.'

        );


    }




}