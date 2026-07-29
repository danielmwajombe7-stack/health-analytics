<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%discharges}}`.
 */
class m260708_220053_create_discharges_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%discharges}}', [

            'id' => $this->primaryKey(),

            // Patient discharged
            'patient_id' => $this->integer()->notNull(),

            // Related patient visit
            'visit_id' => $this->integer()->notNull(),

            // Doctor who approved discharge
            'doctor_id' => $this->integer()->notNull(),

            // Type of discharge
            // Recovered, Referred, Against Advice
            'discharge_type' => $this->string()->notNull(),

            // Doctor discharge summary
            'discharge_summary' => $this->text(),

            // Instructions after leaving hospital
            'follow_up_instruction' => $this->text(),

            // Date discharged
            'discharge_date' => $this->date()
                ->defaultExpression('CURRENT_DATE'),

            // User who processed discharge
            'created_by' => $this->integer()->notNull(),

            'created_at' => $this->timestamp()
                ->defaultExpression('CURRENT_TIMESTAMP'),

        ]);


        // Connect with patients table
        $this->addForeignKey(
            'fk-discharges-patient_id',
            '{{%discharges}}',
            'patient_id',
            '{{%patients}}',
            'id',
            'CASCADE'
        );


        // Connect with patient visits
        $this->addForeignKey(
            'fk-discharges-visit_id',
            '{{%discharges}}',
            'visit_id',
            '{{%patient_visits}}',
            'id',
            'CASCADE'
        );


        // Connect with doctor
        $this->addForeignKey(
            'fk-discharges-doctor_id',
            '{{%discharges}}',
            'doctor_id',
            '{{%users}}',
            'id',
            'CASCADE'
        );


        // User who performed discharge
        $this->addForeignKey(
            'fk-discharges-created_by',
            '{{%discharges}}',
            'created_by',
            '{{%users}}',
            'id',
            'CASCADE'
        );

    }


    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-discharges-created_by',
            '{{%discharges}}'
        );


        $this->dropForeignKey(
            'fk-discharges-doctor_id',
            '{{%discharges}}'
        );


        $this->dropForeignKey(
            'fk-discharges-visit_id',
            '{{%discharges}}'
        );


        $this->dropForeignKey(
            'fk-discharges-patient_id',
            '{{%discharges}}'
        );


        $this->dropTable('{{%discharges}}');
    }
}