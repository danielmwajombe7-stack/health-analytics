<?php

namespace app\controllers;


use Yii;
use yii\web\Controller;
use app\models\Role;
use yii\filters\AccessControl;



class RoleController extends Controller
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


$roles = Role::find()->all();


return $this->render('index',[

'roles'=>$roles

]);


}


}