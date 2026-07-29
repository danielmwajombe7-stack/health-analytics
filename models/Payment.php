<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;


class Payment extends ActiveRecord
{


    public static function tableName()
    {
        return 'payments';
    }



    const PAYMENT_PENDING = 'Pending';
    const PAYMENT_PAID = 'Paid';
    const PAYMENT_PARTIAL = 'Partial';



    public function rules()
    {

        return [

            [
                [
                    'billing_id',
                    'amount_paid',
                    'payment_method'
                ],
                'required'
            ],


            [
                [
                    'billing_id',
                    'received_by'
                ],
                'integer'
            ],


            [
                'amount_paid',
                'number'
            ],


            [
                [
                    'payment_date'
                ],
                'safe'
            ],


            [
                [
                    'status',
                    'payment_status',
                    'payment_method',
                    'receipt_number',
                    'transaction_reference'
                ],
                'string'
            ]

        ];

    }



    public function getBilling()
    {

        return $this->hasOne(
            Billing::class,
            [
                'id'=>'billing_id'
            ]
        );

    }



    public function beforeSave($insert)
    {

        if(parent::beforeSave($insert))
        {


            if($this->status == 'Completed')
            {

                $this->payment_status =
                self::PAYMENT_PAID;

            }


            elseif($this->status == 'Partial')
            {

                $this->payment_status =
                self::PAYMENT_PARTIAL;

            }


            else
            {

                $this->payment_status =
                self::PAYMENT_PENDING;

            }



            if(empty($this->payment_date))
            {

                $this->payment_date =
                date('Y-m-d H:i:s');

            }



            return true;

        }


        return false;

    }


}