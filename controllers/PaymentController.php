<?php

namespace app\controllers;

use Yii;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\data\ActiveDataProvider;

use app\models\Payment;
use app\models\Billing;


class PaymentController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | ACCESS CONTROL
    |--------------------------------------------------------------------------
    */

    public function behaviors()
    {
        return [

            'access'=>[

                'class'=>AccessControl::class,

                'rules'=>[

                    [

                        'allow'=>true,

                        'roles'=>['@']

                    ],

                ],

            ],

        ];
    }





    /*
    |--------------------------------------------------------------------------
    | PAYMENT DASHBOARD
    |--------------------------------------------------------------------------
    */

   public function actionIndex()
{

    $query = Payment::find()

        ->with([
            'billing',
            'receiver'
        ]);



    $search = Yii::$app->request->get('search');



    if(!empty($search))
    {

        $query->andFilterWhere([

            'or',

            ['like','receipt_number',$search],

            ['like','transaction_reference',$search],

            ['like','payment_method',$search],

            ['like','payment_status',$search],

        ]);

    }





    $status = Yii::$app->request->get('status');



    if(!empty($status))
    {

        $query->andWhere([

            'payment_status'=>$status

        ]);

    }





    $method = Yii::$app->request->get('method');



    if(!empty($method))
    {

        $query->andWhere([

            'payment_method'=>$method

        ]);

    }







    /*
    |--------------------------------------------------------------------------
    | ACTIVE DATA PROVIDER
    |--------------------------------------------------------------------------
    */


    $dataProvider = new \yii\data\ActiveDataProvider([


        'query'=>$query->orderBy([

            'id'=>SORT_DESC

        ]),



        'pagination'=>[

            'pageSize'=>20

        ],



    ]);







    /*
    |--------------------------------------------------------------------------
    | FINANCIAL STATISTICS
    |--------------------------------------------------------------------------
    */


    $statistics=[


        'todayRevenue'=>
            Payment::todayCollection(),



        'weeklyRevenue'=>
            Payment::weeklyCollection(),



        'monthlyRevenue'=>
            Payment::monthlyCollection(),



        'cashCollection'=>
            Payment::cashCollection(),



        'mobileCollection'=>
            Payment::mobileMoneyCollection(),



        'bankCollection'=>
            Payment::bankCollection(),



        'insuranceCollection'=>
            Payment::insuranceCollection(),



        'transactions'=>
            Payment::totalTransactions(),



    ];








    return $this->render('index',[



        'dataProvider'=>$dataProvider,



        'statistics'=>$statistics,



        'search'=>$search,



        'status'=>$status,



        'method'=>$method,



    ]);

}




    /*
|--------------------------------------------------------------------------
| PAYMENT ANALYTICS CHART DATA
|--------------------------------------------------------------------------
*/


$charts = [


    /*
    |--------------------------------------------------------------------------
    | Revenue Trend
    |--------------------------------------------------------------------------
    */

    'revenueTrend' => Payment::paymentTrend(7),




    /*
    |--------------------------------------------------------------------------
    | Payment Method Distribution
    |--------------------------------------------------------------------------
    */

    'paymentMethods' => Payment::paymentMethodStatistics(),




    /*
    |--------------------------------------------------------------------------
    | Cashier Performance
    |--------------------------------------------------------------------------
    */

    'cashiers' => Payment::cashierPerformance(),




    /*
    |--------------------------------------------------------------------------
    | Refund Analysis
    |--------------------------------------------------------------------------
    */

    'refunds' => [


        'refunded' => Payment::find()
            ->where([
                'payment_status'=>Payment::STATUS_REFUNDED
            ])
            ->count(),



        'paid' => Payment::find()
            ->where([
                'payment_status'=>Payment::STATUS_PAID
            ])
            ->count(),


    ],




    /*
    |--------------------------------------------------------------------------
    | Billing Payment Ratio
    |--------------------------------------------------------------------------
    */

    'billingRatio'=>[


        'paid'=>Billing::find()
            ->where([
                'status'=>Billing::STATUS_PAID
            ])
            ->count(),



        'pending'=>Billing::find()
            ->where([
                'status'=>Billing::STATUS_UNPAID
            ])
            ->count(),

    ],


];





return $this->render('index',[


    'dataProvider'=>$dataProvider,


    'statistics'=>$statistics,


    'charts'=>$charts,


    'search'=>$search,


    'status'=>$status,


    'method'=>$method,


]);

    }






    /*
    |--------------------------------------------------------------------------
    | VIEW PAYMENT
    |--------------------------------------------------------------------------
    */

    public function actionView($id)
    {

        return $this->render('view',[

            'model'=>$this->findModel($id)

        ]);

    }







    /*
    |--------------------------------------------------------------------------
    | CREATE PAYMENT
    |--------------------------------------------------------------------------
    */

    public function actionCreate()
    {

        $model=new Payment();



        if($model->load(Yii::$app->request->post()))
        {


            if($model->save())
            {


                Yii::$app->session->setFlash(

                    'success',

                    'Payment created successfully.'

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
    | RECEIVE PAYMENT FROM BILLING
    |--------------------------------------------------------------------------
    */

    public function actionPay($id)
    {

        $billing = Billing::findOne($id);



        if(!$billing)
        {

            throw new NotFoundHttpException(

                'Billing record not found.'

            );

        }



        $model = new Payment();


        $model->billing_id =
            $billing->id;


        $model->received_by =
            Yii::$app->user->id;



        if($model->load(Yii::$app->request->post()))
        {


            if($model->markCompleted())
            {


                Yii::$app->session->setFlash(

                    'success',

                    'Payment completed successfully.'

                );



                return $this->redirect([

                    'receipt',

                    'id'=>$model->id

                ]);

            }

        }




        return $this->render('pay',[


            'billing'=>$billing,


            'model'=>$model


        ]);

    }








    /*
    |--------------------------------------------------------------------------
    | RECEIPT
    |--------------------------------------------------------------------------
    */

    public function actionReceipt($id)
{

    $model=$this->findModel($id);


    $receipt =
        \app\components\ReceiptGenerator::generate($model);



    return $this->render('receipt',[

        'model'=>$model,

        'receipt'=>$receipt

    ]);

}








    /*
    |--------------------------------------------------------------------------
    | PRINT RECEIPT
    |--------------------------------------------------------------------------
    */

   public function actionPrint($id)
{

    $model = $this->findModel($id);


    $data =
        \app\components\ReceiptGenerator::generate($model);



    return $this->renderPartial('print',[

        'data'=>$data

    ]);

}








    /*
    |--------------------------------------------------------------------------
    | PAYMENT HISTORY
    |--------------------------------------------------------------------------
    */
public function actionHistory()
{

    $payments = Payment::find()

        ->with([
            'billing',
            'receiver'
        ])

        ->orderBy([
            'id'=>SORT_DESC
        ])

        ->all();



    $analytics=[


        'total'=>
            Payment::totalTransactions(),



        'today'=>
            Payment::todayCollection(),



        'weekly'=>
            Payment::weeklyCollection(),



        'monthly'=>
            Payment::monthlyCollection(),



        'cashiers'=>
            Payment::cashierPerformance(),



        'trend'=>
            Payment::paymentTrend(7)

    ];



    return $this->render('history',[

        'payments'=>$payments,

        'analytics'=>$analytics

    ]);

}






    /*
    |--------------------------------------------------------------------------
    | SEARCH PAYMENTS
    |--------------------------------------------------------------------------
    */

    public function actionSearch()
    {

        $search =
            Yii::$app->request->get('q');



        $payments = Payment::find()

            ->where([

                'like',

                'receipt_number',

                $search

            ])

            ->orWhere([

                'like',

                'transaction_reference',

                $search

            ])

            ->all();




        return $this->render('search',[

            'payments'=>$payments,

            'search'=>$search

        ]);

    }








    /*
    |--------------------------------------------------------------------------
    | REFUND PAYMENT
    |--------------------------------------------------------------------------
    */

    public function actionRefund($id)
    {


        $model=$this->findModel($id);



        if($model->markRefunded())
        {


            Yii::$app->session->setFlash(

                'success',

                'Payment refunded successfully.'

            );

        }




        return $this->redirect([

            'view',

            'id'=>$id

        ]);

    }








    /*
    |--------------------------------------------------------------------------
    | CANCEL PAYMENT
    |--------------------------------------------------------------------------
    */

    public function actionCancel($id)
    {


        $model=$this->findModel($id);



        $model->status =
            Payment::CANCELLED;



        $model->save(false);



        Yii::$app->session->setFlash(

            'success',

            'Payment cancelled.'

        );



        return $this->redirect([

            'view',

            'id'=>$id

        ]);

    }








    /*
    |--------------------------------------------------------------------------
    | DELETE PAYMENT
    |--------------------------------------------------------------------------
    */

    public function actionDelete($id)
    {


        $model=$this->findModel($id);



        $model->delete();



        Yii::$app->session->setFlash(

            'success',

            'Payment deleted.'

        );



        return $this->redirect([

            'index'

        ]);

    }








    /*
    |--------------------------------------------------------------------------
    | FIND MODEL
    |--------------------------------------------------------------------------
    */

    protected function findModel($id)
    {


        $model = Payment::find()

            ->with([

                'billing',

                'receiver'

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

            'Payment record not found.'

        );

    }



}