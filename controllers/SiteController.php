<?php

namespace app\controllers;

use Yii;

use yii\web\Controller;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

use app\models\LoginForm;
use app\models\ContactForm;

use app\models\Patient;
use app\models\PatientQueue;
use app\models\LabRequest;
use app\models\Prescription;


class SiteController extends Controller
{


    public function actions()
    {
        return [

            'error'=>[
                'class'=>'yii\web\ErrorAction',
            ],

        ];
    }




    public function behaviors()
    {

        return [

            'access'=>[

                'class'=>AccessControl::class,

                'rules'=>[


                    [
                        'actions'=>[
                            'login',
                            'error'
                        ],
                        'allow'=>true
                    ],


                    [
                        'allow'=>true,
                        'roles'=>['@']
                    ]

                ]

            ],


            'verbs'=>[

                'class'=>VerbFilter::class,

                'actions'=>[

                    'logout'=>[
                        'GET',
                        'POST'
                    ]

                ]

            ]

        ];

    }






    public function beforeAction($action)
    {

        if($action->id=='logout')
        {
            $this->enableCsrfValidation=false;
        }


        return parent::beforeAction($action);

    }








    public function actionIndex()
    {


        if(Yii::$app->user->isGuest)
        {

            return $this->redirect([
                'site/login'
            ]);

        }



        try
        {


            $totalPatients =
                Patient::find()->count();



            $male =
                Patient::find()
                ->where([
                    'gender'=>'Male'
                ])
                ->count();



            $female =
                Patient::find()
                ->where([
                    'gender'=>'Female'
                ])
                ->count();





            $waitingPatients =
                PatientQueue::find()
                ->where([
                    'status'=>'Waiting'
                ])
                ->count();



            $calledPatients =
                PatientQueue::find()
                ->where([
                    'status'=>'Called'
                ])
                ->count();



            $consultingPatients =
                PatientQueue::find()
                ->where([
                    'status'=>'Consulting'
                ])
                ->count();



            $completedPatients =
                PatientQueue::find()
                ->where([
                    'status'=>'Completed'
                ])
                ->count();






            $criticalPatients =
                Patient::find()
                ->where([
                    'status'=>'Critical'
                ])
                ->count();






            $pendingLab =
                LabRequest::find()
                ->where([
                    'status'=>'Pending'
                ])
                ->count();



            $completedLab =
                LabRequest::find()
                ->where([
                    'status'=>'Completed'
                ])
                ->count();






            $pendingPrescription=0;


            if(class_exists(Prescription::class))
            {

                $pendingPrescription =
                    Prescription::find()
                    ->where([
                        'status'=>'Pending'
                    ])
                    ->count();

            }






            $todayPatients =
                Patient::find()
                ->where([
                    'like',
                    'created_at',
                    date('Y-m-d')
                ])
                ->count();







            $recoveredPatients =
                Patient::find()
                ->where([
                    'status'=>'Recovered'
                ])
                ->count();



            $recoveryScore=0;


            if($totalPatients>0)
            {

                $recoveryScore =
                    round(
                        ($recoveredPatients/$totalPatients)*100
                    );

            }






            $riskFlags =
                $criticalPatients+$pendingLab;



            if($criticalPatients>=5)
            {

                $riskLevel="HIGH RISK";

                $warning=
                "Immediate medical attention required";

            }

            elseif($criticalPatients>0)
            {

                $riskLevel="MEDIUM RISK";

                $warning=
                "Monitor critical patients";

            }

            else
            {

                $riskLevel="LOW RISK";

                $warning=
                "Hospital condition stable";

            }







            $queuePatients =
                PatientQueue::find()
                ->with([
                    'patient'
                ])
                ->orderBy([
                    'id'=>SORT_DESC
                ])
                ->limit(10)
                ->all();







            return $this->render('index',[


                'totalPatients'=>$totalPatients,

                'male'=>$male,

                'female'=>$female,


                'waitingPatients'=>$waitingPatients,

                'calledPatients'=>$calledPatients,

                'consultingPatients'=>$consultingPatients,

                'completedPatients'=>$completedPatients,


                'critical'=>$criticalPatients,


                'pendingLab'=>$pendingLab,

                'completedLab'=>$completedLab,


                'pendingPrescription'=>$pendingPrescription,


                'todayPatients'=>$todayPatients,


                'recoveryScore'=>$recoveryScore,

                'riskFlags'=>$riskFlags,

                'riskLevel'=>$riskLevel,

                'warning'=>$warning,


                'queuePatients'=>$queuePatients


            ]);



        }
        catch(\Throwable $e)
        {

            Yii::error($e->getMessage());

            throw $e;

        }


    }









    public function actionLogin()
    {


        if(!Yii::$app->user->isGuest)
        {
            return $this->goHome();
        }



        $model=new LoginForm();



        if(
            $model->load(Yii::$app->request->post())
            &&
            $model->login()
        )
        {

            return $this->goHome();

        }



        $model->password="";


        return $this->render('login',[

            'model'=>$model

        ]);

    }









    public function actionLogout()
    {

        Yii::$app->user->logout();


        return $this->redirect([
            'site/login'
        ]);

    }







    public function actionContact()
    {

        $model=new ContactForm();


        return $this->render('contact',[

            'model'=>$model

        ]);

    }







    public function actionAbout()
    {

        return $this->render('about');

    }


}