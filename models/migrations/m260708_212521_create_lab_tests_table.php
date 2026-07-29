<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%lab_tests}}`.
 */
class m260708_212521_create_lab_tests_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%lab_tests}}', [

            'id' => $this->primaryKey(),

            // Patient visit
            'visit_id' => $this->integer()->notNull(),

            // Doctor requesting laboratory test
            'requested_by' => $this->integer()->notNull(),

            // Test name e.g Blood Test, X-Ray, Urine Test
            'test_name' => $this->string()->notNull(),

            // Additional instructions from doctor
            'doctor_note' => $this->text(),

            // Pending, Processing, Completed
            'status' => $this->string()
                ->defaultValue('Pending'),

            // Laboratory technician who performed test
            'performed_by' => $this->integer()->null(),

            // Dates
            'request_date' => $this->timestamp()
                ->defaultExpression('CURRENT_TIMESTAMP'),

            // Will be filled after test completion
            'completed_date' => $this->dateTime()->null(),

        ]);


        // Connect with patient visit
        $this->addForeignKey(
            'fk-lab_tests-visit_id',
            '{{%lab_tests}}',
            'visit_id',
            '{{%patient_visits}}',
            'id',
            'CASCADE'
        );


        // Connect with doctor
        $this->addForeignKey(
            'fk-lab_tests-requested_by',
            '{{%lab_tests}}',
            'requested_by',
            '{{%users}}',
            'id',
            'CASCADE'
        );


        // Connect with laboratory technician
        $this->addForeignKey(
            'fk-lab_tests-performed_by',
            '{{%lab_tests}}',
            'performed_by',
            '{{%users}}',
            'id',
            'SET NULL'
        );
    }


    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-lab_tests-performed_by',
            '{{%lab_tests}}'
        );

        $this->dropForeignKey(
            'fk-lab_tests-requested_by',
            '{{%lab_tests}}'
        );

        $this->dropForeignKey(
            'fk-lab_tests-visit_id',
            '{{%lab_tests}}'
        );

        $this->dropTable('{{%lab_tests}}');
    }
}