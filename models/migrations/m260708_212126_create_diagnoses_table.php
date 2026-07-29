<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%diagnoses}}`.
 */
class m260708_212126_create_diagnoses_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%diagnoses}}', [

            'id' => $this->primaryKey(),

            // Patient visit
            'visit_id' => $this->integer()->notNull(),

            // Disease selected by doctor
            'disease_id' => $this->integer()->notNull(),

            // Doctor who diagnosed
            'doctor_id' => $this->integer()->notNull(),

            // Doctor conclusion
            'diagnosis_note' => $this->text(),

            // Severity level
            'severity' => $this->string(),

            // Treatment recommendation
            'doctor_advice' => $this->text(),

            'created_at' => $this->timestamp()
                ->defaultExpression('CURRENT_TIMESTAMP'),

        ]);


        // Connect diagnosis with patient visit
        $this->addForeignKey(
            'fk-diagnoses-visit_id',
            '{{%diagnoses}}',
            'visit_id',
            '{{%patient_visits}}',
            'id',
            'CASCADE'
        );


        // Connect diagnosis with disease list
        $this->addForeignKey(
            'fk-diagnoses-disease_id',
            '{{%diagnoses}}',
            'disease_id',
            '{{%diseases}}',
            'id',
            'CASCADE'
        );


        // Connect diagnosis with doctor
        $this->addForeignKey(
            'fk-diagnoses-doctor_id',
            '{{%diagnoses}}',
            'doctor_id',
            '{{%users}}',
            'id',
            'CASCADE'
        );
    }


    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-diagnoses-doctor_id',
            '{{%diagnoses}}'
        );

        $this->dropForeignKey(
            'fk-diagnoses-disease_id',
            '{{%diagnoses}}'
        );

        $this->dropForeignKey(
            'fk-diagnoses-visit_id',
            '{{%diagnoses}}'
        );


        $this->dropTable('{{%diagnoses}}');
    }
}