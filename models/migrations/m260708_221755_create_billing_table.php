<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%billing}}`.
 */
class m260708_221755_create_billing_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%billing}}', [

            'id' => $this->primaryKey(),

            // Patient Visit
            'visit_id' => $this->integer()->notNull(),

            // Service charged
            'service_name' => $this->string()->notNull(),

            // Description
            'description' => $this->text(),

            // Amount
            'amount' => $this->decimal(12,2)->notNull(),

            // Discount
            'discount' => $this->decimal(12,2)->defaultValue(0),

            // Tax
            'tax' => $this->decimal(12,2)->defaultValue(0),

            // Total amount
            'total_amount' => $this->decimal(12,2)->notNull(),

            // Billing status
            'status' => $this->string(50)->defaultValue('Unpaid'),

            // Created date
            'created_at' => $this->timestamp()
                ->defaultExpression('CURRENT_TIMESTAMP'),

        ]);

        // Foreign Key -> Patient Visit
        $this->addForeignKey(
            'fk-billing-visit_id',
            '{{%billing}}',
            'visit_id',
            '{{%patient_visits}}',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-billing-visit_id',
            '{{%billing}}'
        );

        $this->dropTable('{{%billing}}');
    }
}