<?php

namespace app\controllers;


use Yii;

use yii\web\Controller;
use yii\filters\AccessControl;


use app\models\Patient;
use app\models\PatientQueue;
use app\models\MedicalRecords;
use app\models\Appointment;
use app\models\LabRequest;
use app\models\Prescription;



class DashboardController extends Controller
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








    /*
    |--------------------------------------------------------------------------
    | MAIN DASHBOARD
    |--------------------------------------------------------------------------
    */


    public function actionIndex()
    {


        $user = Yii::$app->user->identity;





        /*
        |--------------------------------------------------------------------------
        | PATIENT STATISTICS
        |--------------------------------------------------------------------------
        */


        $totalPatients = Patient::find()
            ->count();




        $todayPatients = Patient::find()

            ->where([

                'DATE(created_at)'=>date('Y-m-d')

            ])

            ->count();







        /*
        |--------------------------------------------------------------------------
        | QUEUE STATISTICS
        |--------------------------------------------------------------------------
        */


        $waitingPatients = PatientQueue::find()

            ->where([

                'status'=>'Waiting'

            ])

            ->count();





        $consultingPatients = PatientQueue::find()

            ->where([

                'status'=>'Consulting'

            ])

            ->count();








        /*
        |--------------------------------------------------------------------------
        | MEDICAL ACTIVITIES
        |--------------------------------------------------------------------------
        */


        $totalRecords = MedicalRecords::find()
            ->count();







        /*
        |--------------------------------------------------------------------------
        | LABORATORY
        |--------------------------------------------------------------------------
        */


        $pendingLab = LabRequest::find()

            ->where([

                'status'=>'Pending'

            ])

            ->count();








        $completedLab = LabRequest::find()

            ->where([

                'status'=>'Completed'

            ])

            ->count();









        /*
        |--------------------------------------------------------------------------
        | APPOINTMENTS
        |--------------------------------------------------------------------------
        */


        $appointments = 0;


        if(class_exists('app\models\Appointment'))
        {


            $appointments =
            Appointment::find()

            ->where([

                'DATE(appointment_date)'=>date('Y-m-d')

            ])

            ->count();


        }








        /*
        |--------------------------------------------------------------------------
        | PRESCRIPTIONS
        |--------------------------------------------------------------------------
        */


        $prescriptions =
        Prescription::find()
            ->count();










        /*
        |--------------------------------------------------------------------------
        | RECENT PATIENTS
        |--------------------------------------------------------------------------
        */


        $recentPatients = Patient::find()

            ->orderBy([

                'id'=>SORT_DESC

            ])

            ->limit(5)

            ->all();










        /*
        |--------------------------------------------------------------------------
        | RECENT QUEUE
        |--------------------------------------------------------------------------
        */


        $recentQueue =
        PatientQueue::find()

        ->with([

            'patient'

        ])

        ->orderBy([

            'id'=>SORT_DESC

        ])

        ->limit(5)

        ->all();












        return $this->render('index',[



            'user'=>$user,


            'totalPatients'=>$totalPatients,


            'todayPatients'=>$todayPatients,


            'waitingPatients'=>$waitingPatients,


            'consultingPatients'=>$consultingPatients,


            'totalRecords'=>$totalRecords,


            'pendingLab'=>$pendingLab,


            'completedLab'=>$completedLab,


            'appointments'=>$appointments,


            'prescriptions'=>$prescriptions,


            'recentPatients'=>$recentPatients,


            'recentQueue'=>$recentQueue,


        ]);


    }



}