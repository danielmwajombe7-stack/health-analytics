<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%medical_reports}}`.
 */
class m260708_220940_create_medical_reports_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%medical_reports}}', [

            'id' => $this->primaryKey(),

            // Patient Visit
            'visit_id' => $this->integer()->notNull(),

            // Doctor who writes the report
            'doctor_id' => $this->integer()->notNull(),

            // Report title
            'report_title' => $this->string(255)->notNull(),

            // Full report
            'report_details' => $this->text()->notNull(),

            // Optional remarks
            'remarks' => $this->text(),

            // Date created
            'created_at' => $this->timestamp()
                ->defaultExpression('CURRENT_TIMESTAMP'),
        ]);

        // ==========================
        // Foreign Key -> patient_visits
        // ==========================
        $this->addForeignKey(
            'fk-medical_reports-visit_id',
            '{{%medical_reports}}',
            'visit_id',
            '{{%patient_visits}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        // ==========================
        // Foreign Key -> users (Doctor)
        // ==========================
        $this->addForeignKey(
            'fk-medical_reports-doctor_id',
            '{{%medical_reports}}',
            'doctor_id',
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
            'fk-medical_reports-doctor_id',
            '{{%medical_reports}}'
        );

        $this->dropForeignKey(
            'fk-medical_reports-visit_id',
            '{{%medical_reports}}'
        );

        $this->dropTable('{{%medical_reports}}');
    }
}