<?php

namespace app\models;


use Yii;
use yii\db\ActiveRecord;



class MedicineDispensing extends ActiveRecord
{


    public static function tableName()
    {

        return 'medicine_dispensing';

    }






    public function rules()
    {


        return [


            [

                [
                    'prescription_id',
                    'medicine_id',
                    'quantity',
                    'dispensed_by'
                ],

                'integer'

            ],




            [
                'dispensed_at',
                'safe'
            ]


        ];


    }








    public function getPrescription()
    {

        return $this->hasOne(

            Prescription::class,

            [
                'id'=>'prescription_id'
            ]

        );


    }







    public function getMedicine()
    {

        return $this->hasOne(

            Medicine::class,

            [
                'id'=>'medicine_id'
            ]

        );

    }





    public function getPharmacist()
    {


        return $this->hasOne(

            User::class,

            [
                'id'=>'dispensed_by'
            ]

        );


    }






}