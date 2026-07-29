<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;

use app\models\LabResult;
use app\models\LabRequest;


class LabResultController extends Controller
{


    /**
     * LIST ALL RESULTS
     */
    public function actionIndex()
    {

        $dataProvider = new ActiveDataProvider([

            'query'=>LabResult::find()
                ->joinWith([
                    'test.patient',
                    'test.doctor'
                ])
                ->orderBy([
                    'lab_results.id'=>SORT_DESC
                ]),

            'pagination'=>[
                'pageSize'=>10
            ]

        ]);



        return $this->render(
            'index',
            [
                'dataProvider'=>$dataProvider
            ]
        );

    }








    /**
     * CREATE RESULT
     */
    public function actionCreate($request_id = null)
    {

        $model = new LabResult();

        $request = null;



        /*
        AUTO CONNECT WITH LAB REQUEST
        */

        if($request_id)
        {

            $request = LabRequest::findOne($request_id);


            if($request)
            {

                /*
                LAB REQUEST -> LAB TEST
                */

                if($request->labTest)
                {

                    $model->test_id =
                        $request->labTest->id;

                }

            }

        }





        if($model->load(Yii::$app->request->post()))
        {


            /*
            CREATED BY USER
            */

            if(
                $model->hasAttribute('created_by')
            )
            {

                $model->created_by =
                    Yii::$app->user->id;

            }




            /*
            RESULT STATUS
            */

            if(
                $model->hasAttribute('status')
            )
            {

                $model->status =
                    "Completed";

            }




            if($model->save())
            {


                /*
                UPDATE LAB REQUEST
                */

                if($request)
                {


                    if(
                        $request->hasAttribute('status')
                    )
                    {

                        $request->status =
                            "Completed";

                    }



                    if(
                        $request->hasAttribute('completed_at')
                    )
                    {

                        $request->completed_at =
                            date('Y-m-d H:i:s');

                    }



                    $request->save(false);


                }




                return $this->redirect([
                    'view',
                    'id'=>$model->id
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









    /**
     * VIEW RESULT
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









    /**
     * UPDATE RESULT
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

            return $this->redirect([
                'view',
                'id'=>$model->id
            ]);

        }



        return $this->render(
            'update',
            [
                'model'=>$model
            ]
        );


    }









    /**
     * DELETE RESULT
     */
    public function actionDelete($id)
    {

        $this->findModel($id)->delete();


        return $this->redirect([
            'index'
        ]);

    }









    /**
     * FIND MODEL
     */
    protected function findModel($id)
    {


        $model = LabResult::findOne($id);



        if($model)
        {

            return $model;

        }



        throw new NotFoundHttpException(
            "Laboratory result not found"
        );


    }



}