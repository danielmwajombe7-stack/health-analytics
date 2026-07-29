<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%payments}}`.
 */
class m260708_222149_create_payments_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%payments}}', [

            'id' => $this->primaryKey(),

            // Bill being paid
            'billing_id' => $this->integer()->notNull(),

            // Amount paid
            'amount_paid' => $this->decimal(12,2)->notNull(),

            // Payment method
            'payment_method' => $this->string(50)->notNull(),

            // Receipt number
            'receipt_number' => $this->string(100)->unique(),

            // Transaction reference
            'transaction_reference' => $this->string(100),

            // Payment status
            'status' => $this->string(50)->defaultValue('Completed'),

            // Cashier
            'received_by' => $this->integer()->notNull(),

            // Payment date
            'payment_date' => $this->timestamp()
                ->defaultExpression('CURRENT_TIMESTAMP'),

        ]);

        // Billing
        $this->addForeignKey(
            'fk-payments-billing_id',
            '{{%payments}}',
            'billing_id',
            '{{%billing}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        // Cashier/User
        $this->addForeignKey(
            'fk-payments-received_by',
            '{{%payments}}',
            'received_by',
            '{{%users}}',
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
            'fk-payments-received_by',
            '{{%payments}}'
        );

        $this->dropForeignKey(
            'fk-payments-billing_id',
            '{{%payments}}'
        );

        $this->dropTable('{{%payments}}');
    }
}