<?php

namespace app\controllers;


use Yii;
use yii\web\Controller;
use yii\data\ActiveDataProvider;

use app\models\PatientQueue;



class QueueController extends Controller
{


    public function actionIndex()
    {


        $dataProvider = new ActiveDataProvider([


            'query'=>PatientQueue::find()
            ->orderBy([
                'id'=>SORT_ASC
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



}