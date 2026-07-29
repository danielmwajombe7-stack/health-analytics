<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%admissions}}`.
 */
class m260708_222739_create_admissions_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%admissions}}', [

            'id' => $this->primaryKey(),

            // Patient Visit
            'visit_id' => $this->integer()->notNull(),

            // Doctor admitting patient
            'doctor_id' => $this->integer()->notNull(),

            // Ward
            'ward_name' => $this->string(100)->notNull(),

            // Room
            'room_number' => $this->string(50),

            // Bed
            'bed_number' => $this->string(50),

            // Reason for admission
            'admission_reason' => $this->text(),

            // Admission status
            'status' => $this->string(50)
                ->defaultValue('Admitted'),

            // Dates
            'admission_date' => $this->timestamp()
                ->defaultExpression('CURRENT_TIMESTAMP'),

            'expected_discharge_date' => $this->date(),

            'actual_discharge_date' => $this->date(),

        ]);

        // Patient Visit
        $this->addForeignKey(
            'fk-admissions-visit_id',
            '{{%admissions}}',
            'visit_id',
            '{{%patient_visits}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        // Doctor
        $this->addForeignKey(
            'fk-admissions-doctor_id',
            '{{%admissions}}',
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
            'fk-admissions-doctor_id',
            '{{%admissions}}'
        );

        $this->dropForeignKey(
            'fk-admissions-visit_id',
            '{{%admissions}}'
        );

        $this->dropTable('{{%admissions}}');
    }
}