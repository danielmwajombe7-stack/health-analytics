<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%medicines}}`.
 */
class m260708_214040_create_medicines_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%medicines}}', [

            'id' => $this->primaryKey(),

            // Medicine name
            'name' => $this->string()->notNull(),

            // Tablet, Syrup, Injection, Capsule etc.
            'type' => $this->string(),

            // Example: 500mg, 250mg
            'strength' => $this->string(),

            // Available stock quantity
            'quantity' => $this->integer()
                ->defaultValue(0),

            // Company/manufacturer
            'manufacturer' => $this->string(),

            // Expiry date
            'expiry_date' => $this->date(),

            // Medicine status
            // Available / Expired
            'status' => $this->string()
                ->defaultValue('Available'),

            'created_at' => $this->timestamp()
                ->defaultExpression('CURRENT_TIMESTAMP'),

        ]);
    }


    public function safeDown()
    {
        $this->dropTable('{{%medicines}}');
    }
}