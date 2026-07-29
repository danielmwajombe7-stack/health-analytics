<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%patients}}`.
 */
class m260708_203748_create_patients_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%patients}}', [

            'id' => $this->primaryKey(),

            'patient_number' => $this->string(30)
                ->notNull()
                ->unique(),

            'first_name' => $this->string(50)
                ->notNull(),

            'middle_name' => $this->string(50),

            'last_name' => $this->string(50)
                ->notNull(),

            'gender' => $this->string(10)
                ->notNull(),

            'date_of_birth' => $this->date(),

            'phone' => $this->string(20),

            'email' => $this->string(100),

            'address' => $this->text(),

            'blood_group' => $this->string(5),

            'marital_status' => $this->string(20),

            'occupation' => $this->string(100),

            'nationality' => $this->string(50)
                ->defaultValue('Tanzanian'),

            'next_of_kin' => $this->string(100),

            'next_of_kin_phone' => $this->string(20),

            'insurance_type' => $this->string(50),

            'insurance_number' => $this->string(100),

            'created_by' => $this->integer(),

            'created_at' => $this->timestamp()
                ->defaultExpression('CURRENT_TIMESTAMP'),

            'updated_at' => $this->timestamp()
                ->defaultExpression('CURRENT_TIMESTAMP'),

        ]);


        // Relationship: Patient registered by system user
        $this->addForeignKey(
            'fk-patients-created_by',
            '{{%patients}}',
            'created_by',
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
            'fk-patients-created_by',
            '{{%patients}}'
        );

        $this->dropTable('{{%patients}}');

    }
}