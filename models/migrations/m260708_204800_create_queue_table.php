<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%queue}}`.
 */
class m260708_204800_create_queue_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%queue}}', [

            'id' => $this->primaryKey(),

            // link with patient visit
            'visit_id' => $this->integer()->notNull(),

            // queue number for patient
            'queue_number' => $this->integer()->notNull(),

            // Waiting, Nurse, Doctor, Completed
            'status' => $this->string()
                ->notNull()
                ->defaultValue('Waiting'),

            // who created queue
            'created_by' => $this->integer()->notNull(),

            'created_at' => $this->timestamp()
                ->defaultExpression('CURRENT_TIMESTAMP'),

            'updated_at' => $this->timestamp()
                ->defaultExpression('CURRENT_TIMESTAMP'),

        ]);


        // Patient visit relationship
        $this->addForeignKey(
            'fk-queue-visit_id',
            '{{%queue}}',
            'visit_id',
            '{{%patient_visits}}',
            'id',
            'CASCADE'
        );


        // User relationship (Receptionist)
        $this->addForeignKey(
            'fk-queue-created_by',
            '{{%queue}}',
            'created_by',
            '{{%users}}',
            'id',
            'CASCADE'
        );
    }


    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-queue-created_by',
            '{{%queue}}'
        );

        $this->dropForeignKey(
            'fk-queue-visit_id',
            '{{%queue}}'
        );

        $this->dropTable('{{%queue}}');
    }
}