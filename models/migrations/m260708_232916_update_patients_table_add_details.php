<?php

use yii\db\Migration;

class m260708_232916_update_patients_table_add_details extends Migration
{
    public function safeUp()
    {
        $table = $this->db->getTableSchema('{{%patients}}');

        if (!$table->getColumn('patient_number')) {
            $this->addColumn(
                '{{%patients}}',
                'patient_number',
                $this->string(50)
            );
        }

        if (!$table->getColumn('first_name')) {
            $this->addColumn(
                '{{%patients}}',
                'first_name',
                $this->string(100)
            );
        }

        if (!$table->getColumn('middle_name')) {
            $this->addColumn(
                '{{%patients}}',
                'middle_name',
                $this->string(100)
            );
        }

        if (!$table->getColumn('last_name')) {
            $this->addColumn(
                '{{%patients}}',
                'last_name',
                $this->string(100)
            );
        }

        if (!$table->getColumn('gender')) {
            $this->addColumn(
                '{{%patients}}',
                'gender',
                $this->string(20)
            );
        }

        if (!$table->getColumn('date_of_birth')) {
            $this->addColumn(
                '{{%patients}}',
                'date_of_birth',
                $this->date()
            );
        }

        if (!$table->getColumn('phone')) {
            $this->addColumn(
                '{{%patients}}',
                'phone',
                $this->string(20)
            );
        }

        if (!$table->getColumn('address')) {
            $this->addColumn(
                '{{%patients}}',
                'address',
                $this->text()
            );
        }

        if (!$table->getColumn('blood_group')) {
            $this->addColumn(
                '{{%patients}}',
                'blood_group',
                $this->string(10)
            );
        }

        if (!$table->getColumn('emergency_contact')) {
            $this->addColumn(
                '{{%patients}}',
                'emergency_contact',
                $this->string(100)
            );
        }

        if (!$table->getColumn('status')) {
            $this->addColumn(
                '{{%patients}}',
                'status',
                $this->string(30)->defaultValue('Active')
            );
        }

        if (!$table->getColumn('created_at')) {
            $this->addColumn(
                '{{%patients}}',
                'created_at',
                $this->timestamp()
                    ->defaultExpression('CURRENT_TIMESTAMP')
            );
        }
    }


    public function safeDown()
    {
        $table = $this->db->getTableSchema('{{%patients}}');

        $columns = [
            'created_at',
            'status',
            'emergency_contact',
            'blood_group',
            'address',
            'phone',
            'date_of_birth',
            'gender',
            'last_name',
            'middle_name',
            'first_name',
            'patient_number'
        ];


        foreach ($columns as $column) {

            if ($table->getColumn($column)) {

                $this->dropColumn(
                    '{{%patients}}',
                    $column
                );

            }
        }
    }
}