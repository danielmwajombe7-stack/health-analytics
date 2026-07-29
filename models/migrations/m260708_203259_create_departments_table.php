<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%departments}}`.
 */
class m260708_203259_create_departments_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%departments}}', [

            'id' => $this->primaryKey(),

            'department_name' => $this->string(100)
                ->notNull()
                ->unique(),

            'description' => $this->text(),

            'status' => $this->smallInteger()
                ->defaultValue(1),

            'created_at' => $this->timestamp()
                ->defaultExpression('CURRENT_TIMESTAMP'),

        ]);


        // Default hospital departments
        $this->batchInsert('{{%departments}}',
            [
                'department_name',
                'description'
            ],
            [

                [
                    'Reception',
                    'Patient registration and appointment management'
                ],

                [
                    'OPD',
                    'Out Patient Department for consultations'
                ],

                [
                    'Laboratory',
                    'Medical tests and results processing'
                ],

                [
                    'Pharmacy',
                    'Medicine dispensing and inventory'
                ],

                [
                    'Radiology',
                    'X-ray and imaging services'
                ],

                [
                    'Emergency',
                    'Emergency patient services'
                ],

                [
                    'Ward',
                    'Patient admission and inpatient care'
                ],

                [
                    'ICU',
                    'Intensive Care Unit'
                ],

                [
                    'Billing',
                    'Payments and financial services'
                ],

            ]
        );
    }


    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%departments}}');
    }
}