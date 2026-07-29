<?php

namespace app\controllers;


use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;

use app\models\Diagnosis;



class DiagnosisController extends Controller
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






public function actionCreate($visit_id)
{


$model = new Diagnosis();



$model->visit_id=$visit_id;


$model->doctor_id=
Yii::$app->user->id;





if($model->load(Yii::$app->request->post()))
{


if($model->save())
{


Yii::$app->session->setFlash(

'success',

'Diagnosis saved successfully'

);



return $this->redirect([

'doctor/index'

]);


}


}



return $this->render('create',[

'model'=>$model

]);


}




}