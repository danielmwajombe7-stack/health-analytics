<?php

namespace app\models;

use yii\db\ActiveRecord;


class Medicine extends ActiveRecord
{


    public static function tableName()
    {
        return 'medicines';
    }





    public function rules()
    {

        return [

            [
                [
                    'name',
                    'quantity',
                    'price'
                ],

                'safe'
            ]

        ];

    }





    /**
     * Relation:
     *
     * medicines.id
     *        |
     *        |
     * medicine_stock.medicine_id
     *
     */
    public function getMedicineStock()
    {

        return $this->hasOne(

            MedicineStock::class,

            [
                'medicine_id'=>'id'
            ]

        );

    }





    /**
     * Alias relation for PharmacyController
     *
     * Usage:
     * Medicine::find()->with('stock')->all();
     *
     */
    public function getStock()
    {

        return $this->hasOne(

            MedicineStock::class,

            [
                'medicine_id'=>'id'
            ]

        );

    }





    /**
     * Get available medicine quantity
     */
    public function getStockQuantity()
    {

        return $this->stock
            ? $this->stock->quantity
            : 0;

    }





    /**
     * Check low stock status
     */
    public function getIsLowStock()
    {

        return $this->stock && $this->stock->quantity <= 10;

    }





    /**
     * Check medicine expiry
     */
    public function getExpiryDate()
    {

        return $this->stock
            ? $this->stock->expiry_date
            : null;

    }


}