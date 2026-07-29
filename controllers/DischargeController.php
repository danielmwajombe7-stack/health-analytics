<?php

namespace app\controllers;

use yii\web\Controller;
use yii\filters\AccessControl;


class DischargeController extends Controller
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




    public function actionIndex()
    {

        return $this->render('index');

    }


}