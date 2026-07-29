<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%vital_signs}}`.
 */
class m260708_205228_create_vital_signs_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%vital_signs}}', [

            'id' => $this->primaryKey(),

            // Link with patient visit
            'visit_id' => $this->integer()->notNull(),

            // Patient measurements
            'temperature' => $this->decimal(5,2),

            'blood_pressure' => $this->string(),

            'pulse_rate' => $this->integer(),

            'respiratory_rate' => $this->integer(),

            'oxygen_saturation' => $this->integer(),

            'weight' => $this->decimal(5,2),

            'height' => $this->decimal(5,2),

            'bmi' => $this->decimal(5,2),

            // Nurse notes
            'nursing_notes' => $this->text(),

            // Nurse who recorded data
            'recorded_by' => $this->integer()->notNull(),

            'created_at' => $this->timestamp()
                ->defaultExpression('CURRENT_TIMESTAMP'),

        ]);


        // Relationship with patient visits
        $this->addForeignKey(
            'fk-vital_signs-visit_id',
            '{{%vital_signs}}',
            'visit_id',
            '{{%patient_visits}}',
            'id',
            'CASCADE'
        );


        // Relationship with nurse/user
        $this->addForeignKey(
            'fk-vital_signs-recorded_by',
            '{{%vital_signs}}',
            'recorded_by',
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
            'fk-vital_signs-recorded_by',
            '{{%vital_signs}}'
        );


        $this->dropForeignKey(
            'fk-vital_signs-visit_id',
            '{{%vital_signs}}'
        );


        $this->dropTable('{{%vital_signs}}');
    }
}