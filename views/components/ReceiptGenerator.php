<?php

namespace app\components;


use Yii;
use yii\helpers\Html;



class ReceiptGenerator
{


    /*
    |--------------------------------------------------------------------------
    | GENERATE RECEIPT DATA
    |--------------------------------------------------------------------------
    */

    public static function generate($payment)
    {

        return [

            'hospital'=>self::hospitalInfo(),


            'receipt_number'=>
                $payment->receipt_number,


            'payment_date'=>
                $payment->payment_date,


            'patient'=>
                $payment->patientName,


            'amount'=>
                $payment->formattedAmount,


            'method'=>
                $payment->payment_method,


            'reference'=>
                $payment->transaction_reference,


            'cashier'=>
                $payment->cashierName,


            'billing'=>
                $payment->billing_id,


            'status'=>
                $payment->payment_status

        ];

    }






    /*
    |--------------------------------------------------------------------------
    | HOSPITAL INFORMATION
    |--------------------------------------------------------------------------
    */

    public static function hospitalInfo()
    {

        return [

            'name'=>
                Yii::$app->params['hospitalName']
                ??
                'Health Analytics Hospital',



            'address'=>
                Yii::$app->params['hospitalAddress']
                ??
                'Dar es Salaam, Tanzania',



            'phone'=>
                Yii::$app->params['hospitalPhone']
                ??
                '+255 000 000 000',


            'email'=>
                Yii::$app->params['hospitalEmail']
                ??
                'info@hospital.com'

        ];

    }






    /*
    |--------------------------------------------------------------------------
    | PRINT FORMAT
    |--------------------------------------------------------------------------
    */

    public static function printReceipt($payment)
    {

        $data=self::generate($payment);


        return Yii::$app->view->render(
            '@app/views/payment/print',
            [
                'data'=>$data
            ]
        );

    }



}