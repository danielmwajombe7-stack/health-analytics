<?php

namespace app\controllers;


use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;


use app\models\Billing;
use app\models\Payment;



class BillingController extends Controller
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

                    ],

                ],

            ],

        ];

    }





    /**
     * Billing Dashboard
     */
    public function actionIndex()
    {


        $billing = Billing::find()

            ->with('patient')

            ->orderBy([
                'id'=>SORT_DESC
            ])

            ->all();





        $totalAmount = Billing::find()

            ->sum('amount');





        $paid = 0;

        $pending = 0;



        foreach($billing as $bill)
        {


            $status = $bill->payment_status 
                ??
                $bill->status
                ??
                'Pending';



            if(strtolower($status) == 'paid')
            {

                $paid += $bill->amount;

            }

            else
            {

                $pending += $bill->amount;

            }


        }





        return $this->render('index',[


            'billing'=>$billing,


            'totalAmount'=>$totalAmount ?? 0,


            'paid'=>$paid,


            'pending'=>$pending,


        ]);


    }









    /**
     * View Billing
     */
    public function actionView($id)
    {


        return $this->render(
            'view',
            [

                'model'=>$this->findModel($id)

            ]
        );


    }









    /**
     * Create Billing
     */
    public function actionCreate()
    {


        $model = new Billing();



        if($model->load(Yii::$app->request->post()))
        {


            $model->created_by =
                Yii::$app->user->id;



            if($model->save())
            {


                Yii::$app->session->setFlash(
                    'success',
                    'Billing created successfully.'
                );



                return $this->redirect([
                    'view',
                    'id'=>$model->id
                ]);


            }


        }





        return $this->render(
            'create',
            [

                'model'=>$model

            ]
        );


    }









    /**
     * Update Billing
     */
    public function actionUpdate($id)
    {


        $model=$this->findModel($id);



        if($model->load(Yii::$app->request->post())
            &&
            $model->save()
        )
        {


            Yii::$app->session->setFlash(
                'success',
                'Billing updated successfully.'
            );



            return $this->redirect([
                'view',
                'id'=>$model->id
            ]);


        }




        return $this->render(
            'update',
            [

                'model'=>$model

            ]
        );


    }









    /**
     * PAY NOW
     */
    public function actionPay($id)
    {


        $billing = $this->findModel($id);



        if(Yii::$app->request->isPost)
        {


            $payment = new Payment();



            $payment->billing_id =
                $billing->id;



            $payment->amount_paid =
                Yii::$app->request->post('amount_paid');



            $payment->payment_method =
                Yii::$app->request->post('payment_method');



            $payment->transaction_reference =
                Yii::$app->request->post('transaction_reference');



            $payment->receipt_number =
                'RCT-'.date('Ymd').'-'.$billing->id;



            $payment->status =
                'Completed';



            $payment->payment_status =
                'Paid';



            $payment->received_by =
                Yii::$app->user->id;



            $payment->payment_date =
                date('Y-m-d H:i:s');





            if($payment->save())
            {


                /*
                Update Billing Status
                */


                $billing->payment_status =
                    'Paid';



                $billing->status =
                    'Paid';



                $billing->save(false);





                Yii::$app->session->setFlash(
                    'success',
                    'Payment completed successfully.'
                );



                return $this->redirect([
                    'index'
                ]);


            }



        }




        return $this->render(
            'pay',
            [

                'billing'=>$billing

            ]
        );


    }









    /**
     * Delete Billing
     */
    public function actionDelete($id)
    {


        $this->findModel($id)->delete();



        Yii::$app->session->setFlash(
            'success',
            'Billing deleted successfully.'
        );



        return $this->redirect([
            'index'
        ]);


    }









    /**
     * Find Billing Model
     */
    protected function findModel($id)
    {


        $model = Billing::find()

            ->with('patient')

            ->where([
                'id'=>$id
            ])

            ->one();




        if($model !== null)
        {

            return $model;

        }



        throw new NotFoundHttpException(
            'Billing record not found.'
        );


    }




}