<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%deaths}}`.
 */
class m260708_223310_create_deaths_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%deaths}}', [

            'id' => $this->primaryKey(),

            // Patient Visit
            'visit_id' => $this->integer()->notNull(),

            // Doctor confirming death
            'doctor_id' => $this->integer()->notNull(),

            // Cause of death
            'cause_of_death' => $this->text()->notNull(),

            // Place of death
            'place_of_death' => $this->string(255),

            // Death certificate number
            'death_certificate_no' => $this->string(100)->unique(),

            // Additional notes
            'remarks' => $this->text(),

            // Date and time of death
            'date_of_death' => $this->timestamp()
                ->defaultExpression('CURRENT_TIMESTAMP'),

        ]);

        // Patient Visit
        $this->addForeignKey(
            'fk-deaths-visit_id',
            '{{%deaths}}',
            'visit_id',
            '{{%patient_visits}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        // Doctor
        $this->addForeignKey(
            'fk-deaths-doctor_id',
            '{{%deaths}}',
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
            'fk-deaths-doctor_id',
            '{{%deaths}}'
        );

        $this->dropForeignKey(
            'fk-deaths-visit_id',
            '{{%deaths}}'
        );

        $this->dropTable('{{%deaths}}');
    }
}