<?php

namespace app\controllers;


use Yii;

use yii\web\Controller;
use yii\web\NotFoundHttpException;

use yii\filters\AccessControl;
use yii\filters\VerbFilter;

use yii\data\ActiveDataProvider;


use app\models\LabRequest;
use app\models\LabResult;
use app\models\LabTest;
use app\models\PatientQueue;
use app\models\PatientVisit;





class LaboratoryController extends Controller
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
| LABORATORY DASHBOARD
|--------------------------------------------------------------------------
*/


public function actionDashboard()
{


    $query = LabRequest::find()

        ->with([

            'patient',

            'doctor'

        ])

        ->orderBy([

            'id'=>SORT_DESC

        ]);





    $dataProvider = new ActiveDataProvider([


        'query'=>$query,


        'pagination'=>[

            'pageSize'=>15

        ]


    ]);









    $total = LabRequest::find()->count();




    $pending = LabRequest::find()

        ->where([

            'status'=>'Pending'

        ])

        ->count();







    $processing = LabRequest::find()

        ->where([

            'status'=>'Processing'

        ])

        ->count();







    $completed = LabRequest::find()

        ->where([

            'status'=>'Completed'

        ])

        ->count();







    $today = LabRequest::find()

        ->where([

            'between',

            'created_at',

            date('Y-m-d 00:00:00'),

            date('Y-m-d 23:59:59')

        ])

        ->count();







    $recentRequests = LabRequest::find()

        ->with([

            'patient',

            'doctor'

        ])

        ->orderBy([

            'id'=>SORT_DESC

        ])

        ->limit(10)

        ->all();









    return $this->render(

        'dashboard',

        [


            'dataProvider'=>$dataProvider,


            'total'=>$total,


            'pending'=>$pending,


            'processing'=>$processing,


            'completed'=>$completed,


            'today'=>$today,


            'recentRequests'=>$recentRequests


        ]

    );



}









/*
|--------------------------------------------------------------------------
| LAB REQUEST LIST
|--------------------------------------------------------------------------
*/


public function actionRequests()
{


    $query = LabRequest::find()

        ->with([

            'patient',

            'doctor'

        ])

        ->orderBy([

            'id'=>SORT_DESC

        ]);







    $dataProvider = new ActiveDataProvider([


        'query'=>$query,


        'pagination'=>[


            'pageSize'=>20


        ]


    ]);







    return $this->render(

        'requests',

        [


            'dataProvider'=>$dataProvider


        ]

    );



}








/*
|--------------------------------------------------------------------------
| CREATE LAB REQUEST
|--------------------------------------------------------------------------
*/


public function actionCreate($patient_id=null)
{


    $model = new LabRequest();





    if($patient_id)
    {

        $model->patient_id = $patient_id;

    }






    if($model->load(Yii::$app->request->post()))
    {


        $transaction = Yii::$app->db->beginTransaction();


        try
        {


            if($model->hasAttribute('doctor_id'))
            {

                $model->doctor_id =
                    Yii::$app->user->id;

            }







            if($model->hasAttribute('status'))
            {

                $model->status =
                    'Pending';

            }






            if($model->hasAttribute('created_at'))
            {

                $model->created_at =
                    date('Y-m-d H:i:s');

            }







            if(!$model->save())
            {


                throw new \Exception(

                    json_encode($model->errors)

                );


            }






            $transaction->commit();





            Yii::$app->session->setFlash(

                'success',

                'Laboratory request created successfully'

            );





            return $this->redirect([

                'requests'

            ]);




        }
        catch(\Exception $e)
        {


            $transaction->rollBack();



            Yii::$app->session->setFlash(

                'error',

                $e->getMessage()

            );


        }


    }







    return $this->render(

        'create',

        [

            'model'=>$model

        ]

    );


}
/*
|--------------------------------------------------------------------------
| VIEW LAB REQUEST DETAILS
|--------------------------------------------------------------------------
*/


public function actionView($id)
{


    $model = $this->findRequest($id);





    /*
    |--------------------------------------------------------------------------
    | FIND LAB TEST
    |--------------------------------------------------------------------------
    */


    $labTest = LabTest::find()

        ->where([

            'request_id'=>$id

        ])

        ->one();








    /*
    |--------------------------------------------------------------------------
    | FIND RESULT
    |--------------------------------------------------------------------------
    */


    $result = null;



    if($labTest)
    {


        $result = LabResult::find()

            ->where([

                'test_id'=>$labTest->id

            ])

            ->one();


    }









    return $this->render(

        'view',

        [


            'model'=>$model,


            'labTest'=>$labTest,


            'result'=>$result


        ]

    );



}












/*
|--------------------------------------------------------------------------
| START PROCESSING TEST
|--------------------------------------------------------------------------
*/


public function actionProcess($id)
{


    $model = $this->findRequest($id);





    if($model->hasAttribute('status'))
    {


        $model->status =
            'Processing';


    }







    if($model->hasAttribute('started_at'))
    {


        $model->started_at =
            date('Y-m-d H:i:s');


    }








    $model->save(false);








    Yii::$app->session->setFlash(

        'success',

        'Laboratory test started successfully'

    );








    return $this->redirect([

        'dashboard'

    ]);



}













/*
|--------------------------------------------------------------------------
| CREATE LAB RESULT
|--------------------------------------------------------------------------
*/


public function actionCreateResult($id)
{


    $request =
        $this->findRequest($id);





    $model =
        new LabResult();









    if($model->load(Yii::$app->request->post()))
    {


        $transaction =
            Yii::$app->db->beginTransaction();




        try
        {





            /*
            |--------------------------------------------------------------------------
            | FIND OR CREATE LAB TEST
            |--------------------------------------------------------------------------
            */



            $labTest = LabTest::find()

                ->where([

                    'request_id'=>$request->id

                ])

                ->one();








            if(!$labTest)
            {



                $labTest =
                    new LabTest();






                if($labTest->hasAttribute('request_id'))
                {

                    $labTest->request_id =
                        $request->id;

                }







                if($labTest->hasAttribute('patient_id'))
                {


                    $labTest->patient_id =
                        $request->patient_id;


                }







                if($labTest->hasAttribute('test_name'))
                {


                    $labTest->test_name =

                        $request->test_name
                        ??
                        'General Laboratory Test';


                }








                if($labTest->hasAttribute('status'))
                {


                    $labTest->status =
                        'Completed';


                }









                if($labTest->hasAttribute('created_at'))
                {


                    $labTest->created_at =
                        date('Y-m-d H:i:s');


                }








                if(!$labTest->save())
                {


                    throw new \Exception(

                        json_encode(
                            $labTest->errors
                        )

                    );


                }



            }












            /*
            |--------------------------------------------------------------------------
            | SAVE RESULT
            |--------------------------------------------------------------------------
            */


            $model->test_id =
                $labTest->id;









            if($model->hasAttribute('created_by'))
            {


                $model->created_by =
                    Yii::$app->user->id;


            }








            if($model->hasAttribute('status'))
            {


                $model->status =
                    'Completed';


            }









            if($model->hasAttribute('created_at'))
            {


                $model->created_at =
                    date('Y-m-d H:i:s');


            }








            if(!$model->save())
            {


                throw new \Exception(

                    json_encode(
                        $model->errors
                    )

                );


            }












            /*
            |--------------------------------------------------------------------------
            | UPDATE LAB REQUEST STATUS
            |--------------------------------------------------------------------------
            */



            if($request->hasAttribute('status'))
            {


                $request->status =
                    'Completed';


            }








            if($request->hasAttribute('completed_at'))
            {


                $request->completed_at =
                    date('Y-m-d H:i:s');


            }








            $request->save(false);












            /*
            |--------------------------------------------------------------------------
            | UPDATE PATIENT QUEUE
            |--------------------------------------------------------------------------
            */



            if($request->hasAttribute('queue_id')
                &&
                $request->queue_id)
            {



                $queue =
                    PatientQueue::findOne(
                        $request->queue_id
                    );







                if($queue)
                {



                    if($queue->hasAttribute('lab_status'))
                    {


                        $queue->lab_status =
                            'Result Ready';


                    }






                    if($queue->hasAttribute('status'))
                    {


                        $queue->status =
                            'Completed';


                    }







                    $queue->save(false);



                }


            }









            $transaction->commit();









            Yii::$app->session->setFlash(

                'success',

                'Laboratory result completed successfully'

            );








            return $this->redirect([

                'view',

                'id'=>$id

            ]);






        }
        catch(\Exception $e)
        {



            $transaction->rollBack();




            Yii::$app->session->setFlash(

                'error',

                $e->getMessage()

            );


        }



    }









    return $this->render(

        'create-result',

        [

            'model'=>$model,


            'request'=>$request


        ]

    );



}
/*
|--------------------------------------------------------------------------
| ADVANCED LABORATORY SEARCH
|--------------------------------------------------------------------------
*/


public function actionSearch()
{


    $query = LabRequest::find()

        ->with([

            'patient',

            'doctor'

        ]);






    $search = Yii::$app->request->get('search');

    $status = Yii::$app->request->get('status');

    $date = Yii::$app->request->get('date');








    if($search)
    {


        $query->joinWith([

            'patient'

        ]);



        $query->andFilterWhere([


            'or',


            [

                'like',

                'patient.first_name',

                $search

            ],



            [

                'like',

                'patient.last_name',

                $search

            ],



            [

                'like',

                'patient.patient_number',

                $search

            ],



            [

                'like',

                'test_name',

                $search

            ]


        ]);



    }









    if($status)
    {


        $query->andWhere([

            'status'=>$status

        ]);


    }









    if($date)
    {


        $query->andWhere([

            'between',

            'created_at',

            $date.' 00:00:00',

            $date.' 23:59:59'

        ]);


    }









    $dataProvider = new ActiveDataProvider([


        'query'=>$query,


        'pagination'=>[

            'pageSize'=>25

        ]

    ]);








    return $this->render(

        'requests',

        [

            'dataProvider'=>$dataProvider,


            'search'=>$search,


            'status'=>$status,


            'date'=>$date


        ]

    );



}









/*
|--------------------------------------------------------------------------
| PATIENT LABORATORY HISTORY
|--------------------------------------------------------------------------
*/


public function actionPatientHistory($id)
{


    $requests = LabRequest::find()

        ->with([

            'patient',

            'doctor'

        ])

        ->where([

            'patient_id'=>$id

        ])

        ->orderBy([

            'id'=>SORT_DESC

        ])

        ->all();







    return $this->render(

        'patient-history',

        [


            'requests'=>$requests


        ]

    );


}












/*
|--------------------------------------------------------------------------
| LABORATORY REPORTS
|--------------------------------------------------------------------------
*/


public function actionReports()
{



    $monthly = [];



    for($i=1;$i<=12;$i++)
    {



        $monthly[$i] = LabRequest::find()

            ->where([

                'MONTH(created_at)'=>$i

            ])

            ->count();



    }








    $statusReport = [



        'Pending'=>

            LabRequest::find()

            ->where([

                'status'=>'Pending'

            ])

            ->count(),





        'Processing'=>

            LabRequest::find()

            ->where([

                'status'=>'Processing'

            ])

            ->count(),





        'Completed'=>

            LabRequest::find()

            ->where([

                'status'=>'Completed'

            ])

            ->count(),


    ];









    return $this->render(

        'reports',

        [


            'monthly'=>$monthly,


            'statusReport'=>$statusReport


        ]

    );


}












/*
|--------------------------------------------------------------------------
| LAB STATISTICS API
|--------------------------------------------------------------------------
*/


public function actionStatistics()
{


    Yii::$app->response->format =

        \yii\web\Response::FORMAT_JSON;







    return [



        'total'=>

            LabRequest::find()

            ->count(),





        'pending'=>

            LabRequest::find()

            ->where([

                'status'=>'Pending'

            ])

            ->count(),





        'processing'=>

            LabRequest::find()

            ->where([

                'status'=>'Processing'

            ])

            ->count(),





        'completed'=>

            LabRequest::find()

            ->where([

                'status'=>'Completed'

            ])

            ->count(),





        'today'=>

            LabRequest::find()

            ->where([

                'between',

                'created_at',

                date('Y-m-d 00:00:00'),

                date('Y-m-d 23:59:59')

            ])

            ->count(),



    ];



}












/*
|--------------------------------------------------------------------------
| API PATIENT LAB RESULTS
|--------------------------------------------------------------------------
*/


public function actionApiPatientResults($id)
{


    Yii::$app->response->format =

        \yii\web\Response::FORMAT_JSON;






    $results = LabRequest::find()

        ->with([

            'patient'

        ])

        ->where([

            'patient_id'=>$id

        ])

        ->asArray()

        ->all();







    return [


        'success'=>true,


        'patient_id'=>$id,


        'results'=>$results


    ];



}
/*
|--------------------------------------------------------------------------
| DELETE LAB REQUEST
|--------------------------------------------------------------------------
*/


public function actionDelete($id)
{


    $model = $this->findRequest($id);





    try
    {



        /*
        |--------------------------------------------------------------------------
        | SOFT DELETE IF AVAILABLE
        |--------------------------------------------------------------------------
        */



        if($model->hasAttribute('status'))
        {


            $model->status = 'Deleted';


            $model->save(false);



        }
        else
        {



            $model->delete();



        }








        Yii::$app->session->setFlash(

            'success',

            'Laboratory request removed successfully.'

        );




    }
    catch(\Exception $e)
    {



        Yii::$app->session->setFlash(

            'error',

            'Unable to delete laboratory request.'

        );



        Yii::error(

            $e->getMessage(),

            'laboratory-delete'

        );



    }








    return $this->redirect([

        'requests'

    ]);



}









/*
|--------------------------------------------------------------------------
| FIND LAB REQUEST
|--------------------------------------------------------------------------
*/


protected function findRequest($id)
{


    $model = LabRequest::find()

        ->with([

            'patient',

            'doctor'

        ])

        ->where([

            'id'=>$id

        ])

        ->one();








    if($model)
    {


        return $model;


    }








    throw new NotFoundHttpException(

        'Laboratory request was not found.'

    );



}









/*
|--------------------------------------------------------------------------
| BEFORE ACTION SECURITY CHECK
|--------------------------------------------------------------------------
*/


public function beforeAction($action)
{


    if(!parent::beforeAction($action))
    {

        return false;

    }







    /*
    |--------------------------------------------------------------------------
    | Prevent deleted users accessing laboratory
    |--------------------------------------------------------------------------
    */


    if(!Yii::$app->user->isGuest)
    {


        $user = Yii::$app->user->identity;





        if(
            $user->hasAttribute('status')
            &&
            $user->status=='Deleted'
        )
        {


            Yii::$app->user->logout();


            throw new \yii\web\ForbiddenHttpException(

                'Your account is inactive.'

            );


        }


    }








    return true;



}









/*
|--------------------------------------------------------------------------
| ERROR LOGGER HELPER
|--------------------------------------------------------------------------
*/


protected function logError($message,$category='laboratory')
{


    Yii::error(

        [

            'message'=>$message,

            'user'=>Yii::$app->user->id,

            'time'=>date('Y-m-d H:i:s')

        ],

        $category

    );



}









}
