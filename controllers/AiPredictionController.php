<?php

namespace app\controllers;


use yii\web\Controller;
use app\models\PatientQueue;



class AiPredictionController extends Controller
{


public function actionIndex()
{


$critical =
PatientQueue::find()

->where([
'priority'=>'Critical'
])

->count();



return $this->render(
'index',
[
'critical'=>$critical
]
);



}


}