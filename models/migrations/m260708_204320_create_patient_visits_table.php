<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%patient_visits}}`.
 */
class m260708_204320_create_patient_visits_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%patient_visits}}', [

            'id' => $this->primaryKey(),

            'patient_id' => $this->integer()
                ->notNull(),

            'visit_number' => $this->string(30)
                ->notNull()
                ->unique(),

            'visit_date' => $this->dateTime()
                ->defaultExpression('CURRENT_TIMESTAMP'),

            'visit_type' => $this->string(50)
                ->defaultValue('Walk-in'),

            'department_id' => $this->integer(),

            'doctor_id' => $this->integer(),

            'status' => $this->string(50)
                ->defaultValue('Waiting'),

            'notes' => $this->text(),

            'created_at' => $this->timestamp()
                ->defaultExpression('CURRENT_TIMESTAMP'),

            'updated_at' => $this->timestamp()
                ->defaultExpression('CURRENT_TIMESTAMP'),

        ]);


        // Patient relationship
        $this->addForeignKey(
            'fk-patient_visits-patient_id',
            '{{%patient_visits}}',
            'patient_id',
            '{{%patients}}',
            'id',
            'CASCADE',
            'CASCADE'
        );


        // Department relationship
        $this->addForeignKey(
            'fk-patient_visits-department_id',
            '{{%patient_visits}}',
            'department_id',
            '{{%departments}}',
            'id',
            'SET NULL',
            'CASCADE'
        );


        // Doctor relationship
        $this->addForeignKey(
            'fk-patient_visits-doctor_id',
            '{{%patient_visits}}',
            'doctor_id',
            '{{%users}}',
            'id',
            'SET NULL',
            'CASCADE'
        );

    }


    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {

        $this->dropForeignKey(
            'fk-patient_visits-doctor_id',
            '{{%patient_visits}}'
        );

        $this->dropForeignKey(
            'fk-patient_visits-department_id',
            '{{%patient_visits}}'
        );

        $this->dropForeignKey(
            'fk-patient_visits-patient_id',
            '{{%patient_visits}}'
        );

        $this->dropTable('{{%patient_visits}}');

    }
}