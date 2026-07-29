<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%prescriptions}}`.
 */
class m260708_214342_create_prescriptions_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%prescriptions}}', [

            'id' => $this->primaryKey(),

            // Patient visit
            'visit_id' => $this->integer()->notNull(),

            // Doctor who prescribed
            'doctor_id' => $this->integer()->notNull(),

            // Medicine
            'medicine_id' => $this->integer()->notNull(),

            // Dosage example: 500mg
            'dosage' => $this->string()->notNull(),

            // Frequency example: 2 times per day
            'frequency' => $this->string()->notNull(),

            // Duration example: 7 days
            'duration' => $this->string()->notNull(),

            // Additional instructions
            'instructions' => $this->text(),

            'created_at' => $this->timestamp()
                ->defaultExpression('CURRENT_TIMESTAMP'),

        ]);


        // Connect prescription with patient visit
        $this->addForeignKey(
            'fk-prescriptions-visit_id',
            '{{%prescriptions}}',
            'visit_id',
            '{{%patient_visits}}',
            'id',
            'CASCADE'
        );


        // Connect prescription with doctor
        $this->addForeignKey(
            'fk-prescriptions-doctor_id',
            '{{%prescriptions}}',
            'doctor_id',
            '{{%users}}',
            'id',
            'CASCADE'
        );


        // Connect prescription with medicine
        $this->addForeignKey(
            'fk-prescriptions-medicine_id',
            '{{%prescriptions}}',
            'medicine_id',
            '{{%medicines}}',
            'id',
            'CASCADE'
        );
    }


    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-prescriptions-medicine_id',
            '{{%prescriptions}}'
        );

        $this->dropForeignKey(
            'fk-prescriptions-doctor_id',
            '{{%prescriptions}}'
        );

        $this->dropForeignKey(
            'fk-prescriptions-visit_id',
            '{{%prescriptions}}'
        );


        $this->dropTable('{{%prescriptions}}');
    }
}