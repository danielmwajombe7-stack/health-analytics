<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%appointments}}`.
 */
class m260708_220543_create_appointments_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%appointments}}', [

            'id' => $this->primaryKey(),

            // Patient who booked appointment
            'patient_id' => $this->integer()->notNull(),

            // Assigned doctor
            'doctor_id' => $this->integer(),

            // Hospital department
            'department_id' => $this->integer()->notNull(),

            // Appointment date
            'appointment_date' => $this->date()->notNull(),

            // Appointment time
            'appointment_time' => $this->time(),

            // Reason for visiting hospital
            'reason' => $this->text(),

            // Pending, Confirmed, Completed, Cancelled
            'status' => $this->string()
                ->defaultValue('Pending'),

            // Reception staff who created appointment
            'created_by' => $this->integer()->notNull(),

            'created_at' => $this->timestamp()
                ->defaultExpression('CURRENT_TIMESTAMP'),

        ]);


        // Patient relationship
        $this->addForeignKey(
            'fk-appointments-patient_id',
            '{{%appointments}}',
            'patient_id',
            '{{%patients}}',
            'id',
            'CASCADE'
        );


        // Doctor relationship
        $this->addForeignKey(
            'fk-appointments-doctor_id',
            '{{%appointments}}',
            'doctor_id',
            '{{%users}}',
            'id',
            'SET NULL'
        );


        // Department relationship
        $this->addForeignKey(
            'fk-appointments-department_id',
            '{{%appointments}}',
            'department_id',
            '{{%departments}}',
            'id',
            'CASCADE'
        );


        // Reception user relationship
        $this->addForeignKey(
            'fk-appointments-created_by',
            '{{%appointments}}',
            'created_by',
            '{{%users}}',
            'id',
            'CASCADE'
        );

    }


    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-appointments-created_by',
            '{{%appointments}}'
        );


        $this->dropForeignKey(
            'fk-appointments-department_id',
            '{{%appointments}}'
        );


        $this->dropForeignKey(
            'fk-appointments-doctor_id',
            '{{%appointments}}'
        );


        $this->dropForeignKey(
            'fk-appointments-patient_id',
            '{{%appointments}}'
        );


        $this->dropTable('{{%appointments}}');
    }
}