<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;


class MedicineStock extends ActiveRecord
{


    /**
     * Database table
     */
    public static function tableName()
    {
        return 'medicine_stock';
    }






    /**
     * Validation Rules
     */
    public function rules()
    {

        return [

            [
                [
                    'medicine_id',
                    'quantity'
                ],
                'integer'
            ],



            [
                [
                    'batch_number',
                    'expiry_date',
                    'created_at',
                    'updated_at'
                ],
                'safe'
            ]

        ];

    }







    /**
     * Relation
     *
     * medicine_stock.medicine_id
     *          |
     *          |
     * medicines.id
     *
     */
    public function getMedicine()
    {

        return $this->hasOne(
            Medicine::class,
            [
                'id'=>'medicine_id'
            ]
        );

    }







    /**
     * Check available stock
     */
    public function available($qty = 1)
    {

        return $this->quantity >= $qty;

    }








    /**
     * Reduce medicine quantity
     */
    public function reduce($qty)
    {


        if($this->quantity < $qty)
        {

            return false;

        }



        $this->quantity -= $qty;


        return $this->save(false);


    }







    /**
     * Check if medicine expired
     */
    public function isExpired()
    {

        if(empty($this->expiry_date))
        {
            return false;
        }


        return strtotime($this->expiry_date) < strtotime(date('Y-m-d'));

    }







    /**
     * Stock status
     */
    public function getStockStatus()
    {


        if($this->quantity <= 0)
        {

            return 'Out of Stock';

        }


        if($this->quantity <= 50)
        {

            return 'Low Stock';

        }


        return 'Available';


    }





}