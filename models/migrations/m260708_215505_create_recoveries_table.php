<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%recoveries}}`.
 */
class m260708_215505_create_recoveries_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%recoveries}}', [

            'id' => $this->primaryKey(),

            // Patient who recovered
            'patient_id' => $this->integer()->notNull(),

            // Hospital visit related to recovery
            'visit_id' => $this->integer()->notNull(),

            // Doctor who confirmed recovery
            'doctor_id' => $this->integer()->notNull(),

            // Recovery information
            'recovery_notes' => $this->text(),

            // Date patient recovered
            'recovered_date' => $this->date()
                ->defaultExpression('CURRENT_DATE'),

            // User who moved patient to recovery list
            'created_by' => $this->integer()->notNull(),

            'created_at' => $this->timestamp()
                ->defaultExpression('CURRENT_TIMESTAMP'),

        ]);


        // Patient relationship
        $this->addForeignKey(
            'fk-recoveries-patient_id',
            '{{%recoveries}}',
            'patient_id',
            '{{%patients}}',
            'id',
            'CASCADE'
        );


        // Patient visit relationship
        $this->addForeignKey(
            'fk-recoveries-visit_id',
            '{{%recoveries}}',
            'visit_id',
            '{{%patient_visits}}',
            'id',
            'CASCADE'
        );


        // Doctor relationship
        $this->addForeignKey(
            'fk-recoveries-doctor_id',
            '{{%recoveries}}',
            'doctor_id',
            '{{%users}}',
            'id',
            'CASCADE'
        );


        // User who performed recovery action
        $this->addForeignKey(
            'fk-recoveries-created_by',
            '{{%recoveries}}',
            'created_by',
            '{{%users}}',
            'id',
            'CASCADE'
        );
    }


    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-recoveries-created_by',
            '{{%recoveries}}'
        );


        $this->dropForeignKey(
            'fk-recoveries-doctor_id',
            '{{%recoveries}}'
        );


        $this->dropForeignKey(
            'fk-recoveries-visit_id',
            '{{%recoveries}}'
        );


        $this->dropForeignKey(
            'fk-recoveries-patient_id',
            '{{%recoveries}}'
        );


        $this->dropTable('{{%recoveries}}');
    }
}