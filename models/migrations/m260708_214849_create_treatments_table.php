<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%treatments}}`.
 */
class m260708_214849_create_treatments_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%treatments}}', [

            'id' => $this->primaryKey(),

            // Patient visit
            'visit_id' => $this->integer()->notNull(),

            // Doctor responsible
            'doctor_id' => $this->integer()->notNull(),

            // Treatment information
            'treatment_plan' => $this->text()->notNull(),

            // Doctor advice
            'medical_advice' => $this->text(),

            // Follow up appointment
            'follow_up_date' => $this->date(),

            // Ongoing / Completed
            'status' => $this->string()
                ->defaultValue('Ongoing'),

            'created_at' => $this->timestamp()
                ->defaultExpression('CURRENT_TIMESTAMP'),

        ]);


        // Relationship with patient visits
        $this->addForeignKey(
            'fk-treatments-visit_id',
            '{{%treatments}}',
            'visit_id',
            '{{%patient_visits}}',
            'id',
            'CASCADE'
        );


        // Relationship with doctor
        $this->addForeignKey(
            'fk-treatments-doctor_id',
            '{{%treatments}}',
            'doctor_id',
            '{{%users}}',
            'id',
            'CASCADE'
        );

    }


    public function safeDown()
    {

        $this->dropForeignKey(
            'fk-treatments-doctor_id',
            '{{%treatments}}'
        );


        $this->dropForeignKey(
            'fk-treatments-visit_id',
            '{{%treatments}}'
        );


        $this->dropTable('{{%treatments}}');
    }
}