<?php

namespace app\controllers;


use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\data\ActiveDataProvider;

use app\models\Prescription;



class PharmacyController extends Controller
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


$pending =
Prescription::find()
->where([
'status'=>'Pending'
])
->count();



$dispensed =
Prescription::find()
->where([
'status'=>'Dispensed'
])
->count();




$dataProvider=new ActiveDataProvider([

'query'=>Prescription::find()

->with([

'patient',
'doctor'

])

->where([

'status'=>'Pending'

])

->orderBy([

'id'=>SORT_DESC

])


]);




return $this->render('index',[


'pending'=>$pending,

'dispensed'=>$dispensed,

'dataProvider'=>$dataProvider


]);


}





}