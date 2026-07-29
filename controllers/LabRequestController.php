<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\data\ActiveDataProvider;

use app\models\LabRequest;
use app\models\LabResult;


class LabRequestController extends Controller
{


    /**
     * LAB REQUEST LIST
     */
    public function actionIndex()
    {

        $dataProvider = new ActiveDataProvider([

            'query'=>LabRequest::find()
                ->with([
                    'patient',
                    'doctor',
                    'labTests',
                    'labResults'
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
     * VIEW SINGLE REQUEST
     */
    public function actionView($id)
    {

        return $this->render('view',[

            'model'=>$this->findModel($id)

        ]);

    }







    /**
     * CREATE LAB REQUEST
     */
    public function actionCreate($patient_id=null)
    {


        $model = new LabRequest();



        if(!Yii::$app->user->isGuest)
        {

            $model->doctor_id =
                Yii::$app->user->id;

        }




        if($patient_id)
        {

            $model->patient_id =
                $patient_id;

        }





        if($model->load(Yii::$app->request->post()))
        {


            $model->status =
                LabRequest::STATUS_PENDING;



            if(empty($model->priority))
            {

                $model->priority =
                    LabRequest::PRIORITY_NORMAL;

            }




            if($model->save())
            {


                Yii::$app->session->setFlash(
                    'success',
                    'Laboratory request created successfully'
                );


                return $this->redirect([
                    'view',
                    'id'=>$model->id
                ]);


            }



            Yii::$app->session->setFlash(
                'error',
                json_encode($model->errors)
            );

        }




        return $this->render('create',[

            'model'=>$model

        ]);

    }








    /**
     * UPDATE REQUEST
     */
    public function actionUpdate($id)
    {

        $model=$this->findModel($id);



        if(
            $model->load(Yii::$app->request->post())
            &&
            $model->save()
        )
        {

            Yii::$app->session->setFlash(
                'success',
                'Laboratory request updated'
            );


            return $this->redirect([
                'view',
                'id'=>$model->id
            ]);

        }



        return $this->render('update',[

            'model'=>$model

        ]);

    }








    /**
     * START LAB PROCESS
     */
    public function actionProcess($id)
    {

        $model=$this->findModel($id);


        $model->status =
            LabRequest::STATUS_PROCESSING;


        $model->save(false);



        return $this->redirect([
            'index'
        ]);

    }








    /**
     * COMPLETE LAB REQUEST
     */
    public function actionComplete($id)
    {

        $model=$this->findModel($id);



        $model->status =
            LabRequest::STATUS_COMPLETED;



        if($model->hasAttribute('completed_at'))
        {

            $model->completed_at =
                date('Y-m-d H:i:s');

        }



        $model->save(false);



        return $this->redirect([
            'index'
        ]);

    }








    /**
     * ALL LAB RESULTS PAGE
     */
    public function actionResults()
    {


        $dataProvider = new ActiveDataProvider([


            'query'=>LabResult::find()
                ->with([
                    'labRequest'
                ])
                ->orderBy([
                    'id'=>SORT_DESC
                ]),



            'pagination'=>[

                'pageSize'=>20

            ]

        ]);




        return $this->render('results',[

            'dataProvider'=>$dataProvider

        ]);


    }








    /**
     * DELETE
     */
    public function actionDelete($id)
    {


        $model=$this->findModel($id);



        $model->delete();



        Yii::$app->session->setFlash(
            'success',
            'Laboratory request deleted'
        );



        return $this->redirect([
            'index'
        ]);

    }








    /**
     * FIND MODEL
     */
    protected function findModel($id)
    {


        $model = LabRequest::findOne($id);



        if($model)
        {

            return $model;

        }



        throw new NotFoundHttpException(
            'Laboratory request not found'
        );

    }


}