<?php

namespace app\controllers;


use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;


use app\models\PatientQueue;
use app\models\Patient;
use app\models\MedicalRecords;
use app\models\LabRequest;
use app\models\Prescription;
use app\models\PatientVisit;



class PatientQueueController extends Controller
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

            ],



            'verbs'=>[

                'class'=>VerbFilter::class,

                'actions'=>[

                    'delete'=>['POST']

                ]

            ]

        ];

    }






    /*
    |--------------------------------------------------------------------------
    | QUEUE COMMAND CENTER
    |--------------------------------------------------------------------------
    */

    public function actionIndex()
    {


        $query = PatientQueue::find()

            ->with([

                'patient',

                'doctor'

            ])

            ->orderBy([

                'created_at'=>SORT_ASC

            ]);






        $dataProvider = new ActiveDataProvider([

            'query'=>$query,


            'pagination'=>[

                'pageSize'=>15

            ]

        ]);







        $statistics=[


            'total'=>PatientQueue::find()
                ->count(),



            'waiting'=>PatientQueue::find()
                ->where([
                    'status'=>'Waiting'
                ])
                ->count(),



            'consulting'=>PatientQueue::find()
                ->where([
                    'status'=>'Consulting'
                ])
                ->count(),



            'completed'=>PatientQueue::find()
                ->where([
                    'status'=>'Completed'
                ])
                ->count(),


        ];








        return $this->render('index',[


            'dataProvider'=>$dataProvider,


            'statistics'=>$statistics



        ]);

    }





    /*
    |--------------------------------------------------------------------------
    | CREATE PATIENT QUEUE
    |--------------------------------------------------------------------------
    */

    public function actionCreate()
    {


        $model = new PatientQueue();




        if($model->load(Yii::$app->request->post()))
        {


            /*
            |--------------------------------------------------------------------------
            | PREVENT DUPLICATE ACTIVE QUEUE
            |--------------------------------------------------------------------------
            */

            $exists = PatientQueue::find()

                ->where([

                    'patient_id'=>$model->patient_id

                ])

                ->andWhere([

                    'status'=>[

                        'Waiting',

                        'Consulting'

                    ]

                ])

                ->exists();





            if($exists)
            {

                Yii::$app->session->setFlash(

                    'warning',

                    'This patient already exists in active queue.'

                );


                return $this->redirect([

                    'index'

                ]);

            }







            /*
            |--------------------------------------------------------------------------
            | AUTO GENERATE QUEUE NUMBER
            |--------------------------------------------------------------------------
            */

            if(empty($model->queue_number))
            {

                $model->queue_number = $this->generateQueueNumber();

            }






            /*
            |--------------------------------------------------------------------------
            | DEFAULT WORKFLOW STATUS
            |--------------------------------------------------------------------------
            */


            if(empty($model->status))
            {

                $model->status="Waiting";

            }






            /*
            |--------------------------------------------------------------------------
            | CREATED TIME
            |--------------------------------------------------------------------------
            */

            if($model->hasAttribute('created_at'))
            {

                $model->created_at=date(

                    'Y-m-d H:i:s'

                );

            }








            if($model->save())
            {


                Yii::$app->session->setFlash(

                    'success',

                    'Patient successfully added to queue.'

                );



                return $this->redirect([

                    'view',

                    'id'=>$model->id

                ]);

            }



        }







        return $this->render('create',[


            'model'=>$model


        ]);


    }









    /*
    |--------------------------------------------------------------------------
    | GENERATE QUEUE NUMBER
    |--------------------------------------------------------------------------
    | Example:
    | Q-001
    | Q-002
    |--------------------------------------------------------------------------
    */


    protected function generateQueueNumber()
    {


        $lastQueue = PatientQueue::find()

            ->orderBy([

                'id'=>SORT_DESC

            ])

            ->one();





        if($lastQueue)
        {


            $lastNumber = (int)str_replace(

                'Q-',

                '',

                $lastQueue->queue_number

            );



            $next = $lastNumber + 1;


        }

        else
        {


            $next = 1;


        }





        return 'Q-' . str_pad(

            $next,

            3,

            '0',

            STR_PAD_LEFT

        );


    }

    /*

/*
|--------------------------------------------------------------------------
| PATIENT QUEUE PROFILE VIEW
|--------------------------------------------------------------------------
*/

public function actionView($id)
{

    $model = $this->findModel($id);



    /*
    |--------------------------------------------------------------------------
    | PATIENT VISITS
    |--------------------------------------------------------------------------
    */

    $visits = PatientVisit::find()

        ->where([

            'patient_id'=>$model->patient_id

        ])

        ->orderBy([

            'id'=>SORT_DESC

        ])

        ->all();



    $visitIds = [];



    foreach($visits as $visit)
    {

        $visitIds[] = $visit->id;

    }





    /*
    |--------------------------------------------------------------------------
    | MEDICAL RECORDS
    |--------------------------------------------------------------------------
    */


    $medicalRecords = MedicalRecords::find()

        ->where([

            'patient_id'=>$model->patient_id

        ])

        ->orderBy([

            'id'=>SORT_DESC

        ])

        ->all();







    /*
    |--------------------------------------------------------------------------
    | LAB REQUEST HISTORY
    |--------------------------------------------------------------------------
    */


    $labRequests = LabRequest::find()

        ->where([

            'patient_id'=>$model->patient_id

        ])

        ->orderBy([

            'id'=>SORT_DESC

        ])

        ->all();








    /*
    |--------------------------------------------------------------------------
    | PRESCRIPTION HISTORY
    |--------------------------------------------------------------------------
    */


    $prescriptions = [];



    if(!empty($visitIds))
    {


        $prescriptions = Prescription::find()

            ->where([

                'visit_id'=>$visitIds

            ])

            ->orderBy([

                'id'=>SORT_DESC

            ])

            ->all();


    }








    /*
    |--------------------------------------------------------------------------
    | WAITING TIME
    |--------------------------------------------------------------------------
    */


    $waitingTime = "0 minutes";



    if($model->created_at)
    {


        $created = strtotime(

            $model->created_at

        );



        $now = time();



        $minutes = floor(

            ($now-$created)/60

        );



        $waitingTime = $minutes." minutes";


    }









    return $this->render('view',[


        'model'=>$model,


        'visits'=>$visits,


        'medicalRecords'=>$medicalRecords,


        'labRequests'=>$labRequests,


        'prescriptions'=>$prescriptions,


        'waitingTime'=>$waitingTime



    ]);

}
    /*
    |--------------------------------------------------------------------------
    | START CONSULTATION
    |--------------------------------------------------------------------------
    */

    public function actionStart($id)
    {


        $queue = $this->findModel($id);





        /*
        |--------------------------------------------------------------------------
        | WORKFLOW VALIDATION
        |--------------------------------------------------------------------------
        */


        if(!$this->validateWorkflow(

            $queue,

            'Consulting'

        ))
        {


            Yii::$app->session->setFlash(

                'error',

                'Invalid queue workflow transition.'

            );


            return $this->redirect([

                'index'

            ]);

        }







        $queue->status="Consulting";






        /*
        |--------------------------------------------------------------------------
        | ASSIGN CURRENT DOCTOR
        |--------------------------------------------------------------------------
        */

        $queue->doctor_id = Yii::$app->user->id;






        if($queue->hasAttribute('called_time'))
        {

            $queue->called_time=date(

                'Y-m-d H:i:s'

            );

        }






        if($queue->hasAttribute('consulted_at'))
        {

            $queue->consulted_at=date(

                'Y-m-d H:i:s'

            );

        }





        if($queue->hasAttribute('notes'))
        {

            $queue->notes="Consultation started";

        }






        $queue->save(false);







        Yii::$app->session->setFlash(

            'success',

            'Patient moved to consultation.'

        );







        return $this->redirect([

            'view',

            'id'=>$id

        ]);



    }












    /*
    |--------------------------------------------------------------------------
    | CALL PATIENT TO DOCTOR ROOM
    |--------------------------------------------------------------------------
    */

    public function actionCallPatient($id)
    {


        $queue=$this->findModel($id);





        if(!$this->validateWorkflow(

            $queue,

            'Consulting'

        ))
        {


            Yii::$app->session->setFlash(

                'error',

                'Patient cannot be called.'

            );


            return $this->redirect([

                'index'

            ]);

        }








        $queue->status="Consulting";



        $queue->doctor_id=Yii::$app->user->id;





        if($queue->hasAttribute('called_time'))
        {

            $queue->called_time=date(

                'Y-m-d H:i:s'

            );

        }






        if($queue->hasAttribute('notes'))
        {

            $queue->notes="Patient called to consultation room";

        }






        $queue->save(false);







        Yii::$app->session->setFlash(

            'success',

            'Patient called successfully.'

        );






        return $this->redirect([

            '/medical-records/create',

            'patient_id'=>$queue->patient_id,

            'queue_id'=>$queue->id

        ]);



    }









    /*
    |--------------------------------------------------------------------------
    | WORKFLOW RULES
    |--------------------------------------------------------------------------
    */

    protected function validateWorkflow($model,$newStatus)
    {


        $workflow=[


            'Waiting'=>[

                'Consulting'

            ],



            'Consulting'=>[

                'Completed'

            ],



            'Completed'=>[]


        ];






        if(isset($workflow[$model->status]))
        {


            return in_array(

                $newStatus,

                $workflow[$model->status]

            );


        }






        return false;



    }

    /*
    |--------------------------------------------------------------------------
    | COMPLETE CONSULTATION
    |--------------------------------------------------------------------------
    */

    public function actionComplete($id)
    {


        $queue = $this->findModel($id);





        if(!$this->validateWorkflow(

            $queue,

            'Completed'

        ))
        {


            Yii::$app->session->setFlash(

                'error',

                'Patient cannot be completed from current status.'

            );


            return $this->redirect([

                'index'

            ]);

        }







        $queue->status="Completed";







        if($queue->hasAttribute('finished_time'))
        {

            $queue->finished_time=date(

                'Y-m-d H:i:s'

            );

        }







        if($queue->hasAttribute('notes'))
        {

            $queue->notes="Consultation completed";

        }






        $queue->save(false);







        Yii::$app->session->setFlash(

            'success',

            'Consultation completed successfully.'

        );






        return $this->redirect([

            'view',

            'id'=>$id

        ]);



    }












    /*
    |--------------------------------------------------------------------------
    | UPDATE QUEUE STATUS
    |--------------------------------------------------------------------------
    */

    public function actionUpdateStatus($id,$status)
    {


        $queue=$this->findModel($id);






        if(!$this->validateWorkflow(

            $queue,

            $status

        ))
        {


            Yii::$app->session->setFlash(

                'error',

                'Invalid workflow status change.'

            );


            return $this->redirect([

                'index'

            ]);

        }







        $queue->status=$status;







        if($status=="Consulting")
        {


            $queue->doctor_id=Yii::$app->user->id;



            if($queue->hasAttribute('called_time'))
            {

                $queue->called_time=date(

                    'Y-m-d H:i:s'

                );

            }


        }






        if($status=="Completed")
        {


            if($queue->hasAttribute('finished_time'))
            {

                $queue->finished_time=date(

                    'Y-m-d H:i:s'

                );

            }


        }







        $queue->save(false);







        Yii::$app->session->setFlash(

            'success',

            'Queue status updated.'

        );






        return $this->redirect([

            'view',

            'id'=>$id

        ]);



    }













    /*
    |--------------------------------------------------------------------------
    | PATIENT MODAL INFORMATION (AJAX)
    |--------------------------------------------------------------------------
    */

    public function actionPatientInfo($id)
    {


        Yii::$app->response->format =
            \yii\web\Response::FORMAT_JSON;






        $queue=$this->findModel($id);



        $patient=$queue->patient;






        if(!$patient)
        {


            return [

                'success'=>false,

                'message'=>'Patient not found.'

            ];


        }







        /*
        Age calculation
        */

        $age="N/A";



        if($patient->dob)
        {


            $birth=new \DateTime(

                $patient->dob

            );


            $today=new \DateTime();



            $age=$birth

                ->diff($today)

                ->y;


        }








        return [


            'success'=>true,



            'patient'=>[


                'name'=>$patient->fullName,


                'gender'=>$patient->gender ?? 'N/A',


                'phone'=>$patient->phone ?? 'N/A',


                'age'=>$age,


                'queue'=>$queue->queue_number,


                'status'=>$queue->status,



                'visits'=>\app\models\PatientVisit::find()

                    ->where([

                        'patient_id'=>$patient->id

                    ])

                    ->count(),



                'medical_history'=>MedicalRecords::find()

                    ->where([

                        'patient_id'=>$patient->id

                    ])

                    ->count()


            ]



        ];



    }


    /*
    |--------------------------------------------------------------------------
    | REAL TIME QUEUE DASHBOARD DATA
    |--------------------------------------------------------------------------
    */

    public function actionDashboardData()
    {


        Yii::$app->response->format =
            \yii\web\Response::FORMAT_JSON;





        return [


            'total'=>PatientQueue::find()
                ->count(),



            'waiting'=>PatientQueue::find()

                ->where([

                    'status'=>'Waiting'

                ])

                ->count(),




            'consulting'=>PatientQueue::find()

                ->where([

                    'status'=>'Consulting'

                ])

                ->count(),




            'completed'=>PatientQueue::find()

                ->where([

                    'status'=>'Completed'

                ])

                ->count(),




            'latest'=>PatientQueue::find()

                ->with('patient')

                ->orderBy([

                    'id'=>SORT_DESC

                ])

                ->limit(5)

                ->all()


        ];



    }













    /*
    |--------------------------------------------------------------------------
    | DELETE QUEUE
    |--------------------------------------------------------------------------
    */

    public function actionDelete($id)
    {


        $model=$this->findModel($id);



        $model->delete();





        Yii::$app->session->setFlash(

            'success',

            'Queue record deleted successfully.'

        );






        return $this->redirect([

            'index'

        ]);



    }













    /*
    |--------------------------------------------------------------------------
    | FIND QUEUE MODEL
    |--------------------------------------------------------------------------
    */

    protected function findModel($id)
    {


        $model = PatientQueue::find()

            ->with([

                'patient',

                'doctor'

            ])

            ->where([

                'id'=>$id

            ])

            ->one();






        if($model!==null)
        {

            return $model;

        }







        throw new NotFoundHttpException(

            'Patient queue record not found.'

        );



    }



}