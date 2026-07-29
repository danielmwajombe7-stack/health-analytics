<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Admission;


class AdmissionController extends Controller
{


    public function actionIndex()
    {

        $admissions = Admission::find()
            ->orderBy(['id'=>SORT_DESC])
            ->all();


        return $this->render('index',[
            'admissions'=>$admissions
        ]);

    }


}